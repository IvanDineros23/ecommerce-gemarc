<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class EmployeeNotification {
    public static function push($type, $data) {
        // Store in cache for all employees (simple demo, you may want DB for real app)
        $notif = [
            'type' => $type,
            'data' => $data,
            'created_at' => Carbon::now(),
        ];
        $key = 'employee_notifications';
        $notifs = Cache::get($key, []);
        array_unshift($notifs, $notif); // newest first
        $notifs = array_slice($notifs, 0, 30); // keep only latest 30
        Cache::put($key, $notifs, now()->addDays(2));
    }
    public static function all() {
        return Cache::get('employee_notifications', []);
    }
    public static function clear() {
        Cache::forget('employee_notifications');
    }
}
