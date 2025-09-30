<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('payment_method')->nullable()->after('status');
            $table->string('delivery_method')->nullable()->after('payment_method');
        });
    }
    public function down(): void {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['payment_method', 'delivery_method']);
        });
    }
};
