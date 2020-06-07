@extends('layouts.app_errors')

{{-- Title Head --}}
@section('title_head', 'Where am i? 404')

{{-- Content --}}
@section('content')

            <div id="app">
                <section class="section">
                    <div class="container mt-5">
                        <div class="page-error">
                            <div class="page-inner">
                                {{-- <h1> 404 </h1> --}}
                                <img src="https://image.freepik.com/free-vector/error-404-concept-illustration_114360-1811.jpg"/>
                                <div class="page-description mt-4"> Whoops halaman tidak ditemukan nihh... </div>
                                <div class="page-search">
                                    <a href="/">
                                        <div class="btn btn-primary mt-3">  Kembali yukk </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="simple-footer mt-5"> Copyright &copy; GazzPay | design with stisla </div>
                    </div>
                </section>
            </div>

@endsection
