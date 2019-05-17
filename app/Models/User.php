<?php

namespace App\Models;

use App\Tenant\TenantModels;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use phpDocumentor\Reflection\Types\Parent_;

class User extends Authenticatable
{
    use Notifiable, TenantModels;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function createAdmin(array $attributes)
    {
        $user = self::create($attributes);
        $admin = Admin::create([]);
        $user->userable()->assciate($admin);
        return $user;
    }

    public static function createUserTenant(array $attributes)
    {
        $user = self::create($attributes);
        $admin = UserTenant::create([]);
        $user->userable()->assciate($admin);
        return $user;
    }

    public function fill(array $attributes)
    {
        !isset($attributes['password'])?: $attributes['password'] = bcrypt($attributes['password']);
        return parent::fill($attributes);

    }

    public function userable()
    {
        return $this->morphTo();
    }
}
