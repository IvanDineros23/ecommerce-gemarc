<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quotes', function (Blueprint $table) {
            if (!Schema::hasColumn('quotes', 'subtotal')) {
                $table->decimal('subtotal', 14, 2)->nullable()->default(0)->after('total');
            }
            if (!Schema::hasColumn('quotes', 'vat')) {
                $table->decimal('vat', 14, 2)->nullable()->default(0)->after('subtotal');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quotes', function (Blueprint $table) {
            if (Schema::hasColumn('quotes', 'vat')) {
                $table->dropColumn('vat');
            }
            if (Schema::hasColumn('quotes', 'subtotal')) {
                $table->dropColumn('subtotal');
            }
        });
    }
};
