<!DOCTYPE html>
<html>

<head>
    <title>End of Day Report</title>
    <style>
        /* Add any custom styles for the PDF here */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h1>End of Day Report for {{ $date }}</h1>
    <h2>Total Sales: ₱{{ number_format($totalSales, 2) }}</h2>

    <h3>Product Sales:</h3>
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity Sold</th>
                <th>Total Sales</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productSales as $productId => $sales)
                <tr>
                    <td>{{ $sales['name'] }}</td>
                    <td>{{ $sales['quantity'] }}</td>
                    <td>₱{{ number_format($sales['total'], 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
