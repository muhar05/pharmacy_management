<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sales Report</title>
    <style>
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #4f46e5;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .logo {
            width: 60px;
            height: 60px;
            margin-bottom: 10px;
        }

        .title {
            font-size: 28px;
            font-weight: bold;
            color: #4f46e5;
            margin: 10px 0;
        }

        .subtitle {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: #fff;
        }

        th {
            background-color: #4f46e5;
            color: white;
            padding: 12px 8px;
            text-align: left;
            font-weight: bold;
            font-size: 12px;
        }

        td {
            padding: 10px 8px;
            border-bottom: 1px solid #ddd;
            font-size: 11px;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .amount {
            font-weight: bold;
            color: #2563eb;
        }

        .status-paid {
            background-color: #10b981;
            color: white;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 10px;
        }

        .status-unpaid {
            background-color: #ef4444;
            color: white;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 10px;
        }

        .footer {
            margin-top: 40px;
            text-align: right;
            font-size: 11px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }

        .company-info {
            text-align: center;
            margin-bottom: 20px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="header">
        @php
            $logoPath = public_path('assets/logo/pharmacy_logo.png');
            $logoData = '';
            if (file_exists($logoPath)) {
                $logoData = 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath));
            }
        @endphp

        @if($logoData)
            <img src="{{ $logoData }}" class="logo" alt="Pharmacy Logo">
        @endif

        <div class="title">SALES REPORT</div>
        <div class="subtitle">Pharmacy Management System</div>
    </div>

    <div class="company-info">
        <strong>ABC Pharmacy</strong><br>
        Jl. Kesehatan No. 123, Jakarta 12345<br>
        Phone: (021) 123-4567 | Email: info@abcpharmacy.com
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center">Customer ID</th>
                <th>Customer Name</th>
                <th class="text-center">Sales Date</th>
                <th class="text-right">Total Amount</th>
                <th class="text-center">Payment Status</th>
                <th class="text-center">Created At</th>
                <th class="text-center">Updated At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $sale)
                <tr>
                    <td class="text-center">{{ $sale['Customer ID'] }}</td>
                    <td>{{ $sale['Customer Name'] }}</td>
                    <td class="text-center">{{ $sale['Sales Date'] }}</td>
                    <td class="text-right amount">Rp{{ number_format($sale['Total Amount'], 0, ',', '.') }}</td>
                    <td class="text-center">
                        <span class="{{ $sale['Payment Status'] == 'Paid' ? 'status-paid' : 'status-unpaid' }}">
                            {{ $sale['Payment Status'] }}
                        </span>
                    </td>
                    <td class="text-center">{{ $sale['Created At'] ?? '-' }}</td>
                    <td class="text-center">{{ $sale['Updated At'] ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <div>Generated on: {{ now()->format('d F Y, H:i') }} WIB</div>
        <div>Total Records: {{ count($sales) }}</div>
    </div>
</body>

</html>
