@extends('admin.layouts.bashboard_master')
@section('title', 'Customers Create')
@section('admin')
    <div class="content">
        <!-- Start Content-->
        <div class="container-xxl">
             <div class="py-3 d-flex align-items-sm-center justify-content-between flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Customers</h4>
                </div>

                <div class="mt-2 mt-sm-0">
                    <a href="{{ route('customers.index') }}" class="btn btn-primary">
                        <i class="mdi mdi-plus-circle me-1"></i>Customers Index
                    </a>
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
        </div>
        <!-- container-fluid -->
    </div>
@endsection
