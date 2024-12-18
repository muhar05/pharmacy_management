<!DOCTYPE html>
<html>
<head>
    <title>Supplier Report</title>
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
        td {
            word-wrap: break-word; /* Membungkus kata yang panjang */
            max-width: 150px; /* Menentukan lebar maksimal untuk kolom */
        }
    </style>
</head>
<body>
    <h1>Supplier Report</h1>
    <table>
        <thead>
            <tr>
                <th>Supplier ID</th>
                <th>Supplier Name</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suppliers as $supplier)
                <tr>
                    <td>{{ $supplier->id }}</td>
                    <td>{{ $supplier->name }}</td>
                    <td>{{ $supplier->phone }}</td>
                    <td>{{ $supplier->address }}</td>
                    <td>{{ $supplier->email }}</td>
                    <td>{{ $supplier->created_at }}</td>
                    <td>{{ $supplier->updated_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
