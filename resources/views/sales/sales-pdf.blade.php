<!DOCTYPE html>
<html>

<head>
    <title>Sales Report</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Figtree:wght@500;700&display=swap');

        body {
            font-family: 'Figtree', Arial, sans-serif;
            background: #f8fafc;
            color: #22223b;
            margin: 0;
            padding: 0;
        }

        .header {
            display: flex;
            align-items: center;
            gap: 16px;
            border-bottom: 2px solid #4f46e5;
            padding: 24px 0 16px 0;
            margin-bottom: 24px;
        }

        .logo {
            width: 48px;
            height: 48px;
        }

        .title {
            font-size: 2rem;
            font-weight: 700;
            color: #4f46e5;
            letter-spacing: 1px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(79, 70, 229, 0.07);
        }

        th,
        td {
            border: 1px solid #e5e7eb;
            text-align: left;
            padding: 10px 8px;
        }

        th {
            background-color: #6366f1;
            color: #fff;
            font-weight: 600;
            font-size: 1rem;
        }

        tr:nth-child(even) td {
            background-color: #f1f5f9;
        }

        tr:hover td {
            background-color: #e0e7ff;
        }

        .footer {
            margin-top: 32px;
            text-align: right;
            font-size: 0.95rem;
            color: #64748b;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ public_path('assets/logo/pharmacy_logo.png') }}" class="logo" alt="logo">
        <span class="title">Sales Report</span>
    </div>
    <table>
        <thead>
            <tr>
                <th>Customer ID</th>
                <th>Customer Name</th>
                <th>Sales Date</th>
                <th>Total Amount</th>
                <th>Payment Status</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $sale)
                <tr>
                    <td>{{ $sale['Customer ID'] }}</td>
                    <td>{{ $sale['Customer Name'] }}</td>
                    <td>{{ $sale['Sales Date'] }}</td>
                    <td>Rp{{ number_format((float) $sale['Total Amount'], 0, ',', '.') }}</td>
                    <td>{{ $sale['Payment Status'] }}</td>
                    <td>{{ $sale['Created At'] }}</td>
                    <td>{{ $sale['Updated At'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="footer">
        Dicetak pada: {{ now()->format('d M Y, H:i') }}
    </div>
</body>

</html>
