<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">

            {{-- Global Dashboard --}}
            @if (auth()->user()->role == 'admin')
                <li class="menu-header"> Utama </li>
                <li class="dropdown">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span> Beranda </span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="#"> Umum </a></li>
                        <li><a class="nav-link" href="javascript:void(0);"> Penjualan [BETA] </a></li>
                    </ul>
                </li>
            @else
                <li><a class="nav-link" href="{{  }}"><i class="fas fa-th"></i> <span> Beranda </span></a></li>
            @endif
            



        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
            </a>
        </div>
    </aside>
</div>