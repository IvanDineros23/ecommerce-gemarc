<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('cart_items', 'cart_id')) {
            Schema::table('cart_items', function (Blueprint $table) {
                $table->unsignedBigInteger('cart_id')->nullable()->after('id');
                $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('cart_items', 'cart_id')) {
            Schema::table('cart_items', function (Blueprint $table) {
                $table->dropForeign(['cart_id']);
                $table->dropColumn('cart_id');
            });
        }
    }
};
