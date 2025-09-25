<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ResetHelpdeskPasswordSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')
            ->where('email', 'helpdesk@gemarcph.com')
            ->update(['password' => Hash::make('Ivandineros23!')]);
        echo "Password reset for helpdesk@gemarcph.com\n";
    }
}
