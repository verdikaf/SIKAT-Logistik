<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Laporan Transaksi Logistik Masuk</title>
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
                <td valign="top"><img src="{{ public_path('/assets/img/bpbdmalangkab.jpg') }}" alt="" width="150"/></td>
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
                <td colspan="2"><strong>Perihal:</strong> Laporan Transaksi Logistik Masuk</td>
            </tr>
            <tr>
                <td>
                    <strong>Mulai tanggal:</strong>
                    @if (empty($date_start))
                        -
                    @else
                        {{ date('d-m-Y', strtotime($date_start)) }}
                    @endif
                </td>
                <td>
                    <strong>Hingga tanggal:</strong>
                    @if (empty($date_end))
                        -
                    @else
                        {{ date('d-m-Y', strtotime($date_end)) }}
                    @endif
                </td>
            </tr>
        </table>
    <br/>
        <table width="100%">
            <thead style="background-color: lightgray;">
                <tr>
                    <th>No. Transaksi</th>
                    <th>Tanggal Transaksi</th>
                    <th>Supplier / Donatur</th>
                    <th>Nama Logistik</th>
                    <th>Jumlah</th>
                    <th>Masa Pakai</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($transaksiMasuk as $key => $item)
                @foreach ($item->logistik as $log)
                    <tr>
                        <td align="center" style="padding: 5px">{{ $item->id }}</td>
                        <td align="center" style="padding: 5px">{{ date("d-m-Y", strtotime($item->tanggal)) }}</td>
                        <td style="padding: 5px">{{ $item->supplier->implode('nama_supplier') }}</td>
                        <td style="padding: 5px">{{ $log->pivot->nama_logistik }}</td>
                        <td align="center" style="padding: 5px">{{ $log->pivot->jumlah.' '.$log->pivot->satuan }}</td>
                        <td align="center" style="padding: 5px">{{ date("d-m-Y", strtotime($log->pivot->expired)) }}</td>
                        <td align="center" style="padding: 5px">
                            @if ($log->pivot->status == 1)
                                Sukses
                            @else
                                Gagal
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
        <br>
        <table width="100%">
            <tr>
                <td align="left"><strong>Dicetak pada:</strong> {{ date('d-m-Y') }}</td>
            </tr>
            <tr>
                <td align="left"><strong>Dicetak oleh:</strong> {{ $pegawai }}</td>
            </tr>
        </table>
    </body>
</html>
