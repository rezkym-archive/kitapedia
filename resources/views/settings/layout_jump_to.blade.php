{{-- Side Bar settings --}}
<div class="col-md-4">
    <div class="card">
        <div class="card-header">
            <h4> {{ __('Pengaturan') }}</h4>
        </div>
        <div class="card-body">
            <ul class="nav nav-pills flex-column">
                <li class="nav-item"><a href="{{ route('settings.index') }}" class="nav-link"> Pengaturan </a></li>
                <li class="nav-item"><a href="{{ route('settings.general') }}" class="nav-link {{ setActiveIs('settings/general') }}"> Umum </a></li>
                <li class="nav-item"><a href="{{ route('settings.security') }}" class="nav-link {{ setActiveIs('settings/security') }}"> Keamanan & Info </a></li>
                {{-- <li class="nav-item"><a href="{{ route('settings.api') }}" class="nav-link {{ setActiveIs('settings/api') }}"> API </a></li>
                <li class="nav-item"><a href="javascript:void(0);" class="nav-link"> Pembaruan </a></li>
                <li class="nav-item"><a href="javascript:void(0);" class="nav-link"> Kemitraan </a></li>
                <li class="nav-item"><a href="javascript:void(0);" class="nav-link"> Keuangan </a></li> --}}
            </ul>
        </div>
    </div>
</div>