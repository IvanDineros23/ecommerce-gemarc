<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('quote_id')->nullable()->after('user_id');
            $table->foreign('quote_id')->references('id')->on('quotes')->onDelete('set null');
        });
    }

    public function down(): void {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['quote_id']);
            $table->dropColumn('quote_id');
        });
    }
};