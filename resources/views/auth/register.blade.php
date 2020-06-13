@extends('layouts.app_auth')

{{-- Title Head --}}
@section('title_head', 'Daftar')

{{-- Content --}}
@section('content')
    <div class="row">
        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
        <div class="login-brand">
            <img src="assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
        </div>

        <div class="card card-primary">
            <div class="card-header"><h4> Daftar </h4></div>

            <div class="card-body">
                {{-- Show Error --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible show fade">
                        <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>×</span>
                        </button>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    {{-- CSRF --}}
                    @csrf

                    <div class="row">
                        <div class="form-group col-6">
                            <label for="name"> Nama Lengkap </label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>
                        </div>
                        @error('name')
                            <div class="invalid-feedback">

                            </div>
                        @enderror
                        

                        <div class="form-group col-6">
                            <label for="username"> Username </label>
                            <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" autofocus>
                        </div>
                        @error('username')
                            <div class="invalid-feedback">

                            </div>
                        @enderror
                        
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label for="email"> Email </label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus>
                        </div>
                        @error('email')
                            <div class="invalid-feedback">

                            </div>
                        @enderror
                        

                        <div class="form-group col-6">
                            <label for="nohp"> No Hp </label>
                            <input id="nohp" type="text" class="form-control" name="nohp" value="{{ old('nohp') }}" autofocus>
                        </div>
                        @error('nohp')
                            <div class="invalid-feedback">

                            </div>
                        @enderror
                        
                    </div>


                    <div class="row">
                        <div class="form-group col-6">
                            <label for="password" class="d-block"> Kata sandi </label>
                            <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password">
                            <div id="pwindicator" class="pwindicator">
                            <div class="bar"></div>
                            <div class="label"></div>
                            </div>
                        </div>
                        @error('password')
                            <div class="invalid-feedback">

                            </div>
                        @enderror
                        

                        <div class="form-group col-6">
                            <label for="password_confirmation" class="d-block"> Konfirmasi kata sandi </label>
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation">
                        </div>
                        @error('password_confirmation')
                            <div class="invalid-feedback">

                            </div>
                        @enderror

                    </div>


                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="agree" class="custom-control-input" id="agree">
                            <label class="custom-control-label" for="agree"> Saya setuju dengan syarat dan ketentuan </label>
                        </div>
                    </div>

                    <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                        Daftar
                    </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="simple-footer">
            Copyright &copy; {{ env('APP_NAME') }} {{ date('Y') }} with Stisla template
        </div>
        </div>
    </div>
@endsection
