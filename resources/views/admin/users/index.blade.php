@extends('admin.layout')

@section('content')

    <!-- DataTables & Buttons CSS for Bootstrap 5 (SAFELY INSIDE SECTION) -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css" rel="stylesheet">
    
    <style>
        /* Small tweak to add spacing below the export buttons */
        .dt-buttons { margin-bottom: 15px; }

        .tableButtons {
            background-color : #0d6efd !important;
            border-color: #0d6efd !important; 
            color: white !important;
        }
    </style>

<h2 class="fw-bold mb-3">Manage Users</h2>

<div class="container py-4">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.users.create') }}" class="btn btn-success mb-3">Add User</a>

    <div class="card p-3 shadow-sm">
        <div class="table-responsive">
            <table class="table table-bordered align-middle export-table">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th width="180" class="no-sort text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>

                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>

                        <!-- Centered and vertically aligned Actions -->
                        <td class="align-middle text-center">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm me-1">Edit</a>

                            <!-- Added m-0 to the form for perfect vertical centering -->
                            @if(auth()->id() !== $user->id)
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline m-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this user?')">Delete</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
		</div>
    </div>

</div>

    <!-- jQuery & DataTables Scripts (SAFELY INSIDE SECTION) -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

    <!-- Initialize DataTable -->
    <script>
        $(document).ready(function() {
            $('.export-table').DataTable({
                dom: "<'row mb-3'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6 d-flex justify-content-end'f>>" +
                     "<'row'<'col-sm-12'tr>>" +
                     "<'row mt-2'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                buttons: [
                    { extend: 'copy', className: 'btn btn-sm tableButtons me-2' },
                    { extend: 'csv', className: 'btn btn-sm tableButtons me-2' },
                    { extend: 'excel', className: 'btn btn-sm tableButtons me-2' },
                    { extend: 'pdf', className: 'btn btn-sm tableButtons me-2' },
                ],
                columnDefs: [
                    { orderable: false, targets: 'no-sort' } 
                ],
                // Sort by Name (first column) alphabetically by default
                order: [[0, 'asc']]
            });
        });
    </script>

@endsection