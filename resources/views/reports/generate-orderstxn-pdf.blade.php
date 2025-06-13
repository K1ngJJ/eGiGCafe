<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        body {
            background-color: white;
            color: #343a40; /* Dark Gray */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .peso {
            font-family: DejaVu Sans, sans-serif;
        }

        .container {
            padding: 20px;
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff; /* White */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        h1 {
            color: #dc3545; /* Red */
            text-align: center;
            margin-bottom: 20px;
        }

        p {
            color: #6c757d; /* Gray */
            text-align: center;
            margin-bottom: 0px;
        }

        table {
            color: #343a40; /* Dark Gray */
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border-bottom: 1px solid #dee2e6; /* Light Gray */
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f8f9fa; /* Light Gray */
        }

        tbody tr:nth-child(even) {
            background-color: #f8f9fa; /* Light Gray */
        }

        tbody tr:hover {
            background-color: #f4f4f4; /* Lighter Gray */
        }

        .final-amount {
            color: red;
            background-color: #FFF9E6;
            font-weight: ;
            border: yellow;
            text-align: center;
        }

        .discount {
            color: white;
            background-color: red;
            border: gray;
            font-weight: bold;
            text-align: center;
        }

        .final-amount-bg {
            color: black;
            background-color: #FFF9E6;
            border: yellow;
            text-align: right;
        }

        .amount {
            color: white;
            background-color: black;
            border: gray;
            font-weight: bold;
            text-align: center;
        }

        .warning {
            background-color: orange; 
            color: white;
            border: gray;
            font-weight: bold;
            text-align: center; 
        }

        /* Signature Section Styling */
        .signature {
            text-align: left;
            margin-top: 10px;  /* Reduced margin at top */
            margin-bottom: 10px;  /* Reduced margin at bottom */
        }

        .signature-line {
            width: 25%;
            border-top: 1px solid black;
            margin: 0 auto;
            margin-bottom: 2px;  /* Reduced space below the line */
        }

        .signature p {
            font-size: 11px;
            font-weight: bold;
            margin-bottom: 1px; 
            margin-top: 2px;
        }

    </style>
</head>
<body>

<div class="container">
    <div style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
        <img src="https://egigcafe.com/images/Black Logo.png" style="width: 50px; height: 50px; margin: 0;">
    </div>
    <h1 style="margin: 0; font-size: 24px;">{{ $title }}</h1>
    <p>{{ $date }}</p>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="warning">Order ID</th>
                <th class="discount">Discount ID</th>
                <th class="amount">Final Amount</th>
                <th>Date</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalFinalAmount = 0;
            @endphp
            @foreach($orderstxn as $ordertxn)
            <tr>
                <td>{{ $ordertxn->order_id }}</td>
                <td>{{ $ordertxn->discount_id == 'No Discount' ? 'No Discount' : $ordertxn->discount_id }}</td>
                <td>{{ $ordertxn->order->getTotalFromScratch() }}</td>
                <td>{{ \Carbon\Carbon::parse($ordertxn->order->dateTime)->format('F j, Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($ordertxn->order->dateTime)->format('h:i A') }}</td>
            </tr>
            @php
                $totalFinalAmount += $ordertxn->order->getTotalFromScratch();
            @endphp
            @endforeach
            <tr>
                <td class="final-amount-bg"></td>
                <td class="final-amount-bg">Total:</td>
                <th class="final-amount peso">&#8369; {{ number_format($totalFinalAmount, 2) }} </th>
                <td class="final-amount-bg"></td>
                <td class="final-amount-bg"></td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Signature Section -->
<div class="signature">
    <div class="signature-line"></div>
    <p>MARIA LOURDES C. AQUINO</p>
    <p>GigCafe Owner</p>
</div>

</body>
</html>
