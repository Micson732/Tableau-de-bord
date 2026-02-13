@extends('layouts.app')
@section('admin_content')
<section class="content-main">
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Permissions</h2>
            <p>list of permissions</p>
        </div>
        <div>
            @can('permission-create')
                @can('role-create')
                    <a href="{{ route('role-permission') }}" class="btn btn-primary">
                        <i class="material-icons md-add me-1"></i>Roles Permissions
                    </a>
                @endcan
            @endcan
            
            @can('permission-create')
                <a href="{{ route('permission.create') }}" class="btn btn-primary">
                    <i class="material-icons md-add me-1"></i>Create Permission
                </a>
            @endcan
            
            </div>
    </div>

    <div class="card mb-6">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>#ID</th>
                            <th>Nom</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($permissions as $key => $permission)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <b class="text-capitalize">{{ $permission->name }}</b>
                                </td>
                                <td class="text-end">
                                    <div class="dropdown">
                                        <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm">
                                            <i class="material-icons md-more_vert"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            @can('permission-edit')
                                                <a class="dropdown-item" href="{{ route('permission.edit', $permission->id) }}">
                                                    <i class="material-icons md-edit me-2"></i>Edit detail
                                                </a>
                                            @endcan
                                            @can('permission-delete')
                                                <form action="{{ route('permission.destroy', $permission->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    @endcan
                                                        <button type="submit" 
                                                                class="dropdown-item text-danger" 
                                                                onclick="return confirm('are you sure you want to delete this permission ?')">
                                                            <i class="material-icons md-delete_forever me-2"></i>Delete
                                                        </button> 
                                                    
                                                </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="material-icons md-inbox me-2" style="font-size: 2rem;"></i>
                                        <p class="mt-2">Aucune permission trouvée</p>
                                        
                                        @can('permission-create')
                                            <a href="{{ route('permission.create') }}" class="btn btn-primary mt-2">
                                                <i class="material-icons md-add me-1"></i> Create Permission
                                            </a>
                                        @endcan
                                        
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
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