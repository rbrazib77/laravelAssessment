@extends('admin.layouts.bashboard_master')
@section('title', 'Categories')
@section('admin')
    <div class="content">
        <!-- Start Content-->
        <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Category</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add Category</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('category.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Category Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="e.g. Web Design">
                                    @error('name')
                                        <span class="text-danger" style="font-size: 14px;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Order</label>
                                    <input type="text" name="order" class="form-control" placeholder="order">
                                    @error('order')
                                        <span class="text-danger" style="font-size: 14px;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-select">
                                        <option value="">Select Status</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button class="btn btn-primary btn-block">Add Category</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered table-bordered dt-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Name</th>
                                            <th>Order</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{ $categories->firstItem() + $loop->index }}</td>
                                                <td>{{ $category->name }}</td>
                                                <td>{{ $category->order }}</td>
                                                <td>
                                                    @if ($category->status == 'active')
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-warning btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editCategoryModal{{ $category->id }}">
                                                        Edit
                                                    </button>
                                                    <a href="javascript:void(0);" class="btn btn-danger btn-sm delete-btn"
                                                        data-url="{{ route('category.destroy', $category->id) }}">Delete</a>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Category</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <form action="{{ route('category.update', $category->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="form-group mb-2">
                                                                    <label>Category Name</label>
                                                                    <input type="text" name="name"
                                                                        class="form-control" value="{{ $category->name }}">
                                                                    @error('name')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group mb-2">
                                                                    <label>Order</label>
                                                                    <input type="text" name="order"
                                                                        class="form-control"
                                                                        value="{{ $category->order }}">
                                                                    @error('order')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group mb-2">
                                                                    <label>Status</label>
                                                                    <select name="status" class="form-select">
                                                                        <option value="active"
                                                                            {{ $category->status == 'active' ? 'selected' : '' }}>
                                                                            Active
                                                                        </option>
                                                                        <option value="inactive"
                                                                            {{ $category->status == 'inactive' ? 'selected' : '' }}>
                                                                            Inactive
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button class="btn btn-primary">Update Category</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-end mt-3">
                                    {{ $categories->links() }}
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
