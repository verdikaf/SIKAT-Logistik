<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksiMasuk;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\TransaksiKeluar;
use App\Models\TransaksiMasuk;
use Barryvdh\DomPDF\Facade as PDF;

class LaporanController extends Controller
{
    public function lap_supplier(Request $request)
    {
        if (!empty($request->input('search'))) {
            $supplier = Supplier::where('nama_supplier','like',"%".$request->search."%")->orderBy('nama_supplier', 'asc')->paginate(10);
        } else {
            $supplier = Supplier::orderBy('nama_supplier', 'asc')->paginate(10);
        }
        return view('laporan.supplier', compact('supplier'));
    }

    public function lap_supplier_print()
    {
        $supplier = Supplier::all();
        $pegawai = session('berhasil_login')['nama'];
        $pdf = PDF::loadview('laporan.supplier_print', ['supplier' => $supplier, 'pegawai' => $pegawai]);
        $tgl = preg_replace("/[^0-9]/", "", date('d-m-Y H:i:s'));
        return $pdf->download('laporan_supplier_'.$tgl.'.pdf');
        // return view('laporan.invoice_print');
    }

    public function lap_masuk(Request $request)
    {
        $date_start = $request->date_start;
        $date_end = $request->date_end;
        if (!empty($date_start) && !empty($date_end)) {
            $transaksiMasuk = TransaksiMasuk::with('supplier', 'logistik')->whereBetween('tanggal', [$date_start, $date_end])->paginate(10);
        } else {
            $transaksiMasuk = TransaksiMasuk::with('supplier', 'logistik')->paginate(10);
        }
        return view('laporan.logistik_masuk', compact('transaksiMasuk', 'date_start', 'date_end'));
    }

    public function lap_masuk_print(Request $request)
    {
        $date_start = $request->date_start;
        $date_end = $request->date_end;
        if (!empty($date_start) && !empty($date_end)) {
            $transaksiMasuk = TransaksiMasuk::with('supplier', 'logistik')->whereBetween('tanggal', [$date_start, $date_end])->get();
        } else {
            $transaksiMasuk = TransaksiMasuk::with('supplier', 'logistik')->get();
        }
        $pegawai = session('berhasil_login')['nama'];
        $pdf = PDF::loadview('laporan.logistik_masuk_print', ['transaksiMasuk' => $transaksiMasuk, 'pegawai' => $pegawai, 'date_start' => $date_start, 'date_end' => $date_end]);
        $tgl = preg_replace("/[^0-9]/", "", date('d-m-Y H:i:s'));
        return $pdf->download('laporan_transaksi_masuk_'.$tgl.'.pdf');
        //return view('laporan.logistik_masuk_print', compact('transaksiMasuk', 'date_start', 'date_end', 'pegawai'));
    }

    public function lap_keluar(Request $request)
    {
        $date_start = $request->date_start;
        $date_end = $request->date_end;
        if (!empty($date_start) && !empty($date_end)) {
            $transaksiKeluar = TransaksiKeluar::with('logistik')->whereBetween('tanggal', [$date_start, $date_end])->paginate(10);
        } else {
            $transaksiKeluar = TransaksiKeluar::with('logistik')->paginate(10);
        }
        return view('laporan.logistik_keluar', compact('transaksiKeluar', 'date_start', 'date_end'));
    }

    public function lap_keluar_print(Request $request)
    {
        $date_start = $request->date_start;
        $date_end = $request->date_end;
        if (!empty($date_start) && !empty($date_end)) {
            $transaksiKeluar = TransaksiKeluar::with('logistik')->whereBetween('tanggal', [$date_start, $date_end])->get();
        } else {
            $transaksiKeluar = TransaksiKeluar::with('logistik')->get();
        }
        $pegawai = session('berhasil_login')['nama'];
        $pdf = PDF::loadview('laporan.logistik_keluar_print', ['transaksiKeluar' => $transaksiKeluar, 'pegawai' => $pegawai, 'date_start' => $date_start, 'date_end' => $date_end]);
        $tgl = preg_replace("/[^0-9]/", "", date('d-m-Y H:i:s'));
        return $pdf->download('laporan_transaksi_keluar_'.$tgl.'.pdf');
        //return view('laporan.logistik_keluar_print', compact('transaksiKeluar', 'date_start', 'date_end', 'pegawai'));
    }
}
