@extends('layouts.app')
@section('admin_content')

<section class="content-main mt-80 mb-80">
                <div class="card mx-auto card-login">
                    <div class="card-body">
                        <h4 class="card-title mb-4 justify-content-center text-center"> Reset Password</h4>
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            @if ($errors->any())
                            <ul>
                                @foreach ($errors->all as $errors )
                                <li class="text-danger">(($errors))</li>
                                @endforeach
                            </ul>
                            @endif  
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">
                            <div class="mb-3">
                                <!-- value="{{ __('Email') }}" -->
                                <label class="form-label">Email</label> 
                                <input for="email"  class="form-control" placeholder="Your email" type="email" name="email" id="email"  required autocomplete="username"/>
                            </div>
                            
                            <!-- form-group// -->
                            <div class="mb-3">  
                                <!-- value="{{ __('password') }}" -->
                                <label class="form-label">New password</label>
                                <input for="password"class="form-control" placeholder="Password" type="password" name="password" id="password" required autocomplete="new-password" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">confirm password</label>
                                <!-- value="{{ __('pasword_confirmation') }}" -->
                                <input for="password_confirmation" class="form-control" placeholder="Password confirmation" type="password" name="password_confirmation" id="password_confirmation" required  />
                            </div>
                            <!-- form-group// -->
                            <!-- <div class="mb-3">
                                <p class="small text-center text-muted">By signing up, you confirm that you’ve read and accepted our User Notice and Privacy Policy.</p>
                            </div> -->
                            <!-- form-group  .// -->
                            <div class="row">
                                <div class="col-md-12 mb-4 justify-content-center d-grid">
                                    <button type="submit" class="btn btn-primary justify-content-center "> Reset Password</button>
                                </div>
                            </div>
                            
                            <!-- form-group// -->
                        </form>
                        <p class="text-center mb-2">Already have an account? <a href="{{ route('login') }}">Sign in now</a></p>
                    </div>
                </div>
            </section>

@endsection