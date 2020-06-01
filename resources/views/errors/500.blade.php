@extends('layouts.app_errors')

{{-- Title Head --}}
@section('title_head', 'Where am i? 500')

{{-- Content --}}
@section('content')

            <div id="app">
                <section class="section">
                    <div class="container mt-5">
                        <div class="page-error">
                            <div class="page-inner">
                                <h1> 500 </h1>
                                <div class="page-description"> Oh tidakk, kesalahan fatal pada sistem. Yuk hubungi layanan bantuan... </div>
                                <div class="page-search">

                                    <div class="mt-3"> <a href="/"> Kembali yukk </a> </div>
                                </div>
                            </div>
                        </div>
                        <div class="simple-footer mt-5"> Copyright &copy; GazzPay | design with stisla </div>
                    </div>
                </section>
            </div>

@endsection
