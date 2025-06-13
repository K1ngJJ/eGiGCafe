<!DOCTYPE html>
<html>
<head>
    <title>Order Receipt</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 0;
        }
        .receipt {
            width: 100%;
            max-width: 250px; /* Compact receipt width */
            margin: 0 auto;
            padding: 10px;
            border: 1px solid #ddd;
            font-size: 12px;
            background-color: #fff;
            box-sizing: border-box;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
        }
        .header img {
            width: 80px; /* Adjust logo size */
            height: auto;
            margin-bottom: 10px;
        }
        .header p {
            margin: 0;
            font-size: 12px;
            font-weight: bold;
        }
        .order-details {
            margin-bottom: 15px;
        }
        .order-details th, .order-details td {
            padding: 4px;
            font-size: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        .order-details th {
            font-weight: bold;
            background-color: #f2f2f2;
        }
        .total {
            color: white;
            background-color: #e74c3c;
            font-weight: bold;
            text-align: center;
            padding: 5px;
        }
        .footer {
            text-align: center;
            font-size: 10px;
            margin-top: 20px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="header">
            <!-- Logo -->
            <img src="https://egigcafe.com/images/Black Logo.png" alt="GiGCafe Logo">
            <!--p>{{ $title }}</p-->
            <p>Date: {{ $date }}</p>
        </div>

        <div class="order-details">
            <table width="100%">
                <tr>
                    <td colspan="2" style="text-align: center; font-weight: bold;">Order Details</td>
                </tr>
                <tr>
                    <th>Order ID</th>
                    <td><strong>{{ $transactions->order_id }}</strong></td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>{{ \Carbon\Carbon::parse($transactions->order->dateTime)->format('F j, Y') }}</td>
                </tr>
                <tr>
                    <th>Time</th>
                    <td>{{ \Carbon\Carbon::parse($transactions->order->dateTime)->format('h:i A') }}</td>
                </tr>
                <tr>
                    <th>Customer</th>
                    <td>{{ $transactions->order->user->name }}</td>
                </tr>
            </table>

            <table width="100%">
                <tr>
                    <th>Item</th>
                    <th>Price</th>
                </tr>
                @foreach($transactions->order->cartItems as $item)
                    <tr>
                        <td>{{ $item->menu->name }}</td> <!-- Displaying item name -->
                        <td>&#8369; {{ number_format($item->menu->price, 2) }}</td> <!-- Displaying item price -->
                    </tr>
                @endforeach
                <tr>
                    <td style="font-weight: bold;">Total</td>
                    <td class="total">&#8369; {{ number_format($transactions->order->getTotalFromScratch(), 2) }}</td>
                </tr>
            </table>
        </div>

        <div class="footer">
            Thank you for ordering with us! <br>
            We hope you enjoy your meal.
        </div>
    </div>
</body>
</html>
