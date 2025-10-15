<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up() {
        // Update all existing orders with missing reference_number
            $orders = \DB::table('orders')->get();

            foreach ($orders as $order) {
                // Format: GEI-YYYYMMDD-XXXX
                $date = date('Ymd', strtotime($order->created_at));
                $hash = strtoupper(substr(md5($order->id), 0, 4));
                $ref = "GEI-{$date}-{$hash}";

                \DB::table('orders')
                    ->where('id', $order->id)
                    ->update(['reference_number' => $ref]);
            }
    }

    public function down() {
    // Optionally clear reference_number for rollback (set to empty string instead of NULL)
    DB::statement("UPDATE orders SET reference_number = '' WHERE reference_number LIKE 'GEI-%'");
    }
};
