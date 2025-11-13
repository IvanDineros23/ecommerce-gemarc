<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $email_verified_at
 * @property string $password
 * @property string|null $contact_no
 * @property string|null $address
 * @property string|null $profile_image
 * @property array|null $payment_details
 * @property array|null $delivery_option
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 */
class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;
    
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

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
        'role',
        'payment_details',
        'delivery_option',
        'profile_image',
        'department',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'payment_details' => 'array',
        'delivery_option' => 'array',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
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
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'email_verified_at',
        'deleted_at'
    ];

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
