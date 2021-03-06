<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Laporan Supplier dan Donatur</title>
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
                <td colspan="2"><strong>Perihal:</strong> Laporan Supplier dan Donatur</td>
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
                    <th>No</th>
                    <th>Nama Supplier / Donatur</th>
                    <th>Alamat</th>
                </tr>
            </thead>
            <tbody>
                {{ $no = 1 }}
                @foreach($supplier as $s)
                <tr>
                    <td align="center" style="padding: 5px">{{ $no }}</td>
                    <td style="padding: 5px">{{ $s->nama_supplier }}</td>
                    <td style="padding: 5px">{{ $s->alamat }}</td>
                </tr>
                {{ $no++ }}
                @endforeach
            </tbody>
        </table>
        <br>
        <table width="100%">
            <tr>
                <td width="50%"></td>
                <td align="center"><strong>Dicetak pada:</strong> {{ date('d-m-Y') }}</td>
            </tr>
            <tr>
                <td width="50%"></td>
                <td align="center"><strong>Dicetak oleh</strong></td>
            </tr>
            <tr>
                <td width="50%"></td>
                <td align="center">
                    <img src="{{ public_path('/storage/qr-profile/'.$pegawai->qr) }}" alt="" width="70"/>
                </td>
            </tr>
            <tr>
                <td width="50%"></td>
                <td align="center">
                    <u>{{ $pegawai->nama_pegawai }}</u> <br>
                    @if ($pegawai->asn == 1)
                        NIP. {{ $pegawai->id }}
                    @endif
                </td>
            </tr>
        </table>
    </body>
</html>
