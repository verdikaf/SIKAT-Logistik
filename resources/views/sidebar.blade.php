<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
        <a href="/dashboard">SIKAT BPBD</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
        <a href="/dashboard"><img src="{{ url('/assets/img/bpbdmalangkab.jpg') }}" alt="logo" width="35" class="shadow-light rounded-circle"></a>
        </div>
        <ul class="sidebar-menu">
            <li class="@if (Request::segment(1) == 'dashboard') active @endif"><a class="nav-link" href="/dashboard">
                <i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Menu</li>
            @foreach (SiteHelpers::main_menu() as $mm)
            <li class="dropdown @if (Request::segment(1) == $mm->url) active @endif">
                <a href="#" class="nav-link has-dropdown"><i class="{{ $mm->icon }}"></i> <span>{{ $mm->nama_menu }}</span></a>
                <ul class="dropdown-menu">
                    @foreach (SiteHelpers::sub_menu() as $sm)
                        @if ($sm->main_menu == $mm->id)
                            <li class="@if (Request::segment(1).'/'.Request::segment(2) == $sm->url) active @endif">
                                <a class="nav-link" href="{{ url($sm->url) }}">{{ $sm->nama_menu }}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </li>
            @endforeach
        </ul>
    </aside>
</div>
