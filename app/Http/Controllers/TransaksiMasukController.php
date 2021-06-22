<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logistik;
use App\Models\Pegawai;
use App\Models\TransaksiMasuk;
use App\Models\Kategori;
use App\Models\Satuan;
use App\Models\Supplier;
use App\Models\DetailTransaksiMasuk;
use Barryvdh\DomPDF\Facade as PDF;

class TransaksiMasukController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        if (session('berhasil_login')['role'] != 3) {
            if (!empty($request->input('search'))) {
                $transaksi = TransaksiMasuk::whereHas('supplier', function($q) use($search){$q->where('nama_supplier', 'like', "%".$search."%");})
                ->orWhere('id','like',"%".$search."%")
                ->orWhere('tanggal','like',"%".$search."%")
                ->orderBy('id', 'desc')
                ->paginate(5);
            } else {
                $transaksi = TransaksiMasuk::with('supplier')->orderBy('id', 'desc')->paginate(5);
            }
        } else {
            if (!empty($request->input('search'))) {
                $transaksi = TransaksiMasuk::whereHas('supplier', function($q) use($search){$q->where('nama_supplier', 'like', "%".$search."%");})
                ->orWhere('id','like',"%".$search."%")
                ->orWhere('tanggal','like',"%".$search."%")
                ->where('status','!=',0)
                ->orderBy('id', 'desc')
                ->paginate(5);
            } else {
                $transaksi = TransaksiMasuk::with('supplier')
                ->where('status','!=',0)
                ->orderBy('id', 'desc')
                ->paginate(5);
            }
        }

        return view('transaksi_masuk.index', compact('transaksi'));
    }

    public function create()
    {
        $supplier = Supplier::pluck('nama_supplier', 'id');
        $id = TransaksiMasuk::count() + 1;
        $tgl = preg_replace("/[^0-9]/", "", date('d-m-Y'));
        $fzeropadded = sprintf("%03d", $id);
        $inv = intval($tgl . '1' . $fzeropadded);

        return view('transaksi_masuk.create', compact('supplier', 'inv'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required',
        ], [
            'supplier_id.required' => 'Nama Supplier harus diisi.',
        ]);

        $tgl = date("Y-m-d", strtotime($request->tanggal));

        $transaksi = new TransaksiMasuk;
        $transaksi->id = $request->id;
        $transaksi->status = 0;
        $transaksi->tanggal = $tgl;
        $transaksi->save();

        $pegawai = Pegawai::find($request->pegawai_id);
        $transaksi->pegawai()->attach($pegawai, ['action'=>1]);

        $supplier = Supplier::find($request->supplier_id);
        $transaksi->supplier()->attach($supplier);

        return redirect(url('transaksi/t_masuk/'.$request->id.'/cart'));
    }

    public function cart($id)
    {
        $logistik = Logistik::with('satuan')->get();
        $kategori = Kategori::all();
        $satuan = Satuan::all();
        $transaksiMasuk = TransaksiMasuk::with('supplier', 'pegawai')->where('id', $id)->get();
        $cart = DetailTransaksiMasuk::where('transaksi_masuk_id', $id)->get();
        $pegawai = Pegawai::select('role_id')->where('id', session('berhasil_login')['id'])->first();
        return view('transaksi_masuk.cart', compact('transaksiMasuk', 'logistik', 'kategori', 'satuan', 'cart', 'pegawai'));
    }

    public function store_cart(Request $request)
    {
        $request->validate([
            'logistik_id' => 'required',
            'expired' => 'required',
            'jumlah' => 'required|numeric',
        ], [
            'logistik_id.required' => 'Nama logistik harus diisi.',
            'expired.required' => 'Masa pakai logistik harus diisi.',
            'jumlah.required' => 'Jumlah logistik harus diisi.',
            'jumlah.numeric' => 'Jumlah Deskripsi logistik harus berisi angka.',
        ]);

        $cart = DetailTransaksiMasuk::where([
            ['expired', $request->expired],
            ['logistik_id', $request->logistik_id],
            ['transaksi_masuk_id', $request->id]
        ])
        ->first();

        if ($cart != null) {
            DetailTransaksiMasuk::where([
                ['transaksi_masuk_id', $request->id],
                ['logistik_id', $request->logistik_id],
                ['expired', $request->expired]
            ])->update(['jumlah' => $cart->jumlah + $request->jumlah]);
        } else {
            $findLog = Logistik::where('id', $request->logistik_id)->first();
            $transaksiMasuk = new TransaksiMasuk;
            $transaksiMasuk->id = $request->id;
            $logistik = Logistik::find($request->logistik_id);
            $transaksiMasuk = $transaksiMasuk->logistik()->attach(
                $logistik,
                ['nama_logistik'=>$findLog->nama_logistik,
                'jumlah'=>$request->jumlah,
                'satuan'=>$request->satuan,
                'expired'=>$request->expired,
                'status'=>0]
            );
        }

        return redirect()->back();
    }

    public function delete_cart($transaksi_masuk_id, $logistik_id)
    {
        TransaksiMasuk::find($transaksi_masuk_id)->logistik()->detach($logistik_id);
        return redirect()->back();
    }

    public function submit_cart($id)
    {
        $cart = DetailTransaksiMasuk::where('transaksi_masuk_id', $id)->first();

        if (is_null($cart)) {
            return redirect()->back()->with('error', 'Masukkan data logistik terlebih dahulu.');
        } else {
            $tgl = date('Y-m-d');
            TransaksiMasuk::where('id', $id)->update(['status' => 1, 'tanggal' => $tgl]);

            return redirect(url('transaksi/t_masuk'))->with('success', 'Transaksi Berhasil Ditambahkan.');
        }
    }

    public function verif_cart($transaksi_masuk_id, $logistik_id, $expired)
    {
        DetailTransaksiMasuk::where([
            ['transaksi_masuk_id', $transaksi_masuk_id],
            ['logistik_id', $logistik_id],
            ['expired', $expired]
        ])->update(['status' => 1]);

        $cart = DetailTransaksiMasuk::where([
            ['transaksi_masuk_id', $transaksi_masuk_id],
            ['logistik_id', $logistik_id],
            ['expired', $expired]
        ])->first();
        $logistik = Logistik::where('id', $cart->logistik_id)->first();
        $logistik->stok = (int) $logistik->stok + (int) $cart->jumlah;
        $logistik->stok_opname = (int) $logistik->stok_opname + (int) $cart->jumlah;
        $logistik->save();

        return redirect()->back();
    }

    public function verif_cart_false($transaksi_masuk_id, $logistik_id, $expired)
    {
        DetailTransaksiMasuk::where([
            ['transaksi_masuk_id', $transaksi_masuk_id],
            ['logistik_id', $logistik_id],
            ['expired', $expired]
        ])->update(['status' => 2]);

        return redirect()->back();
    }

    public function verif_all($transaksi_masuk_id)
    {
        $pegawai_id = session('berhasil_login')['id'];
        $t_status_array = array();

        $cart = DetailTransaksiMasuk::where([
            ['transaksi_masuk_id', $transaksi_masuk_id]
        ])->get();

        $t_status = 0;

        foreach ($cart as $item) {
            $status = $item->status;
            if ($status == 0) {
                return redirect()->back()->with('error', 'Verifikasi Semua Data terlebih dahulu.');
            } else if ($status == 2){
                $t_status = 2;
            } else {
                $t_status = 1;
            }
            $t_status_array[] = $t_status;
        }

        if(in_array(2, $t_status_array)){
            $transaksiMasuk = TransaksiMasuk::find($transaksi_masuk_id);
            $transaksiMasuk->status = 2;
            $transaksiMasuk->save();
        } else {
            $transaksiMasuk = TransaksiMasuk::find($transaksi_masuk_id);
            $transaksiMasuk->status = 3;
            $transaksiMasuk->save();
        }

        $pegawai = Pegawai::find($pegawai_id);
        $transaksiMasuk->pegawai()->attach($pegawai, ['action'=>2]);

        return redirect(url('transaksi/t_masuk'))->with('success', 'Transaksi Berhasil Diverifikasi.');
    }

    public function store_supplier(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:3',
            'alamat' => 'required|min:5',
        ], [
            'nama.required' => 'Nama supplier harus diisi.',
            'nama.min' => 'Nama harus lebih dari 3 karakter.',
            'alamat.required' => 'Alamat supplier harus diisi.',
            'alamat.min' => 'Alamat harus lebih dari 5 karakter.',
        ]);

        $supplier = new Supplier;
        $supplier->nama_supplier = $request->nama;
        $supplier->alamat = $request->alamat;
        $supplier->save();

        return redirect()->back();
    }

    public function store_logistik(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'nama' => 'required|min:3',
            'deskripsi' => 'required|min:5',
            'kategori_id' => 'required',
            'satuan_id' => 'required',
        ], [
            'id.required' => 'ID logistik harus diisi.',
            'nama.required' => 'Nama logistik harus diisi.',
            'nama.min' => 'Nama logistik harus lebih dari 3 karakter.',
            'deskripsi.required' => 'Deskripsi logistik harus diisi.',
            'deskripsi.min' => 'Deskripsi logistik harus lebih dari 5 karakter.',
            'kategori_id.required' => 'Kategori Logistik harus diisi.',
            'satuan_id.required' => 'Satuan harus diisi.',
        ]);

        $logistik = new Logistik;
        $logistik->id = $request->id;
        $logistik->nama_logistik = $request->nama;
        $logistik->stok = 0;
        $logistik->stok_opname = 0;
        $logistik->deskripsi = $request->deskripsi;
        $logistik->kategori_id = $request->kategori_id;
        $logistik->satuan_id = $request->satuan_id;
        $logistik->save();

        return redirect()->back();
    }

    public function show_satuan($id)
    {
        $logistik = Logistik::with('satuan')->where('id', $id)->get()->pluck('satuan');
        foreach ($logistik as $key => $item) {
            $satuan = $item->nama_satuan;
        }
        return json_encode($satuan);
    }

    public function cetak($id)
    {
        $transaksiMasuk = TransaksiMasuk::with('supplier', 'pegawai')->where('id', $id)->get();
        $cart = DetailTransaksiMasuk::where('transaksi_masuk_id', $id)->get();
        $pegawai = Pegawai::select('role_id')->where('id', session('berhasil_login')['id'])->first();

        $pdf = PDF::loadview('transaksi_masuk.cetak', ['transaksiMasuk' => $transaksiMasuk, 'cart' => $cart, 'pegawai' => $pegawai]);
        $tgl = preg_replace("/[^0-9]/", "", date('d-m-Y H:i:s'));
        return $pdf->download('invoice_transaksi_masuk_'.$tgl.'.pdf');
    }
}
