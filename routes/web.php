<?php
// Static website page routes
Route::view('/about', 'website.about');
Route::view('/contact', 'website.contact')->name('contact');
Route::view('/customerfeedback', 'website.customerfeedback');
Route::view('/news', 'website.news')->name('news');
Route::view('/blogs', 'website.blogs');
Route::view('/aggregates', 'website.aggregates');
Route::view('/asphalt-bitumen', 'website.asphalt-bitumen');
Route::view('/calibration', 'website.calibration');
Route::view('/cement-mortar', 'website.cement-mortar');
Route::view('/concrete-mortar', 'website.concrete-mortar');
Route::view('/drilling-machine', 'website.drilling-machine');
Route::view('/industrial-equipment', 'website.industrial-equipment');
Route::view('/pavetest', 'website.pavetest');
Route::view('/soil', 'website.soil');
Route::view('/steel', 'website.steel');
// Redirect legacy URLs to canonical slugs (SEO-friendly)
Route::redirect('/soil-testing', '/soil', 301);
Route::redirect('/steel-testing', '/steel', 301);
Route::view('/customer-feedback', 'website.customerfeedback');
Route::view('/services', 'website.services');

// Public inquiry submission (for product/category pages)
Route::post('/inquiry/submit', [\App\Http\Controllers\InquiryController::class, 'submit'])->name('inquiry.submit');


// Static homepage test route
Route::get('/static', function () {
    return view('website.index');
});

// AJAX product search for landing page
Route::get('/landing-search', function (\Illuminate\Http\Request $request) {
    $q = $request->input('q');
    $products = \App\Models\Product::where('is_active', 1)
        ->where(function($query) use ($q) {
            $query->where('name', 'like', "%$q%")
                  ->orWhere('description', 'like', "%$q%")
                  ->orWhere('unit_price', 'like', "%$q%")
                  ->orWhere('sku', 'like', "%$q%")
                  ;
        })
        ->orderByDesc('created_at')
        ->limit(10)
        ->get();
    $results = $products->map(function($p) {
        return [
            'id' => $p->id,
            'name' => $p->name,
            'sku' => $p->sku,
            'price' => $p->unit_price,
            'image_url' => method_exists($p, 'firstImagePath') && $p->firstImagePath() ? asset('storage/'.$p->firstImagePath()) : asset('images/gemarclogo.png'),
        ];
    });
    return response()->json($results);
})->name('landing.search');


// Employee notification clear route
Route::middleware(['auth', 'verified'])->post('/notifications/clear', [\App\Http\Controllers\NotificationController::class, 'clear'])->name('notifications.clear');


use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Carbon\Carbon;

// Models
use App\Models\Product;

// Controllers
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\SavedListController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\EmployeeInventoryController;
use App\Http\Controllers\EmployeeProductController;
use App\Http\Controllers\EmployeeOrderController;
use App\Http\Controllers\EmployeeQuoteController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

/*
|--------------------------------------------------------------------------
| Public Pages
|--------------------------------------------------------------------------
*/

// Home page - main website homepage
Route::get('/', function () {
    return view('website.index');
})->name('home');

// Browse listing (simple page)
Route::get('/browse', function () {
    // Public lightweight browse: show only active and in-stock products
    $products = Product::where('is_active', 1)
        ->where('stock', '>', 0)
        ->orderByDesc('created_at')
        ->get();
    return view('browse', compact('products'));
})->name('browse');

// Shop with search/filter
Route::get('/shop', function (Request $request) {
    $q = $request->input('q');

    $products = Product::where('is_active', 1)
        ->when($q, function ($query, $q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%")
                    ->orWhere('unit_price', 'like', "%{$q}%");
            });
        })
        ->orderByDesc('created_at')
        ->get();

    return view('shop.index', compact('products', 'q'));
})->name('shop.index');

// Product details (uses EmployeeProductController@show for now)
Route::get('/products/{product}', [EmployeeProductController::class, 'show'])
    ->name('products.show');

// Auth welcome splash (optional)
Route::get('/auth/welcome', fn() => view('auth.welcome'))->name('auth.welcome');

// Newsletter subscribe (demo)
Route::post('/newsletter/subscribe', function (Request $request) {
    $request->validate(['email' => 'required|email']);
    return back()->with('success', 'Thank you for subscribing!');
})->name('newsletter.subscribe');

// Demo route (real-time date)
Route::get('/realtime-date', function () {
    $now = Carbon::now();
    return 'Current Date and Time: ' . $now->format('F d, Y h:i A');
});

// Dashboard search (demo)
Route::get('/dashboard/search', function (Request $request) {
    $q = $request->input('q');
    return view('dashboard.search', ['q' => $q]);
})->name('dashboard.search');


/*
|--------------------------------------------------------------------------
| Authenticated (Users)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // Main dashboard with widgets
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile',  [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',[ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',[ProfileController::class, 'destroy'])->name('profile.destroy');

    // Cart / Checkout
    Route::get('/cart',                [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add',           [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update',        [CartController::class, 'update'])->name('cart.update');
    Route::get('/cart/checkout',       [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/cart/checkout',      [CartController::class, 'processCheckout'])->name('cart.checkout.process');
    Route::post('/cart/place-order',   [CartController::class, 'processCheckout'])->name('cart.place-order');

    // Orders (user)
    Route::get('/orders',              [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}',      [OrderController::class, 'show'])->name('orders.show');

    // ⚠️ Changed to avoid conflict with orders.show
    Route::get('/orders/{order}/receipt', [CartController::class, 'orderReceipt'])->name('orders.receipt');

    // Settings
    Route::view('/settings', 'dashboard.settings')->name('settings');
    Route::post('/settings/delivery-address', [SettingsController::class, 'saveDeliveryAddress'])->name('settings.saveDeliveryAddress');
    Route::post('/settings/payment-details',  [SettingsController::class, 'savePaymentDetails'])->name('settings.savePaymentDetails');
    Route::post('/settings/basic-info', [SettingsController::class, 'saveBasicInfo'])->name('settings.saveBasicInfo');

    // Quotes (user flow)
    Route::get('/quotes/create', [QuoteController::class, 'create'])->name('quotes.create');
    Route::post('/quotes',       [QuoteController::class, 'store'])->name('quotes.store');
    Route::get('/quotes/pdf/{quote}', [QuoteController::class, 'pdf'])->name('quotes.pdf');

    // User quotes dashboard
    Route::get('/dashboard/quotes', [QuoteController::class, 'userQuotes'])->name('dashboard.user.quotes');

    // Saved Items (Wishlist)
    Route::get('/saved',        [SavedListController::class, 'index'])->name('saved.index');
    Route::post('/saved',       [SavedListController::class, 'store'])->name('saved.store');
    Route::delete('/saved/{id}',[SavedListController::class, 'destroy'])->name('saved.destroy');

    // Chat (user)
    Route::get('/chats', fn() => view('dashboard.chat'))->name('chat.page');
    Route::get('/chat/fetch', [ChatController::class, 'fetch']);
    Route::post('/chat/send', [ChatController::class, 'send']);
    Route::post('/chat/clear',[ChatController::class, 'clear']);
});

/*
|--------------------------------------------------------------------------
| Employee area
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // Simple employee home (authorization check inline; consider moving to middleware)
    Route::get('/employee/dashboard', function () {
        if (!auth()->user() || !method_exists(auth()->user(), 'isEmployee') || !auth()->user()->isEmployee()) {
            abort(403, 'Unauthorized');
        }
        $notifications = [];
        return view('dashboard.employee', compact('notifications'));
    })->name('employee.dashboard');

    // Employee: Inventory / Products / Orders / Quotes
    Route::prefix('employee')->name('employee.')->group(function () {

    // Employee edit quote
    Route::get('/quotes-management/{quote}/edit', [\App\Http\Controllers\EmployeeQuoteController::class, 'edit'])->name('quotes.edit');

        // Inventory
        Route::get('/inventory',                 [EmployeeInventoryController::class, 'index'])->name('inventory.index');
        Route::patch('/inventory/{product}',     [EmployeeInventoryController::class, 'update'])->name('inventory.update');

        // Products
        Route::get('/products',                  [EmployeeProductController::class, 'index'])->name('products.index');
        Route::post('/products',                 [EmployeeProductController::class, 'store'])->name('products.store');
        Route::get('/products/{product}/edit',   [EmployeeProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}',        [EmployeeProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}',     [EmployeeProductController::class, 'destroy'])->name('products.destroy');

        // Orders
        Route::get('/orders',                    [EmployeeOrderController::class, 'index'])->name('orders.index');
        Route::patch('/orders/{order}/done',     [EmployeeOrderController::class, 'markAsDone'])->name('orders.done');
        Route::post('/orders/{order}/upload',    [EmployeeOrderController::class, 'uploadReceipt'])->name('orders.upload');
        Route::delete('/orders/{order}',         [EmployeeOrderController::class, 'destroy'])->name('orders.destroy');

    // Employee create quote
    Route::get('/quotes-management/create', [EmployeeQuoteController::class, 'create'])->name('quotes.create');
    Route::post('/quotes-management/manual', [EmployeeQuoteController::class, 'manualCreate'])->name('quotes.manual.create');
    // Manual quote creation form (missing route)
    Route::get('/quotes-management/manual/create', [EmployeeQuoteController::class, 'manualCreateForm'])->name('quotes.manual.create.form');
    Route::post('/quotes-management', [EmployeeQuoteController::class, 'store'])->name('quotes.store');
    Route::put('/quotes-management/{quote}', [EmployeeQuoteController::class, 'update'])->name('quotes.update');
    // Quotes (employee manages)
        Route::get('/quotes-management',                 [EmployeeQuoteController::class, 'index'])->name('quotes.management.index');
        Route::post('/quotes-management/{quote}/upload', [EmployeeQuoteController::class, 'upload'])->name('quotes.upload');
        Route::patch('/quotes-management/{quote}/done',  [EmployeeQuoteController::class, 'markAsDone'])->name('quotes.management.done');
        Route::patch('/quotes-management/{quote}/cancel',[EmployeeQuoteController::class, 'cancel'])->name('quotes.management.cancel');
        Route::delete('/quotes-management/{quote}',      [EmployeeQuoteController::class, 'destroy'])->name('quotes.management.destroy');

        // Quotes list/detail for employees
        Route::get('/quotes',                 [QuoteController::class, 'employeeIndex'])->name('quotes.index');
        Route::get('/quotes/{quote}',         [QuoteController::class, 'employeeShow'])->name('quotes.show');

        // Employee chat page
        Route::get('/chats', function () {
            $notifications = [];
            return view('dashboard.employee_chat', compact('notifications'));
        })->name('chat.page');
    });

    // Chat: user list for employees
    Route::get('/chat/users', [ChatController::class, 'userList'])->name('chat.users');
});

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'can:access-admin'])->prefix('admin')->name('admin.')->group(function () {
    // User Management (redirect /users to /user-management)
    Route::redirect('/users', '/admin/user-management');
    Route::get('/user-management', [\App\Http\Controllers\Admin\UserManagementController::class, 'index'])->name('user_management');
    Route::get('/user-management/{id}/view', [\App\Http\Controllers\Admin\UserManagementController::class, 'view'])->name('user_management.view');
    Route::get('/user-management/{id}/edit', [\App\Http\Controllers\Admin\UserManagementController::class, 'edit'])->name('user_management.edit');
    Route::put('/user-management/{id}/edit', [\App\Http\Controllers\Admin\UserManagementController::class, 'update'])->name('user_management.edit');
    Route::delete('/user-management/{id}/delete', [\App\Http\Controllers\Admin\UserManagementController::class, 'delete'])->name('user_management.delete');
    Route::view('/brands',          'admin.placeholders.brands')->name('brands');
    Route::view('/business',        'admin.placeholders.business')->name('business');
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::view('/settings',        'admin.placeholders.settings')->name('settings');
    Route::view('/users',           'admin.placeholders.users')->name('users');
    Route::get('/orders', function () {
        $orders = \App\Models\Order::with('user')->orderByDesc('created_at')->paginate(20);
        return view('admin.orders', compact('orders'));
    })->name('orders');

    Route::get('/orders/{order}', function ($orderId) {
        $order = \App\Models\Order::with(['user', 'items.product'])->findOrFail($orderId);
        return view('admin.order-view', compact('order'));
    })->name('orders.view');
    // Admin Product Management
    Route::get('/products', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('products');
    Route::post('/products', [\App\Http\Controllers\Admin\ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [\App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [\App\Http\Controllers\Admin\ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [\App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('products.destroy');
    Route::view('/analytics',       'admin.placeholders.analytics')->name('analytics');
    Route::get('/quotes', function () {
        $quotes = \App\Models\Quote::with('user')->orderByDesc('created_at')->paginate(20);
        return view('admin.quotes', compact('quotes'));
    })->name('quotes');

    Route::get('/quotes/{quote}', function ($quoteId) {
        $quote = \App\Models\Quote::with(['user', 'items.product'])->findOrFail($quoteId);
        return view('admin.quote-view', compact('quote'));
    })->name('quotes.view');
    Route::view('/uploads',         'admin.placeholders.uploads')->name('uploads');
    Route::view('/approvals',       'admin.placeholders.approvals')->name('approvals');
    Route::view('/export',          'admin.placeholders.export')->name('export');
    Route::view('/stock',           'admin.placeholders.stock')->name('stock');
    Route::view('/pricing',         'admin.placeholders.pricing')->name('pricing');
    Route::view('/documents',       'admin.placeholders.documents')->name('documents');
    Route::view('/brands',          'admin.placeholders.brands')->name('brands');
    Route::view('/roles',           'admin.placeholders.roles')->name('roles');
    Route::view('/business',        'admin.placeholders.business')->name('business');
    Route::get('/audit', [\App\Http\Controllers\Admin\AuditLogController::class, 'index'])->name('audit');
    Route::get('/audit/print-all', [\App\Http\Controllers\Admin\AuditLogController::class, 'printAll'])->name('audit.printAll');
    Route::get('/audit/save-all', [\App\Http\Controllers\Admin\AuditLogController::class, 'saveAll'])->name('audit.saveAll');
    Route::view('/freight',         'admin.placeholders.freight')->name('freight');
    Route::view('/site-settings',   'admin.placeholders.site_settings')->name('site_settings');
});

// Admin AJAX route for audit log filtering/search
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    Route::get('/audit/filter', [\App\Http\Controllers\Admin\AuditLogAjaxController::class, 'filter'])->name('admin.audit.filter');
    // Export all logs for printing/exporting
    Route::get('/audit/export/all', [\App\Http\Controllers\Admin\AuditLogExportController::class, 'all'])->name('admin.audit.export.all');
});

/*
|--------------------------------------------------------------------------
| Auth scaffolding (Breeze/Fortify/etc.)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
