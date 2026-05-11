@extends('admin.layouts.bashboard_master')
@section('title', 'Products')
@section('admin')
    <div class="content">
        <!-- Start Content-->
        <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center justify-content-between flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Products</h4>
                </div>

                <div class="mt-2 mt-sm-0">
                    <a href="{{ route('products.create') }}" class="btn btn-primary">
                        <i class="mdi mdi-plus-circle me-1"></i>Products Create
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="GET" action="{{ route('products.index') }}" class="mb-3">
                                    <div class="input-group">
                                        <input type="text" name="search" id="searchInput" class="form-control"
                                            placeholder="Search Product or SKU..." value="{{ request('search') }}"
                                            autocomplete="off">
                                        <button class="btn btn-primary">
                                            Search
                                        </button>
                                    </div>
                                </form>
                                <div class="table-responsive">
                                    <table class="table table-bordered align-middle nowrap">
                                        <thead class="table-light">
                                            <tr>
                                                <th>SL</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>SKU</th>
                                                <th>Price</th>
                                                <th>Stock</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($products->count() > 0)
                                                @foreach ($products as $product)
                                                    <tr>
                                                        <td>{{ $products->firstItem() + $loop->index }}</td>
                                                        <td>
                                                            @if ($product->image)
                                                                <img src="{{ asset('products/' . $product->image) }}"
                                                                    width="70">
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{ $product->name }}
                                                        </td>
                                                        <td>
                                                            {{ $product->category->name }}
                                                        </td>
                                                        <td>
                                                            {{ $product->sku }}
                                                        </td>
                                                        <td>
                                                            ৳ {{ $product->price }}
                                                        </td>
                                                        <td>
                                                            @if ($product->stock_quantity < 5)
                                                                <span class="badge bg-danger">
                                                                    {{ $product->stock_quantity }}
                                                                </span>
                                                            @else
                                                                <span class="badge bg-success">
                                                                    {{ $product->stock_quantity }}
                                                                </span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($product->status == 'active')
                                                                <span class="badge bg-success">
                                                                    Active
                                                                </span>
                                                            @else
                                                                <span class="badge bg-danger">
                                                                    Inactive
                                                                </span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('products.show', $product->id) }}"
                                                                class="btn btn-info btn-sm">
                                                                View
                                                            </a>
                                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                                data-bs-target="#editProduct{{ $product->id }}">
                                                                Edit
                                                            </button>
                                                            <a href="javascript:void(0);"
                                                                class="btn btn-danger btn-sm delete-btn"
                                                                data-url="{{ route('products.destroy', $product->id) }}">Delete</a>
                                                        </td>
                                                    </tr>
                                                    <div class="modal fade" id="editProduct{{ $product->id }}"
                                                        tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <form action="{{ route('products.update', $product->id) }}"
                                                                    method="POST" enctype="multipart/form-data"> @csrf
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Edit Product</h5> <button
                                                                            type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-md-6 mb-3"> <label>Product
                                                                                    Name</label> <input type="text"
                                                                                    name="name" class="form-control"
                                                                                    value="{{ $product->name }}"
                                                                                    placeholder="Name"> @error('name')
                                                                                    <span
                                                                                        class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                            <div class="col-md-6 mb-3">
                                                                                <label>Category</label> <select
                                                                                    name="category_id" class="form-control">
                                                                                    <option value="">Select Category
                                                                                    </option>
                                                                                    @foreach ($categories as $category)
                                                                                        <option value="{{ $category->id }}"
                                                                                            {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                                                            {{ $category->name }} </option>
                                                                                    @endforeach
                                                                                </select> @error('category_id')
                                                                                    <span
                                                                                        class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                            <div class="col-md-6 mb-3"> <label>SKU(Stock
                                                                                    Keeping Unit)</label> <input
                                                                                    type="text" name="sku"
                                                                                    class="form-control"
                                                                                    value="{{ $product->sku }}"
                                                                                    placeholder="Stock Keeping Unit">
                                                                                @error('sku')
                                                                                    <span
                                                                                        class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                            <div class="col-md-6 mb-3">
                                                                                <label>Price</label> <input type="number"
                                                                                    step="0.01" name="price"
                                                                                    class="form-control"
                                                                                    value="{{ $product->price }}">
                                                                                @error('price')
                                                                                    <span
                                                                                        class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                            <div class="col-md-6 mb-3"> <label>Stock
                                                                                    Quantity</label> <input type="number"
                                                                                    name="stock_quantity"
                                                                                    class="form-control"
                                                                                    value="{{ $product->stock_quantity }}">
                                                                                @error('stock_quantity')
                                                                                    <span
                                                                                        class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                            <div class="col-md-6 mb-3"> <label>Product
                                                                                    Image</label> <input type="file"
                                                                                    name="image" class="form-control">
                                                                                @error('image')
                                                                                    <span
                                                                                        class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                            <div class="col-md-6 mb-3">
                                                                                <label>Status</label> <select name="status"
                                                                                    class="form-control">
                                                                                    <option value="">Select Status
                                                                                    </option>
                                                                                    <option value="active"
                                                                                        {{ $product->status == 'active' ? 'selected' : '' }}>
                                                                                        Active </option>
                                                                                    <option value="inactive"
                                                                                        {{ $product->status == 'inactive' ? 'selected' : '' }}>
                                                                                        Inactive </option>
                                                                                </select> @error('status')
                                                                                    <span
                                                                                        class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                            <!-- Current Image -->
                                                                            <div class="col-md-6 mb-3">
                                                                                <label>Current Image</label>
                                                                                <div class="mt-2">
                                                                                    @if ($product->image)
                                                                                        <img src="{{ asset('products/' . $product->image) }}"
                                                                                            width="120" height="120"
                                                                                            class="rounded border"
                                                                                            style="object-fit: cover;">
                                                                                    @else
                                                                                        <div class="border rounded d-flex align-items-center justify-content-center"
                                                                                            style="width:120px;height:120px;">
                                                                                            No Image
                                                                                        </div>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer"> <button type="button"
                                                                            class="btn btn-secondary"
                                                                            data-bs-dismiss="modal"> Close </button>
                                                                        <button type="submit" class="btn btn-primary">
                                                                            Update Product </button>
                                                                    </div>
                                                                </form>
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
                                    {{ $products->links() }}
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
        document.getElementById('searchInput')
            .addEventListener('keyup', function() {
                if (this.value === '') {
                    window.location.href = "{{ route('products.index') }}";
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
    <script>
        function previewImage(event) {
            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    let preview = document.getElementById('imagePreview');
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                    document.getElementById('placeholder').style.display = 'none';
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
@endpush
