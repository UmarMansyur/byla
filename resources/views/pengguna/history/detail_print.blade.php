<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faktur Pembayaran</title>
    <style>
        @page { 
            margin: 0; 
            size: 80mm 297mm; /* A4 height */
        }
        body {
            font-family: 'Tahoma', sans-serif;
            font-size: 8pt;
            margin: 0;
            padding: 5mm;
            width: 70mm;
            box-sizing: border-box;
        }
        .header {
            text-align: center;
            margin-bottom: 5mm;
        }
        .header-title {
            font-size: 10pt;
            font-weight: bold;
        }
        .header-address {
            font-size: 8pt;
        }
        .transaction-info {
            font-size: 8pt;
            margin-bottom: 5mm;
        }
        .table-container {
            width: 100%;
            margin-bottom: 0.625rem;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.75rem;
        }
        th {
            border-bottom: 1px solid black;
            padding: 0.3125rem 0;
            text-align: center;
        }
        td {
            padding: 0.3125rem 0;
        }
        .text-right {
            text-align: right;
            padding-right: 0.625rem;
        }
        .total-section td {
            font-size: 1rem;
            padding: 0.1875rem 0;
        }
        .border-top {
            border-top: 1px solid black;
        }
        .footer {
            text-align: center;
            margin-top: 1.25rem;
            font-size: 0.75rem;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-title">
          {{ $merchant->name }}
        </div>
        <div class="header-address">{{ $merchant->address }}</div>
    </div>

    <div class="transaction-info">
        No. : {{ $transaction->kode_transaksi }}, {{ $transaction->created_at->format('d F Y') }} (user:{{ $transaction->user->user_code }}), {{ $transaction->created_at->format('H:i:s') }}
    </div>

    <div class="table-container">
        <table>
            <tr>
                <th width="40%">Item</th>
                <th width="20%">Harga</th>
                <th width="10%">Jumlah</th>
                <th width="20%">Total</th>
            </tr>
            @foreach ($transaction_detail as $detail)
            <tr>
                <td>{{ $detail->product->title }}</td>
                <td class="text-right">{{ number_format($detail->product->sale_price, 0, ',', '.') }}</td>
                <td class="text-right">{{ $detail->quantity }}</td>
                <td class="text-right">{{ number_format($detail->product->sale_price * $detail->quantity, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </table>
    </div>

    <table class="total-section">
        <tr>
            <td align="right">Total :</td>
            <td class="text-right">{{ number_format($transaction->nominal, 0, ',', '.') }}</td>
        </tr>
    </table>

    <div class="footer">
        ****** TERIMAKASIH ******
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>
