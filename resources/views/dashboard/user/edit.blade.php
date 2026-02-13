@extends('layouts.app')
@section('admin_content')

    <section class="content-main">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="content-header">
                            <h2 class="content-title">Update User</h2>
                            <div>
                                <a href="{{ route('user.index')}}" class="btn btn-md rounded font-sm hover-up">View all</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h4>User Update</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action=" {{ route('user.update', $user->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <label  class="form-label">Use Name</label>
                                            <input for="name" type="text" placeholder="UserName" class="form-control" value="{{ $user->name }}" id="name" name="name" required/>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label  class="form-label">Your Email</label>
                                            <input for="email" type="email" placeholder="Your adress"value="{{ $user->email }}" class="form-control" id="email" name="email" required/>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label  class="form-label">Create Password</label>
                                            <input for="password" type="password" placeholder="Leave empty to keep current password" class="form-control" id="password" name="password" />
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label  class="form-label">Confirm Password</label>
                                            <input for="password_confirmation" type="password" placeholder="Confirm New Password" class="form-control" id="password_confirmation" name="password_confirmation" />
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label class="form-label">Rôle</label>
                                            <div class="row">
                                                @foreach($roles as $role)
                                                    <div class="form-radio">
                                                        <input class="form-radio-input"
                                                            type="radio"
                                                            name="roles[]"
                                                            value="{{ $role->name }}"
                                                            id="role_{{ $role->id }}"
                                                            {{ $user->hasRole($role->name) ? 'checked' : (old('roles') && in_array($role->name, old('roles')) ? 'checked' : '') }}>
                                                        <label class="form-check-label" for="role_{{ $role->id }}">
                                                            {{ $role->name }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-md-4 form-group input-upload">
                                            <img src="{{ asset('dashboard/assets/imgs/theme/upload.svg') }}" alt="" />
                                            <input class="form-control" type="file" />
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-md-4 form-group">
                                                <input type="submit" value="Update" class="btn btn-primary align-center">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
    </section>

@endsection