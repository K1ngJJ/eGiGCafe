<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Transactions - Fulfilled</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            color: #333;
            margin: 0;
        }

        .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 100%;
        }

        h1 {
            color: #dc3545;
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }

        p {
            color: #6c757d;
            font-size: 14px;
            margin-bottom: 20px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dee2e6;
            padding: 10px;
            text-align: center;
            font-size: 12px;
            white-space: nowrap;
        }

        th {
            background-color: #f8f9fa;
            font-weight: bold;
            font-size: 14px;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
        }

        .highlight {
            color: #fff;
            background-color: #dc3545;
            font-weight: bold;
        }

        .note {
            font-size: 12px;
            color: #6c757d;
            margin-top: 20px;
            text-align: right;
        }

         /* Signature Section Styling */
         .signature {
            text-align: left;
            margin-top: 10px; /* Reduced margin at top */
            margin-bottom: 10px; /* Reduced margin at bottom */
        }

        .signature-line {
            width: 15%;
            border-top: 1px solid black;
            margin: 0; /* Removed auto centering */
            margin-bottom: 0px; /* Reduced space below the line */
        }

        .signature p {
            font-size: 11px;
            font-weight: bold;
            text-align: left;
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
    <table>
        <thead>
            <tr>
                <th>Reservation ID</th>
                <th>Date</th>
                <th>Time</th>
                <th>Event</th>
                <th>Venue</th>
                <th>Service Type</th>
                <th>Payment Mode</th>
                <th>Pay With</th>
            </tr>
        </thead>
        <tbody>
            @php $totalFinalAmount = 0; @endphp
            @foreach($reservationstxn as $reservationtxn)
                @if($reservationtxn->status === 'Fulfilled')
                <tr>
                    <td>{{ $reservationtxn->id }}</td>
                    <td>{{ \Carbon\Carbon::parse($reservationtxn->res_date)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($reservationtxn->res_date)->format('h:i A') }}</td>
                    <td>{{ $reservationtxn->service ? $reservationtxn->service->name : 'N/A' }}</td>
                    <td>{{ $reservationtxn->venue_address ? $reservationtxn->venue_address : 'No venue address' }}</td>
                    <td>{{ $reservationtxn->cateringoption ? $reservationtxn->cateringoption->name : 'N/A' }}</td>
                    <td>{{ $reservationtxn->payment_status }}</td>
                    <td>
                        @if ($reservationtxn->payment_selection === 'GCash')
                        <img src="https://egigcafe.com/images/gcash.png" alt="GCash" style="height: 20px;">
                        @elseif ($reservationtxn->payment_selection === 'Paypal')
                        <img src="https://egigcafe.com/images/paypal.png" alt="PayPal" style="height: 20px;">
                        @else
                        <span class="highlight">N/A</span>
                        @endif
                    </td>
                </tr>
                @php $totalFinalAmount += $reservationtxn->final_amount; @endphp
                @endif
            @endforeach
        </tbody>
    </table>
    <p class="note">* Only fulfilled reservations are included in this report.</p>
</div>
<!-- Signature Section -->
<div class="signature">
    <div class="signature-line"></div>
    <p>MARIA LOURDES C. AQUINO</p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;GigCafe Owner</p>
</div>
</body>
</html>
