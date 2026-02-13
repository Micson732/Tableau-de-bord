@extends('layouts.app')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@section('admin_content')

    <section class="content-main">
        <div class="content-header">
                    <div>
                        <h2 class="content-title card-title">Users</h2>
                        <p>list of users</p>
                    </div>
                    <div>
                        @can('user-create')
                        <a href="{{ route('user.create')}}" class="btn btn-primary"><i class="text-muted material-icons md-post_add"></i>Create User</a>
                        @endcan
                    </div>
        </div>

        <div class="card mb-4">
                    <!-- card-header end// -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Role</th>
                                        <th scope="col" class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key=>$value )
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><b>{{ $value->name }}</b></td>
                                        <td>{{ $value->email }}</td>
                                        <!-- <td>@if($value->roles->first()){{ $value->roles->first()->name }}@endif</td> -->
                                        <td>
                                            @if($value->roles->isNotEmpty())
                                                @foreach($value->roles as $role)
                                                    <span class="badge bg-primary me-1">{{ $role->name }}</span>
                                                @endforeach
                                            @else
                                                <span class="text-muted">No role assigned</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            
                                            <form action="{{ route('user.destroy', $value->id) }}" method="post">
                                                @csrf

                                                @method('delete')
                                                @can('user-show')
                                                <a href="#" class="btn btn-sm font-sm rounded btn-brand"><i class="material-icons md-detail"></i> Detail </a>
                                                @endcan
                                                <div class="dropdown d-inline-block">
                                                    <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm">
                                                        <i class="material-icons md-more_horiz"></i>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        @can('user-edit')
                                                        <a class="dropdown-item" href="{{ route('user.edit', $value->id) }}">Edit detail</a>
                                                        @endcan
                                                        @can('user-delete')
                                                        <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure?')">Delete</button>
                                                        @endcan
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- table-responsive //end -->
                    </div>
                    <!-- card-body end// -->
                </div>
    </section>

@endsection