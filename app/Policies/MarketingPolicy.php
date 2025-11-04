<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MarketingPolicy
{
    use HandlesAuthorization;

    public function manageMarketing(User $user)
    {
        return $user->role === 'marketing' || $user->role === 'admin';
    }
}