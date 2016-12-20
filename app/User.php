<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'email', 'password', 'temp_max', 'temp_min', 'pH_max', 'pH_min', 'period', 'status', 'group'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * 取得該使用者的環境值
     */
    public function environments()
    {
        return $this->hasMany('App\Environment');
    }

    /**
     * 取得該使用者的農場
     */
    public function farms()
    {
        return $this->hasMany('App\Farm');
    }

    /**
     * 取得使用者的照片
     */
    public function pictures()
    {
        return $this->hasMany('App\Picture');
    }
}
