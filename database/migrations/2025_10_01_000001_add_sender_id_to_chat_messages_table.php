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
        Schema::table('chat_messages', function (Blueprint $table) {
            if (!Schema::hasColumn('chat_messages', 'sender_id')) {
                $table->unsignedBigInteger('sender_id')->after('id');
                // Optionally, add foreign key if users table exists:
                // $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chat_messages', function (Blueprint $table) {
            if (Schema::hasColumn('chat_messages', 'sender_id')) {
                $table->dropColumn('sender_id');
            }
        });
    }
};
