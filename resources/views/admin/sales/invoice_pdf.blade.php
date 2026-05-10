<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial;
            font-size: 14px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .title {
            font-size: 22px;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="title">INVOICE</div>
        <p>Invoice #: {{ $sale->invoice_id }}</p>
    </div>

    <h4>Customer Info</h4>
    <div style="margin-bottom: 15px;">
        <div style="margin-bottom: 6px;">
            <strong>Name:</strong> {{ $sale->customer->name ?? 'N/A' }}
        </div>
        <div style="margin-bottom: 6px;">
            <strong>Phone:</strong> {{ $sale->customer->phone ?? 'N/A' }}
        </div>
        <div style="margin-bottom: 6px;">
            <strong>Email:</strong> {{ $sale->customer->email ?? 'N/A' }}
        </div>
    </div>
    <table>
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
                    <td>TK {{ $item->price }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td class="text-right">TK {{ $item->subtotal }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <table>
        <tr>
            <th>Total</th>
            <td class="text-right">TK {{ $sale->total }}</td>
        </tr>
        <tr>
            <th>Discount</th>
            <td class="text-right">TK {{ $sale->discount }}</td>
        </tr>
        <tr>
            <th>Grand Total</th>
            <td class="text-right"><b>TK {{ $sale->grand_total }}</b></td>
        </tr>
    </table>
    <br><br>
    <p style="text-align:center;">Thank you for your business</p>
</body>

</html>
