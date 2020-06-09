                    <li class="menu-header"> Pengguna </li>
                    <li class="dropdown {{ request()->is('admin/*') ? 'active' : '' }}">
                        <a href="#" class="nav-link has-dropdown"><i class="fas fa-user"></i><span> Pengguna </span></a>
                        <ul class="dropdown-menu">
                            <li class="{{ request()->is('admin/*/user') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.user.index') }}"> Kelola </a></li>
                            {{-- <li><a class="nav-link" href="javascript:void(0);"> Penjualan [BETA] </a></li> --}}
                        </ul>
                    </li>
