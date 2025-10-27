<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Carbon\Carbon;

// Models
use App\Models\Product;

// Public / Site Controllers
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ContactSubmissionController;
use App\Http\Controllers\InquiryController;

// Employee Controllers
use App\Http\Controllers\EmployeeInquiryController;
use App\Http\Controllers\EmployeeContactSubmissionController;
use App\Http\Controllers\EmployeeInventoryController;
use App\Http\Controllers\EmployeeProductController;
use App\Http\Controllers\EmployeeOrderController;
use App\Http\Controllers\EmployeeQuoteController;
use App\Http\Controllers\EmployeeInvoiceController;
use App\Http\Controllers\EmployeePaymentController;
use App\Http\Controllers\EmployeeBillController;
use App\Http\Controllers\EmployeeExpenseController;
use App\Http\Controllers\EmployeeCreditController;
use App\Http\Controllers\EmployeeTaxReportController;
use App\Http\Controllers\EmployeeStatementController;

// User Dashboard Controllers
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\SavedListController;
use App\Http\Controllers\ChatController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\AuditLogController;
use App\Http\Controllers\Admin\AuditLogAjaxController;
use App\Http\Controllers\Admin\AuditLogExportController;

/*
|--------------------------------------------------------------------------
| Real-time notification polling
|--------------------------------------------------------------------------
*/
Route::get('/notifications/fetch', [NotificationController::class, 'fetch'])->middleware('auth');
Route::middleware(['auth', 'verified'])->post('/notifications/clear', [NotificationController::class, 'clear'])->name('notifications.clear');

/*
|--------------------------------------------------------------------------
| Static Website Pages
|--------------------------------------------------------------------------
*/
Route::view('/about', 'website.about');
Route::view('/contact', 'website.contact')->name('contact');
Route::post('/contact/submit', [ContactSubmissionController::class, 'submit'])->name('contact.submit');

Route::view('/customerfeedback', 'website.customerfeedback');
Route::view('/customer-feedback', 'website.customerfeedback'); // alias

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
Route::view('/services', 'website.services');

// Legacy redirects
Route::redirect('/soil-testing', '/soil', 301);
Route::redirect('/steel-testing', '/steel', 301);

// Public inquiry submission
Route::post('/inquiry/submit', [InquiryController::class, 'submit'])->name('inquiry.submit');

// Static homepage test
Route::get('/static', fn () => view('website.index'))->name('static');

/*
|--------------------------------------------------------------------------
| AJAX: Landing search (public)
|--------------------------------------------------------------------------
*/
Route::get('/landing-search', function (Request $request) {
    $q = $request->input('q');

    $products = Product::where('is_active', 1)
        ->where(function ($query) use ($q) {
            $query->where('name', 'like', "%{$q}%")
                  ->orWhere('description', 'like', "%{$q}%")
                  ->orWhere('unit_price', 'like', "%{$q}%")
                  ->orWhere('sku', 'like', "%{$q}%");
        })
        ->orderByDesc('created_at')
        ->limit(10)
        ->get();

    $results = $products->map(function ($p) {
        return [
            'id'        => $p->id,
            'name'      => $p->name,
            'sku'       => $p->sku,
            'price'     => $p->unit_price,
            'image_url' => (method_exists($p, 'firstImagePath') && $p->firstImagePath())
                ? asset('storage/' . $p->firstImagePath())
                : asset('images/gemarclogo.png'),
        ];
    });

    return response()->json($results);
})->name('landing.search');

/*
|--------------------------------------------------------------------------
| Public Pages
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', fn () => view('website.index'))->name('home');

// Browse (simple)
Route::get('/browse', function () {
    $products = Product::where('is_active', 1)
        ->where('stock', '>', 0)
        ->orderByDesc('created_at')
        ->get();

    return view('browse', compact('products'));
})->name('browse');

// Shop with search
Route::get('/shop', function (Request $request) {
    $q = $request->input('q');

    $products = Product::where('is_active', 1)
        ->when($q, function ($query) use ($q) {
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

// Product details
Route::get('/products/{product}', [EmployeeProductController::class, 'show'])->name('products.show');

// Misc demos
Route::get('/auth/welcome', fn () => view('auth.welcome'))->name('auth.welcome');
Route::post('/newsletter/subscribe', function (Request $request) {
    $request->validate(['email' => 'required|email']);
    return back()->with('success', 'Thank you for subscribing!');
})->name('newsletter.subscribe');
Route::get('/realtime-date', fn () => 'Current Date and Time: ' . Carbon::now()->format('F d, Y h:i A'));
Route::get('/dashboard/search', fn (Request $request) => view('dashboard.search', ['q' => $request->input('q')]))->name('dashboard.search');

/*
|--------------------------------------------------------------------------
| Authenticated (Users)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile',  [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

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
    Route::get('/orders/{order}/receipt', [CartController::class, 'orderReceipt'])->name('orders.receipt');

    // Settings
    Route::view('/settings', 'dashboard.settings')->name('settings');
    Route::post('/settings/delivery-address', [SettingsController::class, 'saveDeliveryAddress'])->name('settings.saveDeliveryAddress');
    Route::post('/settings/payment-details',  [SettingsController::class, 'savePaymentDetails'])->name('settings.savePaymentDetails');
    Route::post('/settings/basic-info',       [SettingsController::class, 'saveBasicInfo'])->name('settings.saveBasicInfo');

    // Quotes (user flow)
    Route::get('/quotes/create',       [QuoteController::class, 'create'])->name('quotes.create');
    Route::post('/quotes',             [QuoteController::class, 'store'])->name('quotes.store');
    Route::get('/quotes/pdf/{quote}',  [QuoteController::class, 'pdf'])->name('quotes.pdf');
    Route::get('/dashboard/quotes',    [QuoteController::class, 'userQuotes'])->name('dashboard.user.quotes');

    // Saved (wishlist)
    Route::get('/saved',        [SavedListController::class, 'index'])->name('saved.index');
    Route::post('/saved',       [SavedListController::class, 'store'])->name('saved.store');
    Route::delete('/saved/{id}',[SavedListController::class, 'destroy'])->name('saved.destroy');

    // Chat (user)
    Route::get('/chats', fn () => view('dashboard.chat'))->name('chat.page');
    Route::get('/chat/fetch', [ChatController::class, 'fetch']);
    Route::post('/chat/send', [ChatController::class, 'send']);
    Route::post('/chat/clear', [ChatController::class, 'clear']);
});

/*
|--------------------------------------------------------------------------
| Employee Area
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // Employee dashboard
    Route::get('/employee/dashboard', fn () => view('dashboard.employee'))->name('employee.dashboard');

    // Product Inquiries page
    Route::get('/employee/inquiries', [InquiryController::class, 'index'])->name('employee.inquiries.index');

    // Clear (DELETE) handlers — used by the "Clear" buttons on the page
    Route::delete('/employee/inquiries/clear', [EmployeeInquiryController::class, 'clearInquiries'])->name('employee.inquiries.clear');
    Route::delete('/employee/contacts/clear',  [EmployeeInquiryController::class, 'clearContacts'])->name('employee.contacts.clear');

    // Contact submissions page + clear
    Route::get('/employee/contact-submissions', [EmployeeContactSubmissionController::class, 'index'])->name('employee.contact_submissions');
    Route::post('/employee/contact-submissions/clear', [EmployeeContactSubmissionController::class, 'clear'])->name('employee.contact_submissions.clear');

    // Inventory
    Route::get('/employee/inventory',             [EmployeeInventoryController::class, 'index'])->name('employee.inventory.index');
    Route::patch('/employee/inventory/{product}', [EmployeeInventoryController::class, 'update'])->name('employee.inventory.update');

    // Products
    Route::get('/employee/products',                [EmployeeProductController::class, 'index'])->name('employee.products.index');
    Route::post('/employee/products',               [EmployeeProductController::class, 'store'])->name('employee.products.store');
    Route::get('/employee/products/{product}/edit', [EmployeeProductController::class, 'edit'])->name('employee.products.edit');
    Route::put('/employee/products/{product}',      [EmployeeProductController::class, 'update'])->name('employee.products.update');
    Route::delete('/employee/products/{product}',   [EmployeeProductController::class, 'destroy'])->name('employee.products.destroy');

    // Orders
    Route::get('/employee/orders',                    [EmployeeOrderController::class, 'index'])->name('employee.orders.index');
    Route::patch('/employee/orders/{order}/done',     [EmployeeOrderController::class, 'markAsDone'])->name('employee.orders.done');
    Route::post('/employee/orders/{order}/upload',    [EmployeeOrderController::class, 'uploadReceipt'])->name('employee.orders.upload');
    Route::delete('/employee/orders/{order}',         [EmployeeOrderController::class, 'destroy'])->name('employee.orders.destroy');

    // Quotes management (employee)
    Route::get('/employee/quotes-management',                    [EmployeeQuoteController::class, 'index'])->name('employee.quotes.management.index');
    Route::get('/employee/quotes-management/create',            [EmployeeQuoteController::class, 'create'])->name('employee.quotes.create');
    Route::post('/employee/quotes-management',                  [EmployeeQuoteController::class, 'store'])->name('employee.quotes.store');
    Route::get('/employee/quotes-management/{quote}/edit',      [EmployeeQuoteController::class, 'edit'])->name('employee.quotes.edit');
    Route::put('/employee/quotes-management/{quote}',           [EmployeeQuoteController::class, 'update'])->name('employee.quotes.update');
    Route::post('/employee/quotes-management/{quote}/upload',   [EmployeeQuoteController::class, 'upload'])->name('employee.quotes.upload');
    Route::patch('/employee/quotes-management/{quote}/done',    [EmployeeQuoteController::class, 'markAsDone'])->name('employee.quotes.management.done');
    Route::patch('/employee/quotes-management/{quote}/cancel',  [EmployeeQuoteController::class, 'cancel'])->name('employee.quotes.management.cancel');
    Route::delete('/employee/quotes-management/{quote}',        [EmployeeQuoteController::class, 'destroy'])->name('employee.quotes.management.destroy');

    // Manual quote creation
    Route::get('/employee/quotes-management/manual/create', [EmployeeQuoteController::class, 'manualCreateForm'])->name('employee.quotes.manual.create.form');
    Route::post('/employee/quotes-management/manual',       [EmployeeQuoteController::class, 'manualCreate'])->name('employee.quotes.manual.create');

    // Employee list/detail for quotes
    Route::get('/employee/quotes',        [QuoteController::class, 'employeeIndex'])->name('employee.quotes.index');
    Route::get('/employee/quotes/{quote}',[QuoteController::class, 'employeeShow'])->name('employee.quotes.show');

    // Employee chat page
    Route::get('/employee/chats', fn () => view('dashboard.employee_chat'))->name('employee.chat.page');

    // Finance modules
    Route::get('/employee/invoices',   [EmployeeInvoiceController::class, 'index'])->name('employee.invoices.index');
    Route::get('/employee/payments',   [EmployeePaymentController::class,  'index'])->name('employee.payments.index');
    Route::get('/employee/bills',      [EmployeeBillController::class,     'index'])->name('employee.bills.index');
    Route::get('/employee/expenses',   [EmployeeExpenseController::class,  'index'])->name('employee.expenses.index');
    Route::get('/employee/credits',    [EmployeeCreditController::class,   'index'])->name('employee.credits.index');
    Route::get('/employee/tax-reports',[EmployeeTaxReportController::class,'index'])->name('employee.tax-reports.index');
    Route::get('/employee/statements', [EmployeeStatementController::class,'index'])->name('employee.statements.index');
});

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'can:access-admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Users
        Route::redirect('/users', '/admin/user-management');
        Route::get('/user-management',                 [UserManagementController::class, 'index'])->name('user_management');
        Route::get('/user-management/{id}/view',       [UserManagementController::class, 'view'])->name('user_management.view');
        Route::get('/user-management/{id}/edit',       [UserManagementController::class, 'edit'])->name('user_management.edit');
        Route::put('/user-management/{id}/edit',       [UserManagementController::class, 'update'])->name('user_management.update');
        Route::delete('/user-management/{id}/delete',  [UserManagementController::class, 'delete'])->name('user_management.delete');
        Route::post('/user-management/add',            [UserManagementController::class, 'add'])->name('user_management.add');

        // Products (Admin)
        Route::get('/products',                [AdminProductController::class, 'index'])->name('products');
        Route::post('/products',               [AdminProductController::class, 'store'])->name('products.store');
        Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}',      [AdminProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}',   [AdminProductController::class, 'destroy'])->name('products.destroy');

        // Orders (sample)
        Route::get('/orders', function () {
            $orders = \App\Models\Order::with('user')->orderByDesc('created_at')->paginate(20);
            return view('admin.orders', compact('orders'));
        })->name('orders');

        Route::get('/orders/{order}', function ($orderId) {
            $order = \App\Models\Order::with(['user', 'items.product'])->findOrFail($orderId);
            return view('admin.order-view', compact('order'));
        })->name('orders.view');

        // Quotes (sample)
        Route::get('/quotes', function () {
            $quotes = \App\Models\Quote::with('user')->orderByDesc('created_at')->paginate(20);
            return view('admin.quotes', compact('quotes'));
        })->name('quotes');

        Route::get('/quotes/{quote}', function ($quoteId) {
            $quote = \App\Models\Quote::with(['user', 'items.product'])->findOrFail($quoteId);
            return view('admin.quote-view', compact('quote'));
        })->name('quotes.view');

        // Audit
        Route::get('/audit',            [AuditLogController::class, 'index'])->name('audit');
        Route::get('/audit/print-all',  [AuditLogController::class, 'printAll'])->name('audit.printAll');
        Route::get('/audit/save-all',   [AuditLogController::class, 'saveAll'])->name('audit.saveAll');
        Route::post('/audit/clear',     [AuditLogController::class, 'clear'])->name('audit.clear');

        // AJAX for audit
        Route::get('/audit/filter',     [AuditLogAjaxController::class, 'filter'])->name('audit.filter');
        Route::get('/audit/export/all', [AuditLogExportController::class, 'all'])->name('audit.export.all');

        // Simple admin static pages
        Route::view('/analytics',      'admin.placeholders.analytics')->name('analytics');
        Route::view('/uploads',        'admin.placeholders.uploads')->name('uploads');
        Route::view('/approvals',      'admin.placeholders.approvals')->name('approvals');
        Route::view('/export',         'admin.placeholders.export')->name('export');
        Route::view('/stock',          'admin.placeholders.stock')->name('stock');
        Route::view('/pricing',        'admin.placeholders.pricing')->name('pricing');
        Route::view('/documents',      'admin.placeholders.documents')->name('documents');
        Route::view('/brands',         'admin.placeholders.brands')->name('brands');
        Route::view('/roles',          'admin.placeholders.roles')->name('roles');
        Route::view('/business',       'admin.placeholders.business')->name('business');
        Route::view('/freight',        'admin.placeholders.freight')->name('freight');
        Route::view('/site-settings',  'admin.placeholders.site_settings')->name('site_settings');

        // Admin Chats
        Route::view('/chats', 'admin.chats')->name('chats');
        Route::get('/chat/users', function () {
            $users = \App\Models\User::where('id', '!=', auth()->id())->get(['id','name','email']);
            return response()->json($users);
        });
        Route::get('/chat/fetch', function (Request $request) {
            $admin      = auth()->user();
            $withUserId = $request->input('with_user_id');
            $context    = $request->input('context');

            $messages = \DB::table('chat_messages')
                ->where(function ($q) use ($admin, $withUserId) {
                    $q->where('sender_id', $admin->id)->where('receiver_id', $withUserId)
                      ->orWhere('sender_id', $withUserId)->where('receiver_id', $admin->id);
                })
                ->where('context', $context)
                ->orderBy('created_at')
                ->get();

            return response()->json($messages);
        });
        Route::post('/chat/send', function (Request $request) {
            $request->validate([
                'message'    => 'required|string|max:1000',
                'to_user_id' => 'required|integer|exists:users,id',
                'context'    => 'required|string',
            ]);

            $admin      = auth()->user();
            $receiverId = $request->to_user_id;
            $context    = $request->context;

            \DB::table('chat_messages')->insert([
                'sender_id'   => $admin->id,
                'receiver_id' => $receiverId,
                'message'     => $request->message,
                'context'     => $context,
                'created_at'  => now(),
            ]);

            return response()->json(['success' => true]);
        });
    });

/*
|--------------------------------------------------------------------------
| Auth scaffolding
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
