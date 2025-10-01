<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up() {
        // Update all existing orders with missing reference_number
        DB::statement("
            UPDATE orders SET reference_number = CONCAT('GEI-', DATE_FORMAT(created_at, '%Y%m%d'), '-', UPPER(SUBSTRING(MD5(id), 1, 4)))
            WHERE reference_number IS NULL OR reference_number = ''
        ");
    }

    public function down() {
    // Optionally clear reference_number for rollback (set to empty string instead of NULL)
    DB::statement("UPDATE orders SET reference_number = '' WHERE reference_number LIKE 'GEI-%'");
    }
};
