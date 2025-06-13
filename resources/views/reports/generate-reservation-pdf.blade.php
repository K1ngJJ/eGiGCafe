<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
       body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            display: flex;
            justify-content: center; /* Centers horizontally */
            align-items: center; /* Centers vertically */
            height: 100vh; /* Full viewport height */
            font-size: 12px;
        }

        .receipt-container {
            width: 320px;
            padding: 20px;
            background: #f4f4f4;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }


        .receipt-header {
            text-align: center;
            margin-bottom: 15px;
        }

        .receipt-header h1 {
            font-size: 18px;
            margin: 0;
            font-weight: bold;
        }

        .receipt-header p {
            margin: 5px 0;
            font-size: 12px;
            color: #777;
        }

        .section-title {
            font-size: 14px;
            margin-top: 10px;
            font-weight: bold;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
            color: #333;
        }

        table {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
        }

        th, td {
            text-align: left;
            padding: 8px;
            font-size: 12px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f9f9f9;
            font-weight: bold;
        }

        .total-price {
            font-weight: bold;
            font-size: 14px;
            color: #d9534f;
        }

        .payment-logo img {
            height: 20px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 10px;
            color: #777;
        }

        .highlight {
            font-weight: bold;
            color: #d9534f;
        }
    </style>
</head>
<body>
    <div class="receipt-container">
        <div class="receipt-header">
        <img src="https://egigcafe.com/images/Black Logo.png" alt="GiGCafe Logo" style="width: 50px; height: 50px;">
            <!--h1>{{ $title }}</h1-->
            <p>{{ $date }}</p>
        </div>

        <div class="section-title">Customer Information</div>
        <table>
            <tr>
                <th>Reservation ID</th>
                <td>{{ $reservation->id }}</td>
            </tr>
            <tr>
                <th>Customer</th>
                <td>{{ $reservation->first_name }} {{ $reservation->last_name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $reservation->email }}</td>
            </tr>
            <tr>
                <th>Mobile Number</th>
                <td>{{ $reservation->tel_number }}</td>
            </tr>
        </table>

        <div class="section-title">Reservation Details</div>
        <table>
            <tr>
                <th>Reservation Date & Time</th>
                <td>{{ \Carbon\Carbon::parse($reservation->res_date)->format('F j, Y h:i A') }}</td>
            </tr>
            <tr>
                <th>Event</th>
                <td>{{ $reservation->service ? $reservation->service->name : 'No event associated' }}</td>
            </tr>
            <tr>
                <th>Venue</th>
                <td>{{ $reservation->venue_address ? $reservation->venue_address : 'No venue address' }}</td>
            </tr>
            <tr>
                <th>Service Type</th>
                <td>{{ $reservation->cateringoption ? $reservation->cateringoption->name : 'No service associated' }}</td>
            </tr>
        </table>

        @if($reservation->supply_details && $reservation->supply_details != '[]')
        <div class="section-title">Equipment Rental</div>
        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                @php $supplyDetails = json_decode($reservation->supply_details, true); @endphp
                @foreach($supplyDetails as $supply)
                <tr>
                    <td>{{ $supply['name'] }}</td>
                    <td>{{ $supply['quantity'] }}</td>
                    <td>₱ {{ number_format($supply['total_price'], 2) }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="2" class="highlight">Grand Total</td>
                    <td class="highlight">₱ {{ number_format($reservation->supply_total, 2) }}</td>
                </tr>
            </tbody>
        </table>
        @endif

        <div class="section-title">Payment Details</div>
        <table>
            <tr>
                <th>Payment Mode</th>
                <td>{{ $reservation->payment_status }}</td>
            </tr>
            <tr>
                <th>Pay With</th>
                <td class="payment-logo">
                    @if ($reservation->payment_selection === 'GCash')
                    <img src="https://egigcafe.com/images/gcash.png" alt="GCash">
                    @elseif ($reservation->payment_selection === 'Paypal')
                    <img src="https://egigcafe.com/images/paypal.png" alt="PayPal">
                    @else
                    <span class="highlight">N/A</span>
                    @endif
                </td>
            </tr>
        </table>

        <div class="footer">
            Thank you for your reservation! <br>
            We look forward to serving you.
        </div>
    </div>
</body>
</html>
