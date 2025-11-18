<?php

namespace App\Actions\Fortify;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;

class UpdateUserPassword implements UpdatesUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and update the user's password.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            'current_password' => ['required', 'current_password'],
            'password'         => $this->passwordRules(),
        ], [], [
            'current_password' => 'current password',
        ])->validateWithBag('updatePassword');

        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();

        // Flash success status for toast
        session()->flash('status', 'password-updated');
    }
}
