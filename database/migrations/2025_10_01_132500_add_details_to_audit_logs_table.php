<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('audit_logs', function (Blueprint $table) {
              if (!Schema::hasColumn('audit_logs', 'details')) {
                 $table->string('details', 255)->nullable()->after('after_json');
              }
        });
    }
    public function down(): void
    {
        Schema::table('audit_logs', function (Blueprint $table) {
            $table->dropColumn('details');
        });
    }
};
