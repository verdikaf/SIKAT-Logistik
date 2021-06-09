<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title') &mdash; SIKAT BPBD</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ url('/assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ url('/assets/css/components.css') }}">
  <link rel="shortcut icon" href="{{ url('/assets/img/bpbdmalangkab.jpg') }}" />
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
            <form class="form-inline mr-auto">
                <ul class="navbar-nav mr-3">
                <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                </ul>
            </form>
            <ul class="navbar-nav navbar-right">
                <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ url('/images/'.session('berhasil_login')['foto']) }}" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hi, {{ session('berhasil_login')['nama'] }}</div></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-title">{{ session('berhasil_login')['nama'] }}</div>
                    <a href="{{ url('profil') }}" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ url('auth/logout') }}" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
                </li>
            </ul>
            </nav>

            @include('sidebar');

            <div class="main-content">
                <section class="section">
                    @yield('section-header')
                    @yield('section-body')
                </section>
            </div>

            @yield('modal_supplier')

            @yield('modal_logistik')

            <footer class="main-footer">
            <div class="footer-left">
                Copyright &copy; 2021 <div class="bullet"></div> Development By <a href="{{ url('https://sinergispasial.com/') }}" target="_blank">Sinergi Spasial Indonesia</a>
            </div>
            <div class="footer-right">
                Versi 1.0
            </div>
            </footer>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>
    <script src="{{ url('/assets/js/stisla.js') }}"></script>
    <script src="{{ url('/assets/js/page/bootstrap-modal.js') }}"></script>
    <script src="{{ url('/assets/js/scripts.js') }}"></script>
    <script src="{{ url('/assets/js/custom.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.0/chart.min.js" integrity="sha512-yadYcDSJyQExcKhjKSQOkBKy2BLDoW6WnnGXCAkCoRlpHGpYuVuBqGObf3g/TdB86sSbss1AOP4YlGSb6EKQPg==" crossorigin="anonymous"></script>
    @stack('scripts')

</body>
</html>
