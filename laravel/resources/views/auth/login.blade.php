@extends('layouts.app')

@section('content')

    <body class="Login">


        <div class="container n">

            <div class=" ">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">{{ __('صفــحة تسجـــيـــل الدخــــول') }}</div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('login') }}" style="text-align:center;">
                                    @csrf

                                    <div class="form-group row">

                                        {{-- here old label --}}
                                       
                                        <div class="col-md-6">
                                        <input id="username" type="text"
                                                class="form-control @error('username') is-invalid @enderror"
                                                placeholder="ادخل اسم المستخدم" name="username"
                                                value="{{ old('username') }}" required autocomplete="username" autofocus>
                                            @error('username')


                                           
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <label for="username" class="col-md-4-col-form-label-text-md-left">
                                            {{ __('اسم المستخدم') }}</label>
                                        {{-- here new label --}}
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="ادخل كلمة المرور" name="password" required
                                                autocomplete="current-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <label for="password"
                                            class="col-md-4-col-form-label-text-md-left">{{ __('كلمة المرور') }}</label>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6 offset-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    {{ __('تذكير') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-8-offset-md-4">
                                            <button type="submit" class="btn-btn-primary">
                                                {{ __('تسجيل الدخول') }}
                                            </button>

                                            @if (Route::has('password.request'))
                                                <a class="btn-btn-link" href="{{ route('password.request') }}">
                                                    {{ __('هل نسيت كلمة المرور؟') }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
@endsection
