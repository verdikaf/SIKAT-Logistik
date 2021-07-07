<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksiKeluar;
use App\Models\Logistik;
use App\Models\Pegawai;
use App\Models\TransaksiKeluar;
use Illuminate\Http\Request;

class TransaksiKembaliController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        if (!empty($request->input('search'))) {
            $transaksi = TransaksiKeluar::where('id','like',"%".$search."%")
            ->whereBetween('status', [4, 6])
            ->orderBy('id', 'desc')
            ->paginate(5);
        } else {
            $transaksi = TransaksiKeluar::whereBetween('status', [4, 6])->orderBy('id', 'desc')->paginate(5);
        }

        return view('transaksi_kembali.index', compact('transaksi'));
    }

    public function cart($id)
    {
        $logistik = Logistik::with('satuan')->get();
        $transaksiKembali = TransaksiKeluar::with('pegawai')->where('id', $id)->get();
        $cart = DetailTransaksiKeluar::where('transaksi_keluar_id', $id)->get();
        $pegawai = Pegawai::select('role_id')->where('id', session('berhasil_login')['id'])->first();
        return view('transaksi_kembali.cart', compact('transaksiKembali', 'logistik', 'cart', 'pegawai'));
    }

    public function logistik_kembali($transaksi_keluar_id, $logistik_id)
    {
        $cart = DetailTransaksiKeluar::where([
            ['transaksi_keluar_id', $transaksi_keluar_id],
            ['logistik_id', $logistik_id]
        ])->first();

        $logistik = Logistik::where('id', $logistik_id)->first();
        $logistik->stok = (int) $logistik->stok + (int) $cart->jumlah;
        $logistik->save();

        DetailTransaksiKeluar::where([
            ['transaksi_keluar_id', $transaksi_keluar_id],
            ['logistik_id', $logistik_id]
        ])->update(['status' => 4]);

        return json_encode('sudah kembali');
    }

    public function verif_back($transaksi_keluar_id)
    {
        $pegawai_id = session('berhasil_login')['id'];
        $t_status_array = array();
        $cart = DetailTransaksiKeluar::where([
            ['transaksi_keluar_id', $transaksi_keluar_id]
        ])->get();
        $t_status = 0;

        foreach ($cart as $item) {
            $status = $item->status;
            if ($status == 2) {
                return redirect()->back()->with('error', 'Verifikasi Semua Data terlebih dahulu.');
            } else if ($status == 3){
                $t_status = 3;
            } else if ($status == 1){
                $t_status = 1;
            }
            $t_status_array[] = $t_status;
        }

        if(in_array(3, $t_status_array)){
            $transaksiKembali = TransaksiKeluar::find($transaksi_keluar_id);
            $transaksiKembali->status = 5;
            $transaksiKembali->save();
        } else {
            $transaksiKembali = TransaksiKeluar::find($transaksi_keluar_id);
            $transaksiKembali->status = 6;
            $transaksiKembali->save();
        }

        $pegawai = Pegawai::find($pegawai_id);
        $transaksiKembali->pegawai()->attach($pegawai, ['action'=>3]);

        return redirect(url('transaksi/t_kembali'))->with('success', 'Transaksi Berhasil.');
    }
}
