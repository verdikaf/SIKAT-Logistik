<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logistik;
use App\Models\Pegawai;
use App\Models\TransaksiKeluar;
use App\Models\DetailTransaksiKeluar;
use Barryvdh\DomPDF\Facade as PDF;

class TransaksiKeluarController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        if (session('berhasil_login')['role'] != 3) {
            if (!empty($request->input('search'))) {
                $transaksi = TransaksiKeluar::where('id','like',"%".$search."%")
                ->orWhere('lokasi','like',"%".$search."%")
                ->orderBy('id', 'desc')
                ->paginate(5);
            } else {
                $transaksi = TransaksiKeluar::orderBy('id', 'desc')->paginate(5);
            }
        } else {
            if (!empty($request->input('search'))) {
                $transaksi = TransaksiKeluar::where('id','like',"%".$search."%")
                ->orWhere('lokasi','like',"%".$search."%")
                ->where('status','!=',0)
                ->orderBy('id', 'desc')
                ->paginate(5);
            } else {
                $transaksi = TransaksiKeluar::where('status', '!=', 0)->orderBy('id', 'desc')->paginate(5);
            }
        }

        return view('transaksi_keluar.index', compact('transaksi'));
    }

    public function create()
    {
        $id = TransaksiKeluar::count() + 1;
        $tgl = preg_replace("/[^0-9]/", "", date('d-m-Y'));
        $fzeropadded = sprintf("%03d", $id);
        $inv = intval($tgl . '2' . $fzeropadded);

        return view('transaksi_keluar.create', compact('inv'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lokasi' => 'required',
        ], [
            'lokasi.required' => 'Lokasi harus diisi.',
        ]);

        $tgl = date("Y-m-d", strtotime($request->tanggal));

        $transaksi = new TransaksiKeluar;
        $transaksi->id = $request->id;
        $transaksi->status = 0;
        $transaksi->tanggal = $tgl;
        $transaksi->lokasi = $request->lokasi;
        $transaksi->save();

        $pegawai = Pegawai::find($request->pegawai_id);
        $transaksi->pegawai()->attach($pegawai, ['action'=>1]);

        return redirect(url('transaksi/t_keluar/'.$request->id.'/cart'));
    }

    public function cart($id)
    {
        $logistik = Logistik::with('satuan')->get();
        $transaksiKeluar = TransaksiKeluar::with('pegawai')->where('id', $id)->get();
        $cart = DetailTransaksiKeluar::where('transaksi_keluar_id', $id)->get();
        $pegawai = Pegawai::select('role_id')->where('id', session('berhasil_login')['id'])->first();
        return view('transaksi_keluar.cart', compact('transaksiKeluar', 'logistik', 'cart', 'pegawai'));
    }

    public function store_cart(Request $request)
    {
        $request->validate([
            'logistik_id' => 'required',
            'jumlah' => 'required|numeric',
        ], [
            'logistik_id.required' => 'Nama logistik harus diisi.',
            'jumlah.required' => 'Jumlah logistik harus diisi.',
            'jumlah.numeric' => 'Jumlah Deskripsi logistik harus berisi angka.',
        ]);

        $cart = DetailTransaksiKeluar::where([
            ['logistik_id', $request->logistik_id],
            ['transaksi_keluar_id', $request->id]
        ])
        ->first();

        $logistik = Logistik::where('id', $request->logistik_id)->first();

        if ($cart != null) {
            DetailTransaksiKeluar::where([
                ['transaksi_keluar_id', $request->id],
                ['logistik_id', $request->logistik_id]
            ])->update(['jumlah' => $cart->jumlah + $request->jumlah]);

            $logistik->stok = (int) $logistik->stok - (int) $request->jumlah;
            if ($logistik->kategori->tipe_logistik == 'Habis pakai') {
                $logistik->stok_opname = (int) $logistik->stok_opname - (int) $request->jumlah;
            }
            $logistik->save();
        } else {
            $logistik->stok = (int) $logistik->stok - (int) $request->jumlah;
            if ($logistik->kategori->tipe_logistik == 'Habis pakai') {
                $logistik->stok_opname = (int) $logistik->stok_opname - (int) $request->jumlah;
            }
            $logistik->save();

            $transaksiKeluar = new TransaksiKeluar;
            $transaksiKeluar->id = $request->id;
            $log = Logistik::find($request->logistik_id);
            $transaksiKeluar = $transaksiKeluar->logistik()->attach(
                $log,
                ['nama_logistik'=>$logistik->nama_logistik,
                'jumlah'=>$request->jumlah,
                'satuan'=>$request->satuan,
                'status'=>0]
            );

        }

        return redirect()->back();
    }

    public function delete_cart($transaksi_keluar_id, $logistik_id)
    {
        $cart = DetailTransaksiKeluar::where([
            ['transaksi_keluar_id', $transaksi_keluar_id],
            ['logistik_id', $logistik_id]
        ])->first();

        $logistik = Logistik::where('id', $logistik_id)->first();
        $logistik->stok = (int) $logistik->stok + (int) $cart->jumlah;
        if ($logistik->kategori->tipe_logistik == 'Habis pakai') {
            $logistik->stok_opname = (int) $logistik->stok_opname + (int) $cart->jumlah;
        }
        $logistik->save();

        TransaksiKeluar::find($transaksi_keluar_id)->logistik()->detach($logistik_id);
        return redirect()->back();
    }

    public function submit_cart($id)
    {
        $cart = DetailTransaksiKeluar::where('transaksi_keluar_id', $id)->first();

        if (is_null($cart)) {
            return redirect()->back()->with('error', 'Masukkan data logistik terlebih dahulu.');
        } else {
            $tgl = date('Y-m-d');
            TransaksiKeluar::where('id', $id)->update(['status' => 1, 'tanggal' => $tgl]);

            return redirect(url('transaksi/t_keluar'))->with('success', 'Transaksi Berhasil Ditambahkan.');
        }
    }

    public function verif_cart($transaksi_keluar_id, $logistik_id)
    {
        $logistik = Logistik::where('id', $logistik_id)->first();
        if ($logistik->kategori->tipe_logistik == 'Habis pakai') {
            DetailTransaksiKeluar::where([
                ['transaksi_keluar_id', $transaksi_keluar_id],
                ['logistik_id', $logistik_id]
            ])->update(['status' => 1]);
        } else {
            DetailTransaksiKeluar::where([
                ['transaksi_keluar_id', $transaksi_keluar_id],
                ['logistik_id', $logistik_id]
            ])->update(['status' => 2]);
        }

        return redirect()->back();
    }

    public function verif_cart_batal(Request $request)
    {
        $cart = DetailTransaksiKeluar::where([
            ['transaksi_keluar_id', $request->transaksi_keluar_id],
            ['logistik_id', $request->logistik_id]
        ])->first();

        $logistik = Logistik::where('id', $request->logistik_id)->first();
        $logistik->stok = (int) $logistik->stok + (int) $cart->jumlah;
        if ($logistik->kategori->tipe_logistik == 'Habis pakai') {
            $logistik->stok_opname = (int) $logistik->stok_opname + (int) $cart->jumlah;
        }
        $logistik->save();

        DetailTransaksiKeluar::where([
            ['transaksi_keluar_id', $request->transaksi_keluar_id],
            ['logistik_id', $request->logistik_id]
        ])->update(['status' => 3, 'keterangan' => $request->keterangan]);

        return redirect()->back();
    }

    public function verif_all($transaksi_keluar_id)
    {
        $pegawai_id = session('berhasil_login')['id'];
        $t_status_array = array();
        $cart = DetailTransaksiKeluar::where([
            ['transaksi_keluar_id', $transaksi_keluar_id]
        ])->get();
        $t_status = 0;

        foreach ($cart as $item) {
            $status = $item->status;
            if ($status == 0) {
                return redirect()->back()->with('error', 'Verifikasi Semua Data terlebih dahulu.');
            } else if ($status == 3){
                $t_status = 3;
            } else if ($status == 2){
                $t_status = 2;
            } else {
                $t_status = 1;
            }
            $t_status_array[] = $t_status;
        }

        if(in_array(2, $t_status_array)){
            $transaksiKeluar = TransaksiKeluar::find($transaksi_keluar_id);
            $transaksiKeluar->status = 4;
            $transaksiKeluar->save();
        } else if(in_array(3, $t_status_array)){
            $transaksiKeluar = TransaksiKeluar::find($transaksi_keluar_id);
            $transaksiKeluar->status = 2;
            $transaksiKeluar->save();
        } else {
            $transaksiKeluar = TransaksiKeluar::find($transaksi_keluar_id);
            $transaksiKeluar->status = 3;
            $transaksiKeluar->save();
        }

        $pegawai = Pegawai::find($pegawai_id);
        $transaksiKeluar->pegawai()->attach($pegawai, ['action'=>2]);

        return redirect(url('transaksi/t_keluar'))->with('success', 'Transaksi Berhasil Diverifikasi.');
    }

    public function cetak($id)
    {
        $transaksiKeluar = TransaksiKeluar::with('pegawai')->where('id', $id)->get();
        $cart = DetailTransaksiKeluar::where('transaksi_keluar_id', $id)->get();
        $pegawai = Pegawai::select('role_id')->where('id', session('berhasil_login')['id'])->first();

        $pdf = PDF::loadview('transaksi_keluar.cetak', ['transaksiKeluar' => $transaksiKeluar, 'cart' => $cart, 'pegawai' => $pegawai]);
        $tgl = preg_replace("/[^0-9]/", "", date('d-m-Y H:i:s'));
        return $pdf->download('invoice_transaksi_keluar_'.$tgl.'.pdf');
    }
}
