<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'sku')) {
                $table->string('sku')->unique()->nullable()->after('id');
            }
            if (!Schema::hasColumn('products', 'slug')) {
                $table->string('slug')->unique()->nullable()->after('name');
            }
            if (!Schema::hasColumn('products', 'stock_qty')) {
                $table->unsignedInteger('stock_qty')->default(0)->after('price');
            }
            // Only rename if 'price' exists and 'unit_price' does not
            if (Schema::hasColumn('products', 'price') && !Schema::hasColumn('products', 'unit_price')) {
                $table->renameColumn('price', 'unit_price');
            }
            // Only add if neither exists (should not happen, but for safety)
            if (!Schema::hasColumn('products', 'unit_price') && !Schema::hasColumn('products', 'price')) {
                $table->decimal('unit_price', 10, 2)->default(0)->after('stock_qty');
            }
        });
        Schema::table('product_images', function (Blueprint $table) {
            if (!Schema::hasColumn('product_images', 'is_primary')) {
                $table->boolean('is_primary')->default(false)->after('path');
            }
        });
        Schema::table('cart_items', function (Blueprint $table) {
            if (!Schema::hasColumn('cart_items', 'qty')) {
                $table->integer('qty')->default(1)->after('cart_id');
            }
            if (Schema::hasColumn('cart_items', 'quantity')) {
                $table->dropColumn('quantity');
            }
            if (Schema::hasColumn('cart_items', 'price')) {
                $table->renameColumn('price', 'unit_price');
            }
        });
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'reference_number')) {
                $table->string('reference_number')->unique()->nullable()->after('id');
            }
            if (!Schema::hasColumn('orders', 'subtotal_amount')) {
                $table->decimal('subtotal_amount', 12, 2)->default(0)->after('status');
            }
            if (!Schema::hasColumn('orders', 'shipping_amount')) {
                $table->decimal('shipping_amount', 12, 2)->default(0)->after('subtotal_amount');
            }
            if (!Schema::hasColumn('orders', 'tax_amount')) {
                $table->decimal('tax_amount', 12, 2)->default(0)->after('shipping_amount');
            }
            if (!Schema::hasColumn('orders', 'ship_to_name')) {
                $table->string('ship_to_name')->nullable()->after('total_amount');
            }
            if (!Schema::hasColumn('orders', 'ship_to_address')) {
                $table->string('ship_to_address')->nullable()->after('ship_to_name');
            }
            if (!Schema::hasColumn('orders', 'notes')) {
                $table->text('notes')->nullable()->after('ship_to_address');
            }
        });
        Schema::table('order_items', function (Blueprint $table) {
            if (!Schema::hasColumn('order_items', 'name')) {
                $table->string('name')->nullable()->after('product_id');
            }
        });
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('customer')->after('password');
            }
        });
    }
    public function down(): void {
        // No-op for MVP patch
    }
};
