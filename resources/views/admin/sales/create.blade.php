@extends('admin.layouts.bashboard_master')
@section('title', 'create sales invoices')
@section('admin')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <div class="content">
        <!-- Start Content-->
        <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Create Sales Invoices</h4>
                </div>
                <div>
                    <a href="{{ route('sales.index') }}" class="btn btn-primary">
                        All Invoices
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('sales.store') }}" method="POST">
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    @if (session('error'))
                                        <div class="alert alert-danger">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                    @csrf
                                    {{-- Customer --}}
                                    <div class="mb-3">
                                        <label>
                                            Select Customer
                                        </label>
                                        <select name="customer_id" class="form-control">
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">
                                                    {{ $customer->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- Product Table --}}
                                    <table class="table table-bordered" id="productTable">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th width="150">
                                                    Quantity
                                                </th>
                                                <th width="150">
                                                    Price
                                                </th>
                                                <th width="150">
                                                    Subtotal
                                                </th>
                                                <th width="100">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <select name="products[0][product_id]"
                                                        class="form-control product-select">
                                                        @foreach ($products as $product)
                                                            <option value="{{ $product->id }}"
                                                                data-price="{{ $product->price }}">

                                                                {{ $product->name }}

                                                            </option>
                                                        @endforeach

                                                    </select>

                                                </td>

                                                <td>

                                                    <input type="number" name="products[0][quantity]"
                                                        class="form-control quantity" value="1">

                                                </td>

                                                <td>

                                                    <input type="text" class="form-control price" readonly>

                                                </td>

                                                <td>

                                                    <input type="text" class="form-control subtotal" readonly>

                                                </td>

                                                <td>

                                                    <button type="button" class="btn btn-danger removeRow">

                                                        X

                                                    </button>

                                                </td>

                                            </tr>

                                        </tbody>

                                    </table>

                                    <button type="button" class="btn btn-primary mb-3" id="addRow">

                                        Add Product

                                    </button>

                                    {{-- Total --}}
                                    <div class="row">

                                        <div class="col-md-4">

                                            <label>Total</label>

                                            <input type="text" name="total" id="total" class="form-control"
                                                readonly>

                                        </div>

                                        <div class="col-md-4">

                                            <label>Discount</label>

                                            <input type="number" name="discount" id="discount" class="form-control"
                                                value="0">

                                        </div>

                                        <div class="col-md-4">

                                            <label>Grand Total</label>

                                            <input type="text" name="grand_total" id="grand_total" class="form-control"
                                                readonly>

                                        </div>

                                    </div>

                                    <button class="btn btn-primary mt-4">

                                        Create Invoice

                                    </button>

                                </form>
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
        let row = 1;
        function calculateTotal() {
            let total = 0;
            $('.subtotal').each(function() {
                total += parseFloat($(this).val()) || 0;
            });

            $('#total').val(total);

            let discount = parseFloat(
                $('#discount').val()
            ) || 0;

            $('#grand_total').val(
                total - discount
            );
        }

        function updateRow(rowElement) {
            let price = rowElement.find(
                '.product-select option:selected'
            ).data('price');

            let quantity = rowElement.find(
                '.quantity'
            ).val();

            rowElement.find('.price').val(price);

            rowElement.find('.subtotal').val(
                price * quantity
            );
            calculateTotal();
        }

        $(document).ready(function() {
            updateRow($('tbody tr'));
            $(document).on(
                'change',
                '.product-select, .quantity',
                function() {
                    let rowElement = $(this).closest('tr');
                    updateRow(rowElement);
                }
            );

            $('#discount').keyup(function() {

                calculateTotal();
            });

            $('#addRow').click(function() {
                let newRow = `<tr>
                                <td>
                                    <select name="products[${row}][product_id]"
                                            class="form-control product-select">
                                        @foreach ($products as $product)
                                        <option value="{{ $product->id }}"
                                                data-price="{{ $product->price }}">
                                            {{ $product->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number"
                                        name="products[${row}][quantity]"
                                        class="form-control quantity"
                                        value="1">
                                </td>
                                <td>
                                    <input type="text"
                                        class="form-control price"
                                        readonly>
                                </td>
                                <td>
                                    <input type="text"
                                        class="form-control subtotal"
                                        readonly>
                                </td>
                                <td>
                                    <button type="button"
                                            class="btn btn-danger removeRow">

                                        X
                                    </button>
                                </td>
                            </tr>`;

                 $('#productTable tbody').append(newRow);

                row++;
            });

            $(document).on(
                'click',
                '.removeRow',
                function() {

                    $(this).closest('tr').remove();

                    calculateTotal();
                }
            );
        });
    </script>
@endpush
