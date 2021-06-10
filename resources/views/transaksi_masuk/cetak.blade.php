<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Invoice Transaksi Masuk</title>
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
                <td><strong>Perihal:</strong> Invoice Transaksi Logistik Masuk</td>
                <td>
                    <strong>Nomor Transaksi:</strong>
                    @foreach ($transaksiMasuk as $key => $item)
                        {{ $item->id }}
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Tanggal:</strong>
                    @foreach ($transaksiMasuk as $key => $item)
                        {{ date("d-m-Y", strtotime($item->tanggal)) }}
                    @endforeach
                </td>
                <td>
                    <strong>Nama Supplier / Donatur:</strong>
                    @foreach ($transaksiMasuk as $key => $item)
                        {{ $item->supplier->implode('nama_supplier') }}
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
                    <th>Masa pakai sampai</th>
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
                    <td align="center" style="padding: 5px">{{ date('d-m-Y', strtotime($item->expired)) }}</td>
                    <td align="center" style="padding: 5px">
                        @if ($item->status == 1)
                            Berhasil diverifikasi
                        @elseif ($item->status == 2)
                            Gagal diverifikasi
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
                <td align="left">
                    <strong>Dibuat oleh:</strong>
                    @foreach ($transaksiMasuk as $key => $item)
                        @foreach ($item->pegawai as $as)
                            @if ($as->pivot->action == 1)
                                {{ $as->nama_pegawai }}
                            @endif
                        @endforeach
                    @endforeach
                </td>
            </tr>
            <tr>
                <td align="left">
                    <strong>Diverifikasi oleh:</strong>
                    @foreach ($transaksiMasuk as $key => $item)
                        @foreach ($item->pegawai as $as)
                            @if ($as->pivot->action == 2)
                                {{ $as->nama_pegawai }}
                            @endif
                        @endforeach
                    @endforeach
                </td>
            </tr>
        </table>
    </body>
</html>
