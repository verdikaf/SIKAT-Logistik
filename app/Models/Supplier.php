<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'supplier';

    public function transaksi_masuk()
    {
        return $this->belongsToMany(TransaksiMasuk::class, 'supplier_transaksi');
    }
}
