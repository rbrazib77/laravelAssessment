@extends('admin.layouts.bashboard_master')
@section('title', 'Customers')
@section('admin')
    <div class="content">
        <!-- Start Content-->
        <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Customers</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add Customers</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Name">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Phone</label>
                                        <input type="text" name="phone" class="form-control" placeholder="Phone">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Email</label>
                                        <input type="email" step="0.01" name="email" class="form-control"
                                            placeholder="E-mail">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Address</label>
                                        <input type="text" name="address" class="form-control" placeholder="Address">
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <button class="btn btn-primary">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Customers list</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="GET" action="{{ route('customers.index') }}" class="mb-3">
                                    <div class="input-group">
                                        <input type="text" name="search" id="searchInput"
                                            value="{{ request('search') }}" class="form-control"
                                            placeholder="Search customer..." autocomplete="off">
                                        <button class="btn btn-primary">
                                            Search
                                        </button>
                                    </div>
                                </form>
                                <div class="table-responsive">
                                    <table class="table table-bordered nowrap align-middle">
                                        <thead class="table-light">
                                            <tr>
                                                <th>SL</th>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                                <th width="150">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($customers->count() > 0)
                                                @foreach ($customers as $customer)
                                                    <tr>
                                                        <td>
                                                            {{ $customers->firstItem() + $loop->index }}
                                                        </td>
                                                        <td>
                                                            {{ $customer->name }}
                                                        </td>
                                                        <td>
                                                            {{ $customer->phone }}
                                                        </td>
                                                        <td>
                                                            {{ $customer->email }}
                                                        </td>
                                                        <td>
                                                            {{ $customer->address }}
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                                data-bs-target="#editCustomer{{ $customer->id }}">
                                                                Edit
                                                            </button>
                                                            <a href="javascript:void(0);"
                                                                class="btn btn-danger btn-sm delete-btn"
                                                                data-url="{{ route('customers.destroy', $customer->id) }}">
                                                                Delete
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    {{-- Modal --}}
                                                    <div class="modal fade" id="editCustomer{{ $customer->id }}"
                                                        tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Update Customer</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="{{ route('customers.update', $customer->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="row">
                                                                            <div class="col-md-6 mb-3">
                                                                                <label>Name</label>
                                                                                <input type="text" name="name"
                                                                                    class="form-control"
                                                                                    value="{{ $customer->name }}">
                                                                            </div>
                                                                            <div class="col-md-6 mb-3">
                                                                                <label>Phone</label>
                                                                                <input type="text" name="phone"
                                                                                    class="form-control"
                                                                                    value="{{ $customer->phone }}">
                                                                            </div>
                                                                            <div class="col-md-6 mb-3">
                                                                                <label>Email</label>
                                                                                <input type="email" name="email"
                                                                                    class="form-control"
                                                                                    value="{{ $customer->email }}">
                                                                            </div>
                                                                            <div class="col-md-6 mb-3">
                                                                                <label>Address</label>
                                                                                <input type="text" name="address"
                                                                                    class="form-control"
                                                                                    value="{{ $customer->address }}">
                                                                            </div>
                                                                        </div>
                                                                        <button class="btn btn-primary w-100">
                                                                            Update Customer
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="12" class="text-center text-danger py-4">
                                                        No data available in table
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-end mt-3">
                                    {{ $customers->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- container-fluid -->
    </div>
@endsection
@push('scripts')
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            if (this.value === '') {
                window.location.href = "{{ route('customers.index') }}";
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
