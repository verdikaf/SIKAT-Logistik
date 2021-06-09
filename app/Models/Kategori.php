<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    public $timestamps = false;

    public function logistik()
    {
        return $this->hasMany(Logistik::class);
    }
}
