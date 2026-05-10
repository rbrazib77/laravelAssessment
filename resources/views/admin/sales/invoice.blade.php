@extends('admin.layouts.bashboard_master')
@section('title', 'Invoice')
@section('admin')
    <style>
        .invoice-box {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            margin-top: 50px;
        }
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .invoice-title {
            font-size: 24px;
            font-weight: 600;
        }
        .table th {
            background: #f8f9fa;
        }
        .text-right {
            text-align: right;
        }
        /* Print Style */
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                background: #fff;
            }
            .invoice-box {
                box-shadow: none;
                border: none;
            }
        }
        /* Mobile Responsive */
        @media (max-width: 768px) {
            .invoice-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }
    </style>

    <div class="content">
        <div class="container-xxl">
            <div class="invoice-box shadow">
                <!-- Header -->
                <div class="invoice-header">
                    <div>
                        <div class="invoice-title">
                            Invoice #{{ $sale->invoice_id ?? $sale->id }}
                        </div>
                        <small class="text-muted">
                            Date: {{ $sale->created_at->format('d M Y, h:i A') }}
                        </small>
                    </div>
                    <div class="no-print">
                        <a href="{{ route('sales.index') }}" class="btn btn-secondary btn-sm">
                            ← Back
                        </a>
                        <button onclick="window.print()" class="btn btn-primary btn-sm">
                            Print Invoice
                        </button>
                        <a href="{{ route('invoice.download', $sale->id) }}" class="btn btn-success btn-sm no-print">
                            Export Invoice PDF
                        </a>
                    </div>
                </div>
                <hr>
                <!-- Customer Info -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="mb-2">Customer Information</h6>
                        <p class="mb-1">
                            <strong>Name:</strong> {{ $sale->customer->name ?? 'N/A' }}
                        </p>
                        <p class="mb-1">
                            <strong>Phone:</strong> {{ $sale->customer->phone ?? 'N/A' }}
                        </p>
                        <p class="mb-1">
                            <strong>Email:</strong> {{ $sale->customer->email ?? 'N/A' }}
                        </p>
                        <p class="mb-1">
                            <strong>Address:</strong> {{ $sale->customer->address ?? 'N/A' }}
                        </p>
                    </div>
                </div>

                <!-- Product Table -->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th class="text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sale->saleItems as $item)
                                <tr>
                                    <td>{{ $item->product->name }}</td>
                                    <td>৳ {{ number_format($item->price, 2) }}</td>
                                    <td>
                                        <span class="badge bg-primary">
                                            {{ $item->quantity }}
                                        </span>
                                    </td>
                                    <td class="text-right">৳ {{ number_format($item->subtotal, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Summary -->
                <div class="row justify-content-end">
                    <div class="col-md-4">
                        <table class="table table-bordered">
                            <tr>
                                <th>Total</th>
                                <td class="text-right">৳ {{ number_format($sale->total, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Discount</th>
                                <td class="text-right">৳ {{ number_format($sale->discount, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Grand Total</th>
                                <td class="text-right">
                                    <strong class="text-success">
                                        ৳ {{ number_format($sale->grand_total, 2) }}
                                    </strong>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
