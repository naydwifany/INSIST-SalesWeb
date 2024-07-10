<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;
    use HasFactory;

    protected $primaryKey = 'ID_User'; // Tambahkan properti primaryKey

    protected $fillable = [
        'NameUser', 'EmailUser', 'MobilePhoneUser', 'SecurityQuestion', 'Answer', 'Password', 'UserPosition', 'UserStatus'
    ];

    public static $positions = ['Admin/Finance', 'Sales', 'Technical', 'Manager'];

    protected $hidden = [
        'Password', 'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['Password'] = Hash::make($value);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (!preg_match('/@insist\.co\.id$/', $user->EmailUser)) {
                throw new \Exception('Email harus berakhiran dengan @insist.co.id');
            }
        });
    }
}