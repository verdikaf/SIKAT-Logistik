<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiMasuk extends Model
{
    protected $table = 'transaksi_masuk';
    public $timestamps = false;

    public function logistik()
    {
        return $this->belongsToMany(Logistik::class, 'detail_transaksi_masuk')->withPivot('nama_logistik', 'jumlah', 'satuan', 'expired', 'status');
    }

    public function pegawai()
    {
        return $this->belongsToMany(Pegawai::class, 'pegawai_transaksi_masuk')->withPivot('action');
    }

    public function supplier()
    {
        return $this->belongsToMany(Supplier::class, 'supplier_transaksi');
    }
}
