@extends('newAdminDashboard.master')

@section('content')

<div class="content-header">
    <div>
        <h2 class="content-title card-title">Form Fields</h2>
    </div>
    <div>
        <a href="{{ route('dashboard.formfields.create') }}" class="btn btn-primary btn-sm rounded">Create New Fields</a>
    </div>
</div>

<!-- Main Category Dropdown -->
<div class="row mb-3">
    <div class="col-md-4">
        <form method="GET" action="{{ route('dashboard.form_fields') }}">
            <div class="form-group">
                <label for="main_category">Select Main Category</label>
                <select id="main_category" name="main_category_id" class="form-control" onchange="this.form.submit()">
                    <option value="">Select Main Category</option>
                    @foreach($mainCategories as $category)
                        <option value="{{ $category->id }}" 
                            {{ request('main_category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="formFieldsTable" class="table display">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Field Name</th>
                                <th>Field Type</th>
                                <th>Subcategory</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($formFieldsGrouped as $subcategoryId => $fields)
                                <tr>
                                    <td colspan="4" class="font-weight-bold">
                                        Subcategory: {{ $fields->first()->subcategory->name }}
                                    </td>
                                </tr>
                                @foreach($fields as $field)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $field->field_name }}</td>
                                        <td>{{ $field->field_type }}</td>
                                        <td>{{ $field->subcategory->name }}</td>
                                        <td> 
                                            <form id="deleteForm{{ $field->id }}" action="{{ route('dashboard.formfields.destroy', $field->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('deleteForm{{ $field->id }}', 'Are you sure you want to delete this field?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>

                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination Links -->
                    <div class="mt-3">
                        {{ $formFields->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')

<script>
    $(document).ready(function() {
        // Initialize DataTable for the combined table
        $('#formFieldsTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "lengthChange": true
        });
    });
</script>
<script>
    function confirmDelete(formId, message) {
        if (confirm(message)) {
            document.getElementById(formId).submit();
        }
    }
</script>

@endsection
