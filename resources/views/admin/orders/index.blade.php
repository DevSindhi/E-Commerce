@extends('admin.layout')
 
@section('content')
    
       
	<!-- DataTables & Buttons CSS for Bootstrap 5 -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css" rel="stylesheet">
    
    <style>
        /* Small tweak to add spacing below the export buttons */
        .dt-buttons { margin-bottom: 15px; }

		.tableButtons {
			background-color : #0d6efd !important;
        }
    </style>


<h2 class="fw-bold mb-3">Manage Orders</h2>

<div class="container py-4">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card p-3 shadow-sm">
        <div class="table-responsive">
            <table class="table table-bordered align-middle export-table">
                <thead class="table-dark">
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th class="no-sort">Status</th>
                        <th width="200" class="no-sort">Update Status</th>
                        <th width="100" class="no-sort">Actions</th>
                    </tr>
                </thead>
                <tbody>

                @foreach($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>

                        <!-- Display Current Status with a Badge -->
                        <td>
                            @if($order->status == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif($order->status == 'processing')
                                <span class="badge bg-info text-dark">Processing</span>
                            @elseif($order->status == 'completed')
                                <span class="badge bg-success">Completed</span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                            @endif
                        </td>

                        <!-- Form to Change Status -->
                        <td class="align-middle">
                            <!-- Added m-0 to remove default form margin that messes up vertical centering -->
                            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="m-0">
                                @csrf
                                @method('PUT')
                                <!-- input-group-sm perfectly sizes the select and button together -->
                                <div class="input-group input-group-sm">
                                    <select name="status" class="form-select">
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </td>

                        <!-- Form to Delete Order -->
                        <td class="align-middle text-center">
                            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="m-0">
                                @csrf
                                @method('DELETE')
                                <!-- btn-sm matches the exact height of the input-group-sm above -->
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this order?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- jQuery (Required for DataTables) -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    
    <!-- DataTables Core -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    
    <!-- DataTables Export Buttons -->
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
                // This DOM string uses Bootstrap rows/cols to put Buttons on the left and Search on the right
                dom: "<'row mb-3'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6 d-flex justify-content-end'f>>" +
                     "<'row'<'col-sm-12'tr>>" +
                     "<'row mt-2'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                buttons: [
                    { extend: 'copy', className: 'btn btn-sm tableButtons me-2' },
                    { extend: 'csv', className: 'btn btn-sm tableButtons me-2' },
                    { extend: 'excel', className: 'btn btn-sm tableButtons me-2' },
                    { extend: 'pdf', className: 'btn btn-sm tableButtons me-2' },
                ],
                // Target any <th> with the class 'no-sort' and disable sorting for it
                columnDefs: [
                    { orderable: false, targets: 'no-sort' } 
                ],
                // Optional: Default sort by the first column (Order ID) descending so newest is at the top
                order: [[0, 'desc']]
            });
        });
    </script>
@endsection