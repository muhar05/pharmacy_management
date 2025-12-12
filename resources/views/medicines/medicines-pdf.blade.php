<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Medicines Report</title>
    <style>
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #16a34a;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .title {
            font-size: 28px;
            font-weight: bold;
            color: #16a34a;
            margin: 10px 0;
        }

        .subtitle {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }

        .logo-text {
            font-size: 24px;
            font-weight: bold;
            color: #16a34a;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: #fff;
        }

        th {
            background-color: #16a34a;
            color: white;
            padding: 12px 8px;
            text-align: left;
            font-weight: bold;
            font-size: 11px;
        }

        td {
            padding: 10px 8px;
            border-bottom: 1px solid #ddd;
            font-size: 10px;
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

        .stock-low {
            background-color: #ef4444;
            color: white;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 9px;
        }

        .stock-normal {
            background-color: #10b981;
            color: white;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 9px;
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
        <div class="logo-text">💊 PHARMACY</div>
        <div class="title">MEDICINES REPORT</div>
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
                <th class="text-center">ID</th>
                <th>Medicine Name</th>
                <th>Category</th>
                <th>Supplier</th>
                <th class="text-center">Stock</th>
                <th class="text-center">Min Stock</th>
                <th class="text-right">Price</th>
                <th>Type</th>
                <th>Unit</th>
                <th>Dosage</th>
                <th class="text-center">Expiry Date</th>
                <th class="text-center">Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($medicines as $medicine)
                <tr>
                    <td class="text-center">{{ $medicine['Medicine ID'] }}</td>
                    <td>{{ $medicine['Medicine Name'] }}</td>
                    <td>{{ $medicine['Category'] }}</td>
                    <td>{{ $medicine['Supplier'] }}</td>
                    <td class="text-center">
                        @if($medicine['Stock'] <= $medicine['Minimum Stock'])
                            <span class="stock-low">{{ $medicine['Stock'] }}</span>
                        @else
                            <span class="stock-normal">{{ $medicine['Stock'] }}</span>
                        @endif
                    </td>
                    <td class="text-center">{{ $medicine['Minimum Stock'] }}</td>
                    <td class="text-right amount">Rp{{ number_format($medicine['Price'], 0, ',', '.') }}</td>
                    <td>{{ $medicine['Type'] }}</td>
                    <td>{{ $medicine['Unit'] }}</td>
                    <td>{{ $medicine['Dosage'] }}</td>
                    <td class="text-center">{{ $medicine['Expiry Date'] }}</td>
                    <td class="text-center">{{ $medicine['Created At'] ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <div>Generated on: {{ now()->format('d F Y, H:i') }} WIB</div>
        <div>Total Records: {{ count($medicines) }}</div>
    </div>
</body>

</html>
