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
                            <h2 class="section-title"> Pengaturan Umum </h2>
            
                            <p class="section-lead">
                                Nama, email, nohp, identitas
                            </p>
                        </div>

                        {{-- General Setting --}}
                        <div class="row">
                            
                            {{-- Include layout jump to --}}
                            @include('settings.layout_jump_to')

                            <div class="col-md-8">
                                <form id="settings" action="{{ route('settings.general.update', ''.$userData->id.'') }}" method="POST">

                                    {{-- Key Update --}}
                                    <input type="hidden" name="_user" value="{{ $userData->id }}">

                                    <div class="card" id="settings-card">
                                        <div class="card-header">
                                            <h4> Pengaturan Umum </h4> 
                                        </div>

                                        <div class="card-body">

                                            {{-- Profile --}}
                                            <div class="form-row">
                                                <div class="form-group">
                                                    <figure class="avatar ml-2 avatar-xl">
                                                        <img src="{{ asset('assets/img/avatar/avatar-1.png') }}" alt="...">
                                                        
                                                    </figure>
                                                    <div class="user-item ">
                                                        <div class="user-details text-left">
                                                            <div class="user-name profileName"> {{ $userData->name }}</div>
                                                            <div class="text-job text-muted profileEmail"> {{ $userData->email }} </div>
                                                            <div class="text-job text-muted profileNohp"> {{ $userData->nohp }} </div>
                                                            
                                                        </div>
                                                    </div>
                                                    
                                                    <a href="javascript:void(0);" class="mr-1">
                                                        <abbr class="text-primary profile_change" onclick="profileUpdate()" title="Ganti foto profile">  
                                                            Ganti
                                                        </abbr>
                                                    </a>
                                                    <a href="javascript:void(0);">
                                                        <abbr class="text-danger profile_delete" onclick="profileUpdate()" title="Hapus foto profile"> 
                                                            Hapus 
                                                        </abbr>
                                                    </a>
                                                    
                                                </div>
                                            </div>

                                            {{-- General Profile --}}
                                            <div class="section-title mt-0 font-weight-bold"> Dasar </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="first_name"> Nama Depan </label>
                                                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Nama depan" > 
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="last_name"> Nama Belakang </label>
                                                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Nama belakang" > 
                                                </div>
                                            </div>

                                            <div class="section-title mt-0 font-weight-bold"> Kontak </div>     
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="email"> Email </label>
                                                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" > 
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="nohp"> No Handphone </label>
                                                    <input type="text" class="form-control" id="nohp" name="nohp" placeholder="Nomor HP" > 
                                                </div>
                                            </div>

                                        </div>
                                        <div class="card-footer bg-whitesmoke ">
                                            <button type="sumbit" class="btn btn-primary" id="save-btn" > Simpan </button>
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
