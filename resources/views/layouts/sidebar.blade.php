<div class="main-sidebar sidebar-style-2 ">
    <aside id="sidebar-wrapper ">
        <div class="sidebar-brand ">
            <a href="javascript:void(0);"> {{ env('APP_NAME') }} </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="javascript:void(0);"> {{ env('APP_NAME') }} </a>
        </div>
        <ul class="sidebar-menu ">

            {{-- Global Dashboard --}}
            @if ($user->role == 'admin')
                <li class="menu-header"> Utama </li>
                <li class="dropdown {{ setActive(['admin*', 'penjualan*']) }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span> Beranda </span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ setActive(['admin*', 'penjualan*']) }}"><a class="nav-link" href="{{ route('admin.index') }}"> Umum </a></li>
                        {{-- <li><a class="nav-link" href="javascript:void(0);"> Penjualan [BETA] </a></li> --}}
                    </ul>
                </li>
            @else
                <li><a class="nav-link" href="{{ route($user->role.'.index') }}"><i class="fas fa-th"></i> <span> Beranda </span></a></li>
            @endif

            {{-- Admin Fitur --}}
            @if ($user->role == 'admin')
                @include('layouts.fiture.admin')

            @endif
            
            



        </ul>

    </aside>
</div>