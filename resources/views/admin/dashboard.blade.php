@extends('admin.layouts.bashboard_master')
@section('title', 'Dashboard')
@section('admin')
    <div class="content">
        <!-- Start Content-->
        <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Dashboard</h4>
                </div>
            </div>
            <div class="row">
                {{-- Total Products --}}
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="mb-3">
                                Total Products
                            </h5>
                            <h2 class="text-primary">
                                {{ $totalProducts }}
                            </h2>
                        </div>
                    </div>
                </div>

                {{-- Total Customers --}}
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="mb-3">
                                Total Customers
                            </h5>
                            <h2 class="text-success">
                                {{ $totalCustomers }}
                            </h2>
                        </div>
                    </div>
                </div>

                {{-- Total Sales --}}
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="mb-3">
                                Total Sales
                            </h5>
                            <h2 class="text-warning">
                                {{ $totalSales }}
                            </h2>
                        </div>
                    </div>
                </div>

                {{-- Total Revenue --}}
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="mb-3">
                                Total Revenue
                            </h5>
                            <h2 class="text-info">
                                ৳ {{ number_format($totalRevenue, 2) }}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Low Stock --}}
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-3">
                                Low Stock Product List
                            </h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Product Name</th>
                                    <th>Stock</th>
                                </tr>
                                @forelse($lowStockProducts as $product)
                                    <tr>
                                        <td>
                                            {{ $product->name }}
                                        </td>
                                        <td>
                                            <span class="badge bg-danger">
                                                {{ $product->stock_quantity }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center">
                                            No Low Stock Product
                                        </td>
                                    </tr>
                                @endforelse
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div>
@endsection
