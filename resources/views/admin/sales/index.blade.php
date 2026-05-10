@extends('admin.layouts.bashboard_master')
@section('title', 'Sales')
@section('admin')
    <div class="content">
        <!-- Start Content-->
        <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">All Invoices</h4>
                </div>
                <div>
                    <a href="{{ route('sales.create') }}" class="btn btn-primary">
                        + Create Invoice
                    </a>
                </div>
            </div>
            <div class="row">

                <div class="col-md-12">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="GET" action="{{ route('sales.index') }}" class="mb-3">

                                    <div class="input-group">

                                        <input type="date" name="date" id="dateInput" class="form-control"
                                            value="{{ request('date') }}">

                                        <button class="btn btn-primary">
                                            Search
                                        </button>

                                    </div>

                                </form>
                                <table 
                                    class="table table-bordered table-bordered dt-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Customer</th>
                                            <th>Total</th>
                                            <th>Discount</th>
                                            <th>Grand Total</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sales as $sale)
                                            <tr>
                                                <td>{{ $sales->firstItem() + $loop->index }}</td>
                                                <td>{{ $sale->customer->name }}</td>
                                                <td>{{ $sale->total }}</td>
                                                <td>{{ $sale->discount }}</td>
                                                <td>{{ $sale->grand_total }}</td>
                                                <td>{{ $sale->created_at->format('d-m-Y') }}</td>
                                                <td>
                                                    <a href="{{ route('sales.show', $sale->id) }}"
                                                        class="btn btn-info btn-sm">
                                                        invoice
                                                    </a>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                 <div class="d-flex justify-content-end mt-3">

                                    {{ $sales->links() }}

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div>

@endsection

@push('scripts')
    <script>
        document.getElementById('dateInput')
            .addEventListener('change', function() {
                if (this.value === '') {
                    window.location.href = "{{ route('sales.index') }}";
                }
            });
    </script>
    <script>
        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('delete-btn')) {
                const url = e.target.dataset.url;
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This action will delete.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                });
            }
        });
    </script>
@endpush
