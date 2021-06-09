<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiKeluar extends Model
{
    protected $table = 'transaksi_keluar';
    public $timestamps = false;

    public function logistik()
    {
        return $this->belongsToMany(Logistik::class, 'detail_transaksi_keluar')->withPivot('nama_logistik', 'jumlah', 'satuan', 'status');
    }

    public function pegawai()
    {
        return $this->belongsToMany(Pegawai::class, 'pegawai_transaksi_keluar')->withPivot('action');
    }
}
