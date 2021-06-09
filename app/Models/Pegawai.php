<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawai';
    protected $hidden = ['password'];
    public $timestamps = false;

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function transaksi(){
        return $this->belongsToMany(Transaksi::class, 'pegawai_transaksi');
    }
}
