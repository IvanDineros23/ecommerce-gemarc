<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->string('quote_status')->default('pending');
            $table->unsignedBigInteger('quote_id')->nullable();
            $table->string('quote_file_path')->nullable();
            $table->timestamp('quote_ready_at')->nullable();
        });
    }

    public function down()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn(['quote_status', 'quote_id', 'quote_file_path', 'quote_ready_at']);
        });
    }
};