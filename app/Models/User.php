<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    // Always return address, fallback to delivery_option['address'] if empty
    public function getAddressAttribute($value)
    {
        if (!empty($value)) {
            return $value;
        }
        if (is_array($this->delivery_option) && !empty($this->delivery_option['address'])) {
            return $this->delivery_option['address'];
        }
        return null;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'address',
        'contact_no',
        'password',
        'payment_details',
        'delivery_option',
    ];

    protected $casts = [
        'payment_details' => 'array',
        'delivery_option' => 'array',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Add this method to check if user is admin
    public function isAdmin()
    {
        // Now checks the 'role' column for 'admin'
        return $this->role === 'admin';
    }
    public function isEmployee()
    {
        return $this->role === 'employee';
    }
    public function isUser()
    {
        return $this->role === 'user';
    }
}
