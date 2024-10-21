<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'user_code',
        'password',
        'email',
        'phone',
        'otp',
        'otp_expired',
        'thumbnail',
        'birthday',
        'gender',
        'address',
        'type_login',
        'email_verified_at',
        'remember_token',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function transactions_buyer()
    {
        return $this->hasMany(Transaction::class, 'buyer_id');
    }

    public function saldo()
    {
        return $this->hasOne(Saldo::class);
    }

    public function merchant()
    {
        return $this->hasOne(Merchant::class);
    }

    public function wallet()
    {
        return $this->hasOne(UserWallet::class);
    }
}
