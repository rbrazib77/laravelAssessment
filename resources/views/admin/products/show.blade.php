@extends('admin.layouts.bashboard_master')
@section('title', 'Product Details')
@section('admin')
    <div class="content">
        <!-- Start Content-->
        <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h3 class="mb-0">
                                        Product Details
                                    </h3>
                                    <a href="{{ route('products.index') }}" class="btn btn-secondary btn-sm">
                                        ← Back
                                    </a>
                                </div>
                                <img src="{{ asset('products/' . $product->image) }}" width="150" class="mb-3">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Name</th>
                                        <td>{{ $product->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Category</th>
                                        <td>{{ $product->category->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>SKU</th>
                                        <td>{{ $product->sku }}</td>
                                    </tr>
                                    <tr>
                                        <th>Price</th>
                                        <td>৳ {{ $product->price }}</td>
                                    </tr>
                                    <tr>
                                        <th>Stock</th>
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
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            @if ($product->status == 'active')
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Date</th>
                                        <td>{{ $product->created_at }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- container-fluid -->
    </div>
@endsection
