<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class EmployeeNotification {
    public static function push($type, $data, $userId = null) {
        // Store in cache per employee
        $notif = [
            'type' => $type,
            'data' => $data,
            'created_at' => Carbon::now(),
        ];
        if (!$userId) {
            $userId = isset($data['user_id']) ? $data['user_id'] : null;
        }
        if (!$userId) return;
        $key = 'employee_notifications_' . $userId;
        $notifs = Cache::get($key, []);
        array_unshift($notifs, $notif); // newest first
        $notifs = array_slice($notifs, 0, 30); // keep only latest 30
        Cache::put($key, $notifs, now()->addDays(2));
    }
    public static function all($userId) {
        return Cache::get('employee_notifications_' . $userId, []);
    }
    public static function clear($userId) {
        Cache::forget('employee_notifications_' . $userId);
    }
}
