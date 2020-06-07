                    <li class="menu-header"> Pengguna </li>
                    <li class="dropdown {{ setActive(['userManager*', 'user*']) }}">
                        <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span> Pengguna </span></a>
                        <ul class="dropdown-menu">
                            <li class="{{ setActive(['userManager*', 'user*']) }}"><a class="nav-link" href="{{ route('admin.index') }}"> Kelola </a></li>
                            {{-- <li><a class="nav-link" href="javascript:void(0);"> Penjualan [BETA] </a></li> --}}
                        </ul>
                    </li>
