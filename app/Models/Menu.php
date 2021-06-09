<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    public $timestamps = false;

    public function role(){
        return $this->belongsTo(Role::class);
    }
}
