<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    public $timestamps = false;
    
    public function pegawai()
    {
        return $this->hasMany(Pegawai::class);
    }

    public function menu()
    {
        return $this->hasMany(Menu::class);
    }
}
