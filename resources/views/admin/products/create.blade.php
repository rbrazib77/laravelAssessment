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
                    <a href="{{ route('products.index') }}" class="btn btn-primary">
                        <i class="mdi mdi-plus-circle me-1"></i>Products Index
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add Products</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label>Product Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Name">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Category</label>
                                        <select name="category_id" class="form-control">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>SKU(Stock Keeping Unit)</label>
                                        <input type="text" name="sku" class="form-control"
                                            placeholder="Stock Keeping Unit">
                                        @error('sku')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Price</label>
                                        <input type="number" step="0.01" name="price" class="form-control">
                                        @error('price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Stock Quantity</label>
                                        <input type="number" name="stock_quantity" class="form-control">
                                        @error('stock_quantity')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Product Image</label>
                                        <input type="file" name="image" class="form-control"
                                            onchange="previewImage(event)">
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="">Select Status</option>
                                            <option value="active">
                                                Active
                                            </option>
                                            <option value="inactive">
                                                Inactive
                                            </option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mt-3 position-relative" style="width:120px; height:120px;">
                                        <!-- Default Placeholder -->
                                        <div id="placeholder"
                                            class="border rounded d-flex align-items-center justify-content-center position-absolute top-0 start-0 w-100 h-100 bg-light">
                                            No Image
                                        </div>
                                        <!-- Preview Image -->
                                        <img id="imagePreview" src=""
                                            class="rounded border position-absolute top-0 start-0 w-100 h-100 d-none"
                                            style="object-fit: cover;">
                                    </div>
                                </div>
                                <button class="btn btn-primary">Add Product</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- container-fluid -->
    </div>

@endsection