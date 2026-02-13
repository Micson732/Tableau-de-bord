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
            <a href="{{ route('permission.create') }}" class="btn btn-primary">
                <i class="material-icons md-add me-1"></i> Create Permissions
            </a>
            @endcan

        </div>
    </div>

    <!-- Formulaire de suppression caché -->
    <form id="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <!-- Formulaire principal de synchronisation -->
    <div class="card mb-4">
        <form action="{{ route('sync-permission') }}" method="POST" id="syncForm">
            @csrf
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Permission Name</th>
                                @foreach($roles as $role)
                                    <th scope="col">{{ $role->name }}</th>
                                @endforeach
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($permissions as $key => $value)
                                <tr>
                                    <td>{{ $value->name }}</td>
                                    @foreach($roles as $role)
                                        <td>
                                            <input type="checkbox" 
                                                name="permissions[{{ $role->name }}][]" 
                                                value="{{ $value->name }}" 
                                                {{ $role->hasPermissionTo($value->name) ? 'checked' : '' }}>
                                        </td>
                                    @endforeach
                                    <td class="text-end">
                                        <div class="dropdown d-inline">
                                            <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm">
                                                <i class="material-icons md-more_vert"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="{{ route('permission.show', $value->id) }}">
                                                    <i class="material-icons md-detail me-2"></i> Details
                                                </a>
                                                <a class="dropdown-item" href="{{ route('permission.edit', $value->id) }}">
                                                    <i class="material-icons md-edit me-2"></i> Edit
                                                </a>
                                                <a class="dropdown-item text-danger delete-permission" 
                                                   href="#" 
                                                   data-url="{{ route('permission.destroy', $value->id) }}">
                                                    <i class="material-icons md-delete_forever me-2"></i> Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-3 center">
                    <button type="submit" class="btn btn-primary center">
                        <i class="material-icons md-save me-1"></i> Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gestion de la suppression
    document.querySelectorAll('.delete-permission').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            if (confirm('are you sure you want to delete this permission ?')) {
                const form = document.getElementById('deleteForm');
                form.action = this.dataset.url;
                form.submit();
            }
        });
    });

    // Initialisation des tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>
@endpush
@endsection