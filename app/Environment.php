<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Environment extends Model
{
    protected $guarded = [];
    
    /*
	 * 取得該環境的使用者
	 */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
