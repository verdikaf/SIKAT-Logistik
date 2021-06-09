@extends('main')

@section('title', 'Dashboard')

{{-- @section('main-sidebar')
    <div class="main-sidebar">
        <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
            <a href="/">SILO BPBD</a>
            </div>
            <div class="sidebar-brand sidebar-brand-sm">
            <a href="/">SB</a>
            </div>
            <ul class="sidebar-menu">
                <li class="menu-header">Dashboard</li>
                <li class="active"><a class="nav-link" href="/"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>
                <li class="menu-header">Logistik</li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-warehouse"></i> <span>Logistik</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ url('/logistik') }}">Logistik</a></li>
                        <li><a class="nav-link" href="{{ url('/supplier') }}">Supplier</a></li>
                        <li><a class="nav-link" href="{{ url('/kategori') }}">Kategori</a></li>
                        <li><a class="nav-link" href="{{ url('/satuan') }}">Satuan</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-truck"></i> <span>Transaksi</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="#">Logistik Masuk</a></li>
                        <li><a class="nav-link" href="#">Logistik Keluar</a></li>
                    </ul>
                </li>
                <li class="menu-header">Pegawai</li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i> <span>Pegawai</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ url('/pegawai') }}">Pegawai</a></li>
                        <li><a class="nav-link" href="{{ url('/role') }}">Jabatan</a></li>
                    </ul>
                </li>
                <li class="menu-header">Laporan</li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-invoice"></i> <span>Laporan</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="#">Logistik Masuk</a></li>
                        <li><a class="nav-link" href="#">Logistik Keluar</a></li>
                        <li><a class="nav-link" href="#">Supplier</a></li>
                    </ul>
                </li>
            </ul>
        </aside>
    </div>
@endsection --}}

@section('section-header')
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>
@endsection

@section('section-body')
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Jumlah Pegawai</h4>
                    </div>
                    <div class="card-body">
                        {{ $pegawai }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Jumlah Transaksi</h4>
                    </div>
                    <div class="card-body">
                        {{ $transaksi }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-donate"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Jumlah Supplier & Donatur</h4>
                    </div>
                    <div class="card-body">
                        {{ $supplier }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Grafik Transaksi Logistik</h4>
                </div>
                <div class="card-body">
                    <canvas id="myChart" height="182"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Grafik Jumlah Pegawai</h4>
                </div>
                <div class="card-body">
                    <canvas id="myChart2" height="182"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
                datasets: [{
                    label: 'Jumlah transaksi masuk tahun 2021',
                    data: {{ json_encode($jumlah_transaksi_masuk) }},
                    borderWidth: 2,
                    backgroundColor: '#F77F00',
                    borderColor: '#F77F00',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#ffffff',
                    pointRadius: 4
                },
                {
                    label: 'Jumlah transaksi keluar tahun 2021',
                    backgroundColor: '#6777ef',
                    borderColor: '#6777ef',
                    data: {{ json_encode($jumlah_transaksi_keluar) }},
                    borderWidth: 2,
                    borderWidth: 2.5,
                    pointBackgroundColor: '#ffffff',
                    pointRadius: 4
                }]
            },
            options: {
                legend: {
                display: false
                },
                scales: {
                yAxes: [{
                    gridLines: {
                    drawBorder: false,
                    color: '#f2f2f2',
                    },
                    ticks: {
                    beginAtZero: true,
                    stepSize: 150
                    }
                }],
                xAxes: [{
                    ticks: {
                    display: false
                    },
                    gridLines: {
                    display: false
                    }
                }]
                },
            }
        });

        var ctx = document.getElementById("myChart2").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["Pusdalops", "Manajer Logistik", "Staf Logistik"],
                datasets: [{
                    label: 'Jumlah pegawai berdasarkan jabatan',
                    backgroundColor: ['#F77F00', '#6777ef', '#fc544b'],
                    // backgroundColor: ['#F77F00', '#6777ef', '#63ed7a', '#3abaf4', '#fc544b'],
                    data: {{ json_encode($jumlah_pegawai_jabatan) }},
                    hoverOffset: 4
                }],
                options: {
                    legend: {
                    display: false
                    },
                    scales: {
                    yAxes: [{
                        gridLines: {
                        drawBorder: false,
                        color: '#f2f2f2',
                        },
                        ticks: {
                        beginAtZero: true,
                        stepSize: 150
                        }
                    }],
                    xAxes: [{
                        ticks: {
                        display: false
                        },
                        gridLines: {
                        display: false
                        }
                    }]
                    },
                }
            }
        });
    </script>
@endpush
