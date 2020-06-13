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
                                <img class="mb-4" src="https://image.freepik.com/free-vector/construction-concept-illustration_114360-1917.jpg" height="450px"/>
                                <div class="page-description"> Oppss!! kita sedang memperbarui website nih. Nanti kamu balik lagi yaaa... </div>
                                
                                @if ($exception->getMessage())
                                    <div class="page-description font-weight-bold"> Jangan lupa berikan kode ini kepada layanan bantuan yahhh ({{ $exception->getMessage() }}) </div>
                                @endif
                                
                                <div class="page-search">
                                    <a href="/">
                                        <div class="btn btn-primary mt-3">  Kembali yukk </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="simple-footer mt-5"> Copyright &copy; {{ env('APP_NAME') }} Design by stisla </div>
                    </div>
                </section>
            </div>

@endsection
