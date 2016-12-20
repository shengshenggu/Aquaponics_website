<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    protected $guarded = [];
	/*
	 * 取得此農場紀錄的植物
	 */
    public function plant()
    {
        return $this->hasOne('App\Plant', 'id', 'plant_id');
    }
    
    /*
	 * 取得此農場紀錄的使用者
	 */
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
