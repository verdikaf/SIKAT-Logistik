<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logistik extends Model
{
    protected $table = 'logistik';
    public $timestamps = false;

    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }

    public function satuan(){
        return $this->belongsTo(Satuan::class);
    }

    public function supplier(){
        return $this->belongsToMany(Supplier::class, 'supplier_logistik');
    }

    public function transaksi(){
        return $this->belongsToMany(Transaksi::class, 'transaction_line');
    }

    public function logistik_rusak(){
        return $this->hasOne(LogistikRusak::class);
    }
}
