<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$admin = DB::table('users')->where('email', 'helpdesk@gemarcph.com')->orWhere('is_admin', 1)->first();
if (!$admin) {
    echo "No admin user found.\n";
    exit(0);
}

echo "id: {$admin->id}\n";
echo "email: {$admin->email}\n";
echo "is_admin: {$admin->is_admin}\n";
echo "role: " . ($admin->role ?? 'NULL') . "\n";
echo "email_verified_at: " . ($admin->email_verified_at ?? 'NULL') . "\n";
echo "created_at: {$admin->created_at}\n";
echo "updated_at: {$admin->updated_at}\n";
