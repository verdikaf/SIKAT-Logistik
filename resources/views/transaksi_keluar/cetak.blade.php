<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Invoice Transaksi Keluar</title>
        <style type="text/css">
            * {
                font-family: Verdana, Arial, sans-serif;
            }
            table{
                font-size: x-small;
            }
            tfoot tr td{
                font-weight: bold;
                font-size: x-small;
            }
            .gray {
                background-color: lightgray
            }
        </style>
    </head>
    <body>
        <table width="100%">
            <tr>
                <td valign="top"><img src="{{ public_path('/assets/img/bpbdmalangkab.png') }}" alt="" width="150"/></td>
                <td align="right">
                    <h3>BADAN PENANGGULANGAN BENCANA DAERAH <br> KABUPATEN MALANG</h3>
                    <pre>
                        Jl. Trunojoyo, Kedungpedaringan, Kepanjen, Kabupaten Malang
                        Provinsi Jawa Timur, Indonesia. 65163
                        Telp. (0341) 392121
                    </pre>
                </td>
            </tr>
        </table>
    <br>
    <br>
        <table width="100%">
            <tr>
                <td><strong>Perihal:</strong> Invoice Transaksi Logistik Keluar</td>
                <td>
                    <strong>Nomor Transaksi:</strong>
                    @foreach ($transaksiKeluar as $key => $item)
                        {{ $item->id }}
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Tanggal:</strong>
                    @foreach ($transaksiKeluar as $key => $item)
                        {{ date("d-m-Y", strtotime($item->tanggal)) }}
                    @endforeach
                </td>
                <td>
                    <strong>Alamat DIstribusi:</strong>
                    @foreach ($transaksiKeluar as $key => $item)
                        {{ $item->lokasi }}
                    @endforeach
                </td>
            </tr>
        </table>
    <br/>
        <table width="100%">
            <thead style="background-color: lightgray;">
                <tr>
                    <th>No</th>
                    <th>Nama Logistik</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                {{ $no = 1 }}
                @foreach($cart as $item)
                <tr>
                    <td align="center" style="padding: 5px">{{ $no }}</td>
                    <td style="padding: 5px">{{ $item->nama_logistik }}</td>
                    <td align="center" style="padding: 5px">{{ $item->jumlah.' '.$item->satuan }}</td>
                    <td align="center" style="padding: 5px">
                        @if ($item->status == 1)
                            Sukses, Logistik Habis Pakai
                        @elseif ($item->status == 2)
                            Sukses, Logistik Belum Kembali
                        @elseif ($item->status == 3)
                            Gagal diverifikasi
                        @elseif ($item->status == 4)
                            Sukses, Logistik Sudah Kembali
                        @endif
                    </td>
                </tr>
                {{ $no++ }}
                @endforeach
            </tbody>
        </table>
        <br>
        <table width="100%">
            <tr>
                <td width="30%">
                    <strong>Dibuat oleh</strong>
                </td>
                <td width="30%">
                    <strong>Diverifikasi oleh</strong>
                </td>
                <td>
                    @foreach ($transaksiKeluar as $key => $item)
                        @foreach ($item->pegawai as $as)
                            @if ($as->pivot->action == 3)
                                <strong>Petugas Pengembalian oleh</strong>
                            @endif
                        @endforeach
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>
                    @foreach ($transaksiKeluar as $key => $item)
                        @foreach ($item->pegawai as $as)
                            @if ($as->pivot->action == 1)
                                <img src="{{ public_path('/storage/qr-profile/'.$as->qr) }}" alt="" width="70"/>
                            @endif
                        @endforeach
                    @endforeach
                </td>
                <td>
                    @foreach ($transaksiKeluar as $key => $item)
                        @foreach ($item->pegawai as $as)
                            @if ($as->pivot->action == 2)
                                <img src="{{ public_path('/storage/qr-profile/'.$as->qr) }}" alt="" width="70"/>
                            @endif
                        @endforeach
                    @endforeach
                </td>
                <td>
                    @foreach ($transaksiKeluar as $key => $item)
                        @foreach ($item->pegawai as $as)
                            @if ($as->pivot->action == 3)
                                <img src="{{ public_path('/storage/qr-profile/'.$as->qr) }}" alt="" width="70"/>
                            @endif
                        @endforeach
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>
                    @foreach ($transaksiKeluar as $key => $item)
                        @foreach ($item->pegawai as $as)
                            @if ($as->pivot->action == 1)
                                <u>{{ $as->nama_pegawai }}</u> <br>
                                @if ($as->asn == 1)
                                    NIP. {{ $as->id }}
                                @endif
                            @endif
                        @endforeach
                    @endforeach
                </td>
                <td>
                    @foreach ($transaksiKeluar as $key => $item)
                        @foreach ($item->pegawai as $as)
                            @if ($as->pivot->action == 2)
                                <u>{{ $as->nama_pegawai }}</u> <br>
                                @if ($as->asn == 1)
                                    NIP. {{ $as->id }}
                                @endif
                            @endif
                        @endforeach
                    @endforeach
                </td>
                <td>
                    @foreach ($transaksiKeluar as $key => $item)
                        @foreach ($item->pegawai as $as)
                            @if ($as->pivot->action == 3)
                                <u>{{ $as->nama_pegawai }}</u> <br>
                                @if ($as->asn == 1)
                                    NIP. {{ $as->id }}
                                @endif
                            @endif
                        @endforeach
                    @endforeach
                </td>
            </tr>
        </table>
    </body>
</html>
