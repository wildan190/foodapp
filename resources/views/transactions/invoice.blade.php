<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $transaction->invoice_number }}</title>
    <style>
        body { font-family: Arial, sans-serif; color: #333; }
        .invoice-box { max-width: 800px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .header img { max-width: 120px; }
        .title { font-size: 22px; font-weight: bold; text-align: center; }
        .info-table, .items-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .info-table td, .items-table th, .items-table td { padding: 10px; border: 1px solid #ddd; }
        .items-table th { background: #f4f4f4; text-align: left; }
        .total-section { text-align: right; font-size: 16px; margin-top: 10px; }
        .total-section .highlight { font-size: 18px; font-weight: bold; color: #d9534f; }
        .footer { margin-top: 20px; text-align: center; font-size: 12px; color: #777; }
    </style>
</head>
<body>
    <div class="invoice-box">
        <!-- Header -->
        <div class="header">
            <img src="{{ public_path('assets/logo.png') }}" alt="Company Logo">  
            <div>
                <p style="margin: 0; font-size: 14px;"><strong>Food POS</strong></p>
                <p style="margin: 0; font-size: 12px;">Jl. Kuliner No. 45, Jakarta</p>
                <p style="margin: 0; font-size: 12px;">Email: info@foodpos.com | Phone: 0812-3456-7890</p>
            </div>
        </div>

        <!-- Title -->
        <p class="title">Invoice</p>

        <!-- Informasi Transaksi -->
        <table class="info-table">
            <tr>
                <td><strong>Invoice Number:</strong> {{ $transaction->invoice_number }}</td>
                <td><strong>Transaction Date:</strong> {{ $transaction->transaction_date }}</td>
            </tr>
            <tr>
                <td><strong>Customer Name:</strong> {{ $transaction->sales->customer->name }}</td>
                <td><strong>Sales ID:</strong> {{ $transaction->sales_id }}</td>
            </tr>
        </table>

        <!-- Tabel Item -->
        <h3 style="margin-top: 20px;">Order Details:</h3>
        <table class="items-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Menu</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach($transaction->sales->salesDetails as $detail)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $detail->menu->menu_name }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>Rp. {{ number_format($detail->price, 2, ',', '.') }}</td>
                    <td>Rp. {{ number_format($detail->price * $detail->quantity, 2, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Total Section -->
        <div class="total-section">
            <p><strong>Order Fee:</strong> Rp{{ number_format($transaction->sales->order_fee, 2, ',', '.') }}</p>
            <p class="highlight"><strong>Total:</strong> Rp{{ number_format($transaction->sales->total_price + $transaction->sales->order_fee, 2, ',', '.') }}</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Terima kasih atas pembelian Anda! Jika ada pertanyaan, hubungi kami di info@foodpos.com</p>
            <p><strong>Food POS</strong> - Jl. Kuliner No. 45, Jakarta</p>
        </div>
    </div>
</body>
</html>
