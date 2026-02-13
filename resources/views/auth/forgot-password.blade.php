@extends('layouts.app')
@section('admin_content')

    <section class="content-main pt-80">
                <div class="card mx-auto card-login">
                    <div class="card-body">
                        <h4 class="card-title mb-4 justify-content-center text-center">Forgot Password</h4>
                        <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                            <div class="mb-3">
                                <p>Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>
                                @if (session('status'))
                                    <div class="mb-4 font-medium text-danger">
                                        {{ session('status') }}
                                    </div>    
                                @endif
                                <input class="form-control" for="email"  placeholder="email" type="email" name="email" id="email" />
                            </div>
                            <!-- form-group form-check .// -->
                            <div class="row">
                                <div class="col-md-12 mb-4 justify-content-center d-grid">
                                    <button type="submit" class="btn btn-primary justify-content-center ">Email Password Reset Link</button>
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