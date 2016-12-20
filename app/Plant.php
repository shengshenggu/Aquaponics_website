<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
	protected $guarded = [];
	
	/**
     * 取得有種植該植物的農場紀錄
     */
    public function farms()
    {
    	return $this->hasMany('App\Farm');
    }
}
