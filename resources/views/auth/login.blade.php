@extends('layouts.app')
@section('admin_content')

    <section class="content-main pt-80">
                <div class="card mx-auto card-login">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Sign in</h4>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <input class="form-control" for="email"  placeholder="Username or email" type="email" name="email" id="email" />
                            </div>
                            <!-- form-group// value="{{ __('Password') }}"value="{{ __('Email') }}"-->
                            <div class="mb-3">
                                <input class="form-control" for="password"  placeholder="Password" type="password" name="password" id="password" />
                            </div>
                            <!-- form-group// -->
                            <div class="mb-3">
                                <a href="{{ route('password.request') }}" class="float-end font-sm text-muted">Forgot password?</a>
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input" checked="" />
                                    <span class="form-check-label">Remember</span>
                                </label>
                            </div>
                            <!-- form-group form-check .// -->
                            <div class="row">
                                <div class="col-md-12 mb-4 justify-content-center d-grid">
                                    <button type="submit" class="btn btn-primary justify-content-center ">Login</button>
                                </div>
                            </div>
                            <!-- form-group// -->
                        </form>
                        </div>
                        <p class="text-center mb-4">Don't have account? <a href="{{ route('register') }}">Sign up</a></p>
                    </div>
                </div>
            </section>

@endsection