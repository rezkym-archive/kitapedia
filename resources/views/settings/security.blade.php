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
    <script src="{{ asset('assets/js/user/settings.js') }}"></script>
    
@endpush

{{-- Content Section --}}
@section('content')
                <!-- Main Content -->
                <div class="main-content">
                    <section class="section">   

                        <div class="section-header">
                            <h1> Umum </h1>

                            <div class="section-header-breadcrumb">
                                <div class="breadcrumb-item active"><a href="{{ url('/') }}"> Beranda </a></div>
                                <div class="breadcrumb-item active"><a href="{{ route('settings.index') }}"> Pengaturan </a></div>
                                <div class="breadcrumb-item"> Umum </div>
                            </div>

                        </div>

                        <div class="section-body">
                            <h2 class="section-title"> Pengaturan Keamanan & info </h2>
            
                            <p class="section-lead">
                                Kata sandi, pin, two-factor authentication, cookie, akun terkait
                            </p>
                        </div>

                        {{-- General Setting --}}
                        <div class="row">
                            
                            {{-- Include layout jump to --}}
                            @include('settings.layout_jump_to')

                            <div class="col-md-8">
                                <form id="settings" action="{{ route('settings.security.update', ''.$userData->id.'') }}" method="POST">

                                    {{-- Key Update --}}
                                    <input type="hidden" name="_user" value="{{ $userData->id }}">

                                    <div class="card" id="settings-card">
                                        <div class="card-header">
                                            <h4> Pengaturan Keamanan & info </h4> 
                                        </div>

                                        <div class="card-body">

                                            {{-- Security And Info --}}
                                            <div class="section-title mt-0 font-weight-bold"> Ganti kata sandi </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="new_password"> Kata sandi Baru </label>
                                                    <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Kata sandi baru" required> 
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="new_password_confirmation"> Konfirmasi kata sandi baru </label>
                                                    <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" placeholder="Konfirmasi kata sandi baru" required> 
                                                </div>
                                            </div>

                                            <div class="form-row">

                                                <div class="form-group col-md-6">
                                                    <label for="old_password"> Kata sandi lama </label>
                                                    <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Kata sandi lama" required> 
                                                </div>

                                            </div>

                                        </div>
                                        <div class="card-footer bg-whitesmoke ">
                                            <button class="btn btn-primary" id="save-btn"> Simpan </button>
                                            <button class="btn btn-secondary" type="button"> Kembali </button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>

                        


                    </section>
                </div>
@endsection

@push('js_html')

@endpush
