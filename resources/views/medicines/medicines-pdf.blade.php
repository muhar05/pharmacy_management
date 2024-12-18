<!DOCTYPE html>
<html>
<head>
    <title>Medicine List</title>
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
    </style>
</head>
<body>
    <h1>Medicine List</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category ID</th>
                <th>Stock</th>
                <th>Price</th>
                <th>Expiry Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($medicines as $medicine)
            <tr>
                <td>{{ $medicine->id }}</td>
                <td>{{ $medicine->name }}</td>
                <td>{{ $medicine->category_id }}</td>
                <td>{{ $medicine->stock }}</td>
                <td>{{ $medicine->price }}</td>
                <td>{{ $medicine->expiry_date }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
