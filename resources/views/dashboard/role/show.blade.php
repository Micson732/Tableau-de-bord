@extends('layouts.app')
@section('admin_content')
<section class="content-main">
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Roles</h2>
            <p>View Role</p>
        </div>
        <div>
            @if(auth()->user()->can('role-create'))
                <a href="{{ route('role.create') }}" class="btn btn-primary">
                    <i class="material-icons md-add me-1"></i>Create Role
                </a>
            @endif
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h6>Role Name: {{$role->name}}</h6>
            <div class="row">
                @foreach($rolePermissions as $permission)

                <div class="col-md-2">
                    {{$permission}}
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    // Initialisation des tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endpush
@endsection