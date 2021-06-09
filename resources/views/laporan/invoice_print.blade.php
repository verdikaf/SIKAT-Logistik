<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Invoice</title>
    </head>
    <body>
        <table align="center">
            <tr>
                <td width="700">
                    <table align="center">
                        <tr>
                            <td><img src="{{ url('/assets/img/bpbdmalangkab.jpg') }}" alt="Logo" width="70" height="70" class="logo"></td>
                            <td>
                                <center>
                                    <font size="4">KABUPATEN MALANG</font><br>
                                    <font size="5"><b>BADAN PENANGGULANGAN BENCANA DAERAH</b></font><br>
                                    <font size="2"><i>Jl. Trunojoyo, Kedungpedaringan, Kepanjen, Kabupaten Malang, 65163</i></font>
                                </center>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><hr></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table align="center">
                        <tr>
                            <td height="20"></td>
                        </tr>
                        <tr>
                            <td>Kepada</td>
                            <td width="575">:</td>
                        </tr>
                        <tr>
                            <td>Perihal</td>
                            <td width="575">: Laporan data supplier dan donatur 2021</td>
                        </tr>
                        <tr>
                            <td>Lampiran</td>
                            <td width="575">:</td>
                        </tr>
                        <tr>
                            <td height="50" colspan="2"></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <table border="1" width="90%" align="center">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Supplier / Donatur</th>
                                            <th>Alamat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- {{ $no = 1 }}
                                        @foreach($supplier as $s)
                                        <tr>
                                            <td align="center">{{ $no }}</td>
                                            <td>{{ $s->nama_supplier }}</td>
                                            <td>{{ $s->alamat }}</td>
                                        </tr>
                                        {{ $no++ }}
                                        @endforeach --}}
                                        <tr>
                                            <td>1</td>
                                            <td>Shibuya</td>
                                            <td>Jakarta, Indonesia</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Shibuya</td>
                                            <td>Jakarta, Indonesia</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Shibuya</td>
                                            <td>Jakarta, Indonesia</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table align="right">
                        <tr>
                            <td height="20"></td>
                            <td width="50"></td>
                        </tr>
                        <tr>
                            <td>Malang, 31 Desember 2021</td>
                            <td width="50"></td>
                        </tr>
                        <tr>
                            <td align="center">Petugas Pemeriksa</td>
                            <td width="50"></td>
                        </tr>
                        <tr>
                            <td height="100" align="center">TTD</td>
                            <td width="50"></td>
                        </tr>
                        <tr>
                            <td align="center"><u>Verdika Fajar</u></td>
                            <td width="50"></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Laporan Transaksi Logistik Keluar</title>
        <style>
            .table-content {
                border-collapse: collapse;
            }
            .table-content th {
                border: 1px solid black;
            }
            .table-content td {
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
        <table align="center" width="100%">
            <tr>
                <td colspan="3">
                    <table align="center">
                        <tr>
                            <td><img src="{{ public_path('/assets/img/bpbdmalangkab.jpg') }}" alt="Logo" width="70" height="70" class="logo"></td>
                            <td>
                                <center>
                                    <font size="4">KABUPATEN MALANG</font><br>
                                    <font size="5"><b>BADAN PENANGGULANGAN BENCANA DAERAH</b></font><br>
                                    <font size="2"><i>Jl. Trunojoyo, Kedungpedaringan, Kepanjen, Kabupaten Malang, 65163</i></font>
                                </center>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><hr></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <table align="center" width="100%">
                        <tr>
                            <td height="10"></td>
                        </tr>
                        <tr>
                            <td align="center"><h3><b>Laporan Transaksi Logistik Keluar <br> BPBD Kabupaten Malang</b></h3></td>
                        </tr>
                        <tr>
                            <td height="5"></td>
                        </tr>
                        <tr>
                            <td>
                                <table width="90%" align="center">
                                    <tr>
                                        <td align="left" style="width: 18%" class="td-con">Mulai tanggal</td>
                                        <td>:</td>
                                        <td align="left"  style="width: 80%">
                                            @if (empty($date_start))
                                                -
                                            @else
                                                {{ date('d-m-Y', strtotime($date_start)) }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" class="td-con">Hingga tanggal</td>
                                        <td>:</td>
                                        <td align="left">
                                            @if (empty($date_end))
                                                -
                                            @else
                                                {{ date('d-m-Y', strtotime($date_end)) }}
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td height="5"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <table align="center" width="100%">
                        <tr>
                            <td colspan="2">
                                <table width="90%" align="center" class="table-content">
                                    <thead>
                                        <tr>
                                            <th>No. Transaksi</th>
                                            <th>Tanggal Transaksi</th>
                                            <th>Lokasi Distribusi</th>
                                            <th>Nama Logistik</th>
                                            <th>Jumlah</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transaksiKeluar as $key => $item)
                                            @foreach ($item->logistik as $log)
                                                <tr>
                                                    <td align="center" style="padding: 5px">{{ $item->id }}</td>
                                                    <td align="center" style="padding: 5px">{{ date("d-m-Y", strtotime($item->tanggal)) }}</td>
                                                    <td style="padding: 5px">{{ $item->lokasi }}</td>
                                                    <td style="padding: 5px">{{ $log->pivot->nama_logistik }}</td>
                                                    <td align="center" style="padding: 5px">{{ $log->pivot->jumlah.' '.$log->pivot->satuan }}</td>
                                                    <td align="center" style="padding: 5px">
                                                        @if ($log->pivot->status == 1 || $log->pivot->status == 2)
                                                            Sukses
                                                        @elseif ($log->pivot->status == 3)
                                                            Gagal
                                                        @elseif ($log->pivot->status == 4)
                                                            Belum Kembali
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="left" style="width: 40%;">
                    {{-- <table align="center">
                        <tr>
                            <td height="20"></td>
                        </tr>
                        <tr>
                            <td height="15"></td>
                        </tr>
                        <tr>
                            <td align="center">Petugas Pemeriksa</td>
                        </tr>
                        <tr>
                            <td height="100" align="center">TTD</td>
                        </tr>
                        <tr>
                            <td align="center"><u>Verdika Fajar</u></td>
                        </tr>
                    </table> --}}
                </td>
                <td align="center"></td>
                <td align="right" style="width: 40%;">
                    <table align="center">
                        <tr>
                            <td height="20"></td>
                        </tr>
                        <tr>
                            <td>Dicetak pada : {{ date('d-m-Y') }}</td>
                        </tr>
                        <tr>
                            <td align="center">Dicetak Oleh</td>
                        </tr>
                        <tr>
                            <td height="100" align="center">TTD</td>
                        </tr>
                        <tr>
                            <td align="center"><u>{{ $pegawai }}</u></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>


