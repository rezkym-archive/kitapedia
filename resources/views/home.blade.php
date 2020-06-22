@extends('layouts.app')

{{-- Title Head --}}
@section('title_head', 'Beranda')

{{-- Title Head --}}
@section('title_head', 'Kelola Pengguna')

{{-- Css Lib --}}
@push('css_lib')
    
    <!-- CSS Libraies -->

@endpush

{{-- Js Lib --}}
@push('js_lib')

    <!-- JS Libraies -->

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
                            <h1> Example </h1>

                            <div class="section-header-breadcrumb">
                                <div class="breadcrumb-item active"><a href="{{ url('/') }}"> Beranda </a></div>
                                <div class="breadcrumb-item"> Example </div>
                            </div>

                        </div>

                        <div class="section-body">
                            <h2 class="section-title"> Example </h2>
            
                            <p class="section-lead">
                                Example
                            </p>
                        </div>


                    </section>
                </div>
@endsection
