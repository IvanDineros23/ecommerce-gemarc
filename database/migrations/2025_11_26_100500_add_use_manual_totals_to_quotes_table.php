<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('quotes', function (Blueprint $table) {
            if (!Schema::hasColumn('quotes', 'use_manual_totals')) {
                $table->boolean('use_manual_totals')->default(false)->after('vat');
            }
        });
    }

    public function down()
    {
        Schema::table('quotes', function (Blueprint $table) {
            if (Schema::hasColumn('quotes', 'use_manual_totals')) {
                $table->dropColumn('use_manual_totals');
            }
        });
    }
};
