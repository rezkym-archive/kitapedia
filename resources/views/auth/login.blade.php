@extends('layouts.app_auth')

{{-- Title head --}}
@section('title_head', 'Masuk')

{{-- Content --}}
@section('content')
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
        <div class="login-brand">
            {{-- <img src="assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle"> --}}
        </div>

        <div class="card card-primary">
            <div class="card-header"><h4> Masuk </h4></div>

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

                <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                    {{-- CSRF --}}
                    @csrf

                    <div class="form-group">

                        <label for="username"> Email / Username </label>
                        <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" tabindex="1" required autofocus>
                        
                        {{-- if username/email error --}}
                        @error('username')    
                            <div class="invalid-feedback">
                                
                            </div>
                        @enderror

                    </div>

                    <div class="form-group">

                        <div class="d-block">
                            <label for="password" class="control-label"> Kata sandi </label>
                            <div class="float-right">
                            <a href="javascript:void(0);" class="text-small">
                                Lupa kata sandi? 
                            </a>
                            </div>
                        </div>
                        <input id="password" type="password" class="form-control" name="password" tabindex="2" required>

                        {{-- if password error --}}
                        @error('password')
                            <div class="invalid-feedback">
                                
                            </div>
                        @enderror
                        
                    </div>
                    
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me" {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="remember-me"> Ingat saya </label>
                        </div>
                    </div>

                    <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        Masuk
                    </button>
                    </div>
                </form>
            <div class="text-center mt-4 mb-3">
                <div class="text-job text-muted"> Masuk dengan sosial media </div>
            </div>
            <div class="row sm-gutters">
                <div class="col-6">
                <a class="btn btn-block btn-social btn-facebook">
                    <span class="fab fa-facebook"></span> Facebook
                </a>
                </div>
                <div class="col-6">
                <a class="btn btn-block btn-social btn-google">
                    <span class="fab fa-google"></span> Google
                </a>                                
                </div>
            </div>

            </div>
        </div>
        <div class="mt-5 text-muted text-center">
            Tidak punya akun? <a href="{{ route('register') }}"> Daftar Gratiss! </a>
        </div>
        <div class="simple-footer">
            Copyright &copy; GazzPay {{ date('Y') }} with Stisla 2018 template
        </div>
        </div>
    </div>
@endsection
