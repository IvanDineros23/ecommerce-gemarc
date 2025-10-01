<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('actor_user_id')->nullable();
            $table->string('action');
            $table->string('entity')->nullable();
            $table->unsignedBigInteger('entity_id')->nullable();
            $table->json('before_json')->nullable();
            $table->json('after_json')->nullable();
            $table->string('details')->nullable();
            $table->timestamps();

            $table->foreign('actor_user_id')->references('id')->on('users')->nullOnDelete();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
