@extends('layouts.auth_master')

@section('content')

    <div class="account-pages my-5 pt-sm-5 " >
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mb-5 text-muted">
                        <a href="{{ route('login') }}" class="d-block auth-logo">
                            <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="20" class="auth-logo-dark mx-auto">
                            <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="20" class="auth-logo-light mx-auto">
                        </a>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card">

                        <div class="card-body">

                            <div class="p-2">
                                <div class="text-center">

                                    <div class="avatar-md mx-auto">
                                        <div class="avatar-title rounded-circle bg-light">
                                            <i class="bx bxs-envelope h1 mb-0 text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="p-2 mt-4">

                                        <h4>Verify your email</h4>
                                        <p class="mb-5">Please enter the Verification code sent to
                                        <span  class="font-weight-semibold">
                                            your Email : {{ substr(auth()->user()->email, 0, 5) . '******' . substr(auth()->user()->email,  -2) }}
                                        </span>
                                        </p>

                                        @if ($message = Session::get('success'))
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="alert alert-success alert-block">
                                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @if ($message = Session::get('error'))
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="alert alert-danger alert-block">
                                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <form method="POST" action="{{ route('2fa.post') }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12">
                                                    <input id="code" type="number" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" required autocomplete="code" autofocus>

                                                    @error('code')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                        <div class="mt-4">
                                            <button type="submit" class="btn btn-success w-md">Confirm</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <p>Did't receive a code ?      <a class="font-weight-medium text-primary" href="{{ route('2fa.resend') }}">Resend Code?</a> </p>
                        <p>©
                            <script>document.write(new Date().getFullYear())</script> DHB Graphics.</p>
                    </div>

                </div>
            </div>
        </div>
    </div>



@endsection
