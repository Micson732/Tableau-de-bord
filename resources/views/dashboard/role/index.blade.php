@extends('layouts.app')
@section('admin_content')
<section class="content-main">
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Roles</h2>
            <p>list of roles with permissions</p>
        </div>
        <div>
            @can('role-create')
                <a href="{{ route('role.create') }}" class="btn btn-primary">
                    <i class="material-icons md-add me-1"></i>Create Role
                </a>
            @endcan
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>#ID</th>
                            <th>Nom</th>
                            <th>Permissions</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($roles as $key => $role)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <b class="text-capitalize">{{ $role->name }}</b>
                                </td>
                                <td>
                                    @forelse($role->permissions as $permission)
                                        <span class="badge bg-primary me-1 mb-1">
                                            {{ $permission->name }}
                                        </span>
                                    @empty
                                        <span class="text-muted"> Permission not found</span>
                                    @endforelse
                                </td>
                                <td class="text-end">
                                    <div class="dropdown">
                                        <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm">
                                            <i class="material-icons md-more_vert"></i>
                                        </a>
                                        @can('role-show')
                                            <a href="{{route('role.show', $role->id)}}" class="btn btn-sm font-sm rounded btn-brand"><i class="material-icons md-detail"></i> Detail </a>
                                        @endcan
                                        <div class="dropdown-menu dropdown-menu-end">
                                            @can('role-edit')
                                                <a class="dropdown-item" href="{{ route('role.edit', $role->id) }}">
                                                    <i class="material-icons md-edit me-2"></i>Edit detail
                                                </a>
                                            @endcan
                                            
                                                <form action="{{ route('role.destroy', $role->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    
                                                    @can('role-delete')
                                                    <button type="submit" class="dropdown-item text-danger" 
                                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce rôle ?')">
                                                        <i class="material-icons md-delete_forever me-2"></i>Delete
                                                    </button>
                                                    @endcan
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
                                        <p class="mt-2">Aucun rôle trouvé</p>
                                           
                                        @can('role-create')
                                        <a href="{{ route('role.create') }}" class="btn btn-primary mt-2">
                                                <i class="material-icons md-add me-1"></i> Create Role
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