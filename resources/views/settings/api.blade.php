@extends('layouts.app')

{{-- Title Head --}}
@section('title_head', 'Beranda')

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
                                <div class="breadcrumb-item"> API </div>
                            </div>

                        </div>

                        <div class="section-body">
                            <h2 class="section-title"> Pengaturan API </h2>
            
                            <p class="section-lead">
                                Kunci API, sunting API, sunting IP static, white list
                            </p>
                        </div>

                        {{-- General Setting --}}
                        <div class="row">
                            
                            {{-- Include layout jump to --}}
                            @include('settings.layout_jump_to')

                            <div class="col-md-8">
                                <form id="setting-form">

                                    <div class="card" id="settings-card">
                                        <div class="card-header">
                                            <h4> Pengaturan API </h4> 
                                        </div>

                                        <div class="card-body">                                         

                                            {{-- Currently API Key --}}
                                            <div class="section-title mt-0 font-weight-bold"> Kunci Sekarang </div>

                                            <div class="form-group">
                                                <h6 class="custom-switch custom-switch-description font-weight-bold" id="apikey" value="ajks99282kkawd882mmmdwawj12832" onclick="copy()"> 
                                                    ajks99282kkawd882mmmdwawj12832 
                                                </h6>
                                                <label class="custom-switch align-center">
                                                    <div class="">
                                                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
                                                        <span class="custom-switch-indicator"></span>
                                                    </div>
                                                </label>
                                            </div>

                                            <div class="section-title mt-0 font-weight-bold"> Buat Baru </div>
                                            <div class="form-group">
                                                <p class="ml-5 mt-1"> Buat API key baru <button class="btn btn-primary btn-sm btn btn-primary btn-sm ml-4 col-sm-2"> Buat baru </button> </p>
                                                
                                            </div>
                                            

                                            <div class="section-title mt-0 font-weight-bold"> Pengaturan </div>
                                            <div class="form-group col-md-4">
                                                <label for="ip_static" class=""> Ip Statis </label>
                                                <input type="text" class="form-control" id="ip_static" name="ip_static" placeholder="Ip statis">

                                            </div>

                                            

                                        </div>
                                        <div class="card-footer bg-whitesmoke ">
                                            <button class="btn btn-primary" id="save-btn"> Perbarui </button>
                                            <button class="btn btn-secondary" type="button" > Ulangi </button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>


                    </section>
                </div>
@endsection

{{-- JS in HTML --}}
@push('js_html')

@endpush
