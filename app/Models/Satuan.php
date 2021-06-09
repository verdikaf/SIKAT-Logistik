<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    protected $table = 'satuan';
    public $timestamps = false;

    public function logistik()
    {
        return $this->hasMany(Logistik::class);
    }
}
