<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Supplier;
use App\Models\TransaksiKeluar;
use App\Models\TransaksiMasuk;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $pegawai = Pegawai::count();
        $supplier = Supplier::count();
        $transaksi_masuk = TransaksiMasuk::where('status', 2)->orWhere('status', 3)->count();
        $transaksi_keluar = TransaksiKeluar::where('status', 2)->orWhere('status', 3)->count();
        $transaksi = $transaksi_masuk + $transaksi_keluar;
        $tgl = (int) preg_replace("/[^0-9]/", "", date('n'));
        $jumlah_transaksi_keluar = array();
        for($bulan=1;$bulan < 13;$bulan++){
            if ($bulan <= $tgl) {
                $t_keluar_2 = TransaksiKeluar::where('status', 2)
                ->whereMonth('tanggal', $bulan)->count();
                $jumlah_keluar_2 = 0;
                $jumlah_keluar_2 += $t_keluar_2;


                $t_keluar_3 = TransaksiKeluar::where('status', 3)
                ->whereMonth('tanggal', $bulan)->count();
                $jumlah_keluar_3 = 0;
                $jumlah_keluar_3 += $t_keluar_3;

                $jumlah_keluar = $jumlah_keluar_2 + $jumlah_keluar_3;

                $jumlah_transaksi_keluar[] = $jumlah_keluar;
            }
        }
        $jumlah_transaksi_masuk = array();
        for($bulan=1;$bulan < 13;$bulan++){
            if ($bulan <= $tgl) {
                $t_masuk_2 = TransaksiMasuk::where('status', 2)
                ->whereMonth('tanggal', $bulan)->count();
                $jumlah_masuk_2 = 0;
                $jumlah_masuk_2 += $t_masuk_2;

                $t_masuk_3 = TransaksiMasuk::where('status', 3)
                ->whereMonth('tanggal', $bulan)->count();
                $jumlah_masuk_3 = 0;
                $jumlah_masuk_3 += $t_masuk_3;

                $jumlah_masuk = $jumlah_masuk_2 + $jumlah_masuk_3;

                $jumlah_transaksi_masuk[] = $jumlah_masuk;
            }
        }
        $pusdalops = Pegawai::where('role_id', 1)->count();
        $staf = Pegawai::where('role_id', 3)->count();
        $manajer = Pegawai::where('role_id', 2)->count();
        $jumlah_pegawai_jabatan = [$pusdalops, $manajer, $staf];

        return view('home', compact('pegawai', 'supplier', 'transaksi', 'jumlah_transaksi_masuk', 'jumlah_transaksi_keluar', 'jumlah_pegawai_jabatan'));
    }
}
