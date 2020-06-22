@extends('layouts.app')

{{-- Title Head --}}
@section('title_head', 'Beranda')

{{-- Css Lib --}}
@push('css_lib')
    
    <!-- CSS Libraies -->

@endpush

{{-- Js Lib --}}
@push('js_lib')

    <!-- JS Libraies -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

@endpush

{{-- Js Specific --}}
@push('js_specific')

    {{-- Spesific javascript modul --}}
    
@endpush


{{-- Content Section --}}
@section('content')
                <!-- Main Content -->
                <div class="main-content">
                    <section class="section">

                        <div class="section-header">
                            <h1> Pengaturan </h1>

                            <div class="section-header-breadcrumb">
                                <div class="breadcrumb-item active"><a href="{{ url('/') }}"> Beranda </a></div>
                                <div class="breadcrumb-item"> Pengaturan </div>
                            </div>

                        </div>

                        <div class="section-body">
                            <h2 class="section-title"> Gambaran Umum </h2>
            
                            <p class="section-lead">
                                Pengaturan Akun
                            </p>
                        </div>

                        <div class="row">

                            <div class="col-lg-6">
                                <div class="card card-large-icons">
                                    <div class="card-icon bg-primary text-white"> <i class="fas fa-cog"></i> </div>
                                    <div class="card-body">
                                        <h4> Umum </h4>
                                        <p>
                                            Nama, email, nohp, identitas
                                        </p> 
                                        <a href="{{ route('settings.general') }}" class="card-cta">
                                            Lihat <i class="fas fa-chevron-right"></i>
                                        </a> 
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="col-lg-6">
                                <div class="card card-large-icons">
                                    <div class="card-icon bg-primary text-white"> <i class="fas fa-money-check-alt"></i> </div>
                                    <div class="card-body">
                                        <h4> Keuangan </h4>
                                        <p>
                                            Otomatis top up, pengeluaran harian
                                        </p> 
                                        <a href="javascript:void(0);" onclick="featureWaiting()" class="card-cta text-primary">
                                            Lihat <i class="fas fa-chevron-right"></i>
                                        </a> 
                                    </div>
                                </div>
                            </div> --}}

                            {{-- <div class="col-lg-6">
                                <div class="card card-large-icons">
                                    <div class="card-icon bg-primary text-white"> <i class="fas fa-globe"></i> </div>
                                    <div class="card-body">
                                        <h4> API </h4>
                                        <p>
                                            Kunci API, sunting API, sunting IP static, white list
                                        </p> 
                                        <a href="{{ route('settings.api') }}" class="card-cta">
                                            Lihat <i class="fas fa-chevron-right"></i>
                                        </a>
                                     </div>
                                </div>
                            </div> --}}

                            {{-- <div class="col-lg-6">
                                <div class="card card-large-icons">
                                    <div class="card-icon bg-primary text-white"> <i class="fas fa-envelope"></i> </div>
                                    <div class="card-body">
                                        <h4> Pembaruan </h4>
                                        <p>
                                            Pemberitahuan pembaruan, notifikasi
                                        </p> 
                                        <a href="javascript:void(0);" onclick="featureWaiting()" class="card-cta">
                                            Lihat <i class="fas fa-chevron-right"></i>
                                        </a>
                                     </div>
                                </div>
                            </div> --}}

                            <div class="col-lg-6">
                                <div class="card card-large-icons">
                                    <div class="card-icon bg-primary text-white"> <i class="fas fa-shield-alt"></i> </div>
                                    <div class="card-body">
                                        <h4> Keamanan & info </h4>
                                        <p>
                                            Kata sandi, pin, two-factor authentication, cookie, akun terkait
                                        </p> 
                                        <a href="{{ route('settings.security') }}" class="card-cta">
                                            Lihat <i class="fas fa-chevron-right"></i>
                                        </a>
                                     </div>
                                </div>
                            </div>

                            

                            {{-- <div class="col-lg-6">
                                <div class="card card-large-icons">
                                    <div class="card-icon bg-primary text-white"> <i class="fas fa-comments-dollar"></i> </div>
                                    <div class="card-body">
                                        <h4> Kemitraan </h4>
                                        <p>
                                            Kemitraan {{ env('APP_NAME') }}
                                        </p> 
                                        <a href="javascript:void(0);" onclick="featureWaiting()" class="card-cta">
                                            Lihat <i class="fas fa-chevron-right"></i>
                                        </a>
                                     </div>
                                </div>
                            </div> --}}

                        </div>

                    </section>
                </div>
@endsection

{{-- JS in HTML --}}
@push('js_html')
    <script type="text/javascript">
        function featureWaiting()
        {
            Swal.fire({
                icon: 'error',
                title: 'Oppss...',
                text: 'Kita sedang memperbarui ini, coba lagi nanti yaaa...',
            })
        }
        
    </script>
@endpush
