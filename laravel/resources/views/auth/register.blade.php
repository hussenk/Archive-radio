@extends('layouts.app')

@section('content')
<body class="Login">
    

    <div class="container height">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('إنشــــاء حســــاب') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                          
                            <div class="form-group-row">
                            <label for="name" class="col-m-4-col-form-label-text-md-right">{{ __(':الإسم') }}</label>

                              
<input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            <div class="col-md-6">
                            
                              
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group-row">
                            <label for="username" class="col-md-4-col-form-label-text-md-right">{{ __(':إسم المستخدم') }}</label>

                                
                                    <input id="username" type="text"
                                        class="form-control @error('username') is-invalid @enderror" name="username"
                                        value="{{ old('username') }}" required autocomplete="username">

                            <div class="col-md-6">
                                
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group-row">
                            <label for="email"
                                    class="col-md-4-col-form-label-text-md-right">{{ __(' :البريد الإلكتروني') }}</label>

                              
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email">

                            <div class="col-md-6">
                               
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group-row">
                            <label for="password"
                                    class="col-md-4-col-form-label-text-md-right">{{ __(' :كلمة المرور') }}</label>

                                
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                            <div class="col-md-6">
                               
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group-row">
                            <label for="password-confirm"
                                    class="col-md-4-col-form-label-text-md-right">{{ __(' :تأكيد كلمة المرور') }}</label>

                               
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                               
                            <div class="col-md-6">
                                 </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6-offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('إنشاء حساب') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection
