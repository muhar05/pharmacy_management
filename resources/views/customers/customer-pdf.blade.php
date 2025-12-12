<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Customers Report</title>
    <style>
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #0ea5e9;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .title {
            font-size: 28px;
            font-weight: bold;
            color: #0ea5e9;
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
            color: #0ea5e9;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: #fff;
        }

        th {
            background-color: #0ea5e9;
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
        <div class="logo-text">👥 PHARMACY</div>
        <div class="title">CUSTOMERS REPORT</div>
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
                <th>Phone</th>
                <th>Address</th>
                <th class="text-center">Created At</th>
                <th class="text-center">Updated At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
                <tr>
                    <td class="text-center">{{ $customer['Customer ID'] }}</td>
                    <td>{{ $customer['Customer Name'] }}</td>
                    <td>{{ $customer['Phone'] }}</td>
                    <td>{{ $customer['Address'] }}</td>
                    <td class="text-center">{{ $customer['Created At'] ?? '-' }}</td>
                    <td class="text-center">{{ $customer['Updated At'] ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <div>Generated on: {{ now()->format('d F Y, H:i') }} WIB</div>
        <div>Total Records: {{ count($customers) }}</div>
    </div>
</body>

</html>
