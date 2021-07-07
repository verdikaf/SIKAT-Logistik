<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogistikRusak extends Model
{
    protected $table = 'logistik_rusak';
    protected $fillable = ['logistik_id'];
    public $timestamps = false;

    public function logistik()
    {
        return $this->belongsTo(Logistik::class);
    }
}
