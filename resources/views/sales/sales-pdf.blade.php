<!DOCTYPE html>
<html>
<head>
    <title>Sales Report</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Sales Report</h1>
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
                <td>{{ $sale['Total Amount'] }}</td>
                <td>{{ $sale['Payment Status'] }}</td>
                <td>{{ $sale['Created At'] }}</td>
                <td>{{ $sale['Updated At'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
