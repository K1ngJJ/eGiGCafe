@extends('layouts.backend')

@section('links')
    <script src="{{ asset('js/dashboard.js') }}" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
@endsection

@section('bodyID')
{{ 'Dashboard' }}@endsection

@section('navTheme')
{{ 'light' }}@endsection

@section('logoFileName')
{{ URL::asset('/images/Black Logo.png') }}@endsection


@section('content')

<style>

.horizontal-line {
    border-top: 1px solid #ccc; /* Adjust the color and thickness as needed */
    margin-top: 20px; /* Adjust the margin as needed */
    margin-bottom: 20px; /* Adjust the margin as needed */
}

.bold-divider {
    font-weight: bold; /* Make text bold */
    height: 2px; /* Increase height to make the line bolder */
    background-color: black; /* Ensure the line is visible */
    margin-top: 0.5rem;
    margin-bottom: 0.5rem;
}

#reservation-chart {
    max-width: 900px; /* Adjust the width as needed */
    margin: 0; /* Center the chart */
}

#dropdownMenuButton {
    font-size: 1.2em;
    padding: 5px 10px;
}

</style>

<!-- Styles for animations and hover effects -->
<style>
    .animated-card {
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 1s forwards ease-in-out;
    }

    .animated-card:hover {
        transform: scale(1.05) translateY(-5px);
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
    }

    @keyframes fadeInUp {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    #best-month:hover, #best-services:hover {
    transform: scale(1.05);
}

</style>

<!-- todo - session success stuff -->
<section class="container">
<div class="card-body">
<div class="container">
</div>

    <div class="row mt-5">
        <div class="col mt-lg-0 mt-5 justify-content-between">
        <!--@include('partials.notification', ['unreadNotifications' => auth()->user()->unreadNotifications])-->
            <h1 class="mt-lg-0 mt-3">Order Dashboard</h1>
        </div>
        <div class="col-lg-5 col-12 d-flex justify-content-center mt-lg-0 mt-5">
            <div class="col-11 flex-center py-2 shadow rounded bg-white">
            <div class="flex-center">
            <img src="{{ URL::asset('/images/calendar.svg') }}" style="height: 32px; width: 32px;">
            </div>
            <p class="flex-center mt-lg-0 px-3">From: {{ $startDate }}</p>
            <p class="flex-center mt-lg-0 px-3">To: {{ $today }} </p>
            </div>
        </div>
    </div>

    <!-- first row -->
    <div class="row my-5 justify-content-between">
    <div class="col-lg-4 col-12 mb-lg-0 mb-3 flex-center">
    <div id="generated-revenue" class="col-11 pt-3 h-100 shadow rounded bg-white animated-card"
            data-daily="{{ $dailyRevenue }}" data-total="{{ $totalRevenue }}">
    </div>
</div>
<div class="col-lg-4 col-12 mb-lg-0 mb-3 flex-center">
    <div id="estimated-cost" class="col-11 p-3 h-100 shadow rounded bg-white animated-card"> 
        <h5 class="text-center">Estimated Cost</h5>
        <h2 class="my-4 apexcharts-yaxis-title fw-bold text-center">₱ {{ number_format($totalCost, 2) }}</h2>
        <p class="small text-muted text-center">Total Cost of Orders</p>
    </div>
</div>
<div class="col-lg-4 col-12 mb-lg-0 mb-3 flex-center">
    <div id="gross-profit" class="col-11 p-3 h-100 shadow rounded bg-white animated-card"> 
        <h5 class="text-center">Gross Profit</h5>
        <h2 class="my-4 apexcharts-yaxis-title fw-bold text-center">₱ {{ number_format($grossProfit, 2) }}</h2>
        <p class="small text-muted text-center">Difference of Revenue and Cost</p>
    </div>
</div>

<!-- Second Row -->
<div class="row mt-5 justify-content-center">
    <div class="col-lg-4 col-12 mb-lg-0 mb-3 flex-center">
        <div id="orders" class="col-11 p-3 h-100 shadow rounded bg-white animated-card"> 
            <h5 class="text-center">Total Orders</h5>
            <h2 class="my-4 apexcharts-yaxis-title fw-bold text-center">{{ $totalOrders }}</h2>
            <p class="small text-muted text-center">Number of orders being placed by now</p>
        </div>
    </div>
    <div class="col-lg-4 col-12 mb-lg-0 mb-3 flex-center">
        <div id="code-usage" class="col-11 p-3 h-100 shadow rounded bg-white animated-card">     
            <h5 class="text-center">Discount Code Usage</h5>
            <h2 class="my-4 apexcharts-yaxis-title fw-bold text-center">{{ $discountCodeUsed }} times</h2>
            <p class="small text-muted text-center">Discount code usage analysis</p>
        </div>
    </div>
    <div class="col-lg-4 col-12 mb-lg-0 mb-3 flex-center">
        <div id="customers" class="col-11 p-3 h-100 shadow rounded bg-white animated-card">    
            <h5 class="text-center">Total Customers</h5>
            <h2 class="my-4 apexcharts-yaxis-title fw-bold text-center">{{ $numCustomer }}</h2>
            <p class="small text-muted text-center">Customer base of the system</p>
        </div>
    </div>
</div>

    </div>

    <!-- TODO - third row - charts -->
    <!-- <div class="row my-5 justify-content-between">
        <div class="col-lg-6 col-12 mb-lg-0 mb-3 flex-center">
            <div id="order-revenue-chart" class="col-11 pt-3 h-100 shadow rounded bg-white"
                data-daily="{{ $dailyOrders }}" data-total="{{ $totalOrders }}">
            </div>
        </div>
        <div class="col-lg-6 col-12 mb-lg-0 mb-3 flex-center">
            <div class="col-11 pt-3 h-100 shadow rounded bg-white">
                sales of each menu category
                <h5>Pie chart</h5>
            </div>
        </div>
    </div> -->

    <!-- Third row - Order-Revenue Mixed Chart -->
    <div class="row my-5 justify-content-between">
        <div id="order-revenue-chart" class="col-12 pt-3 h-100 shadow rounded bg-white"
            data-daily="{{ $dailyOrders }}" data-total="{{ $totalOrders }}">
        </div>
    </div>

    <!-- Forth row - Best Selling Menu Bar Chart -->
    <div class="row my-5 justify-content-between">
        <div id="best-selling-product-chart" class="col-12 pt-3 h-100 shadow rounded bg-white"
            data-sales="{{ $finalProductSales }}">
        </div>
    </div>

    <!-- Fifth row - Menu Category Pie Chart -->
    <div class="row my-5 justify-content-between">
        <div id="category-sales-chart" class="col-12 pt-3 h-100 shadow rounded bg-white"
            data-sales="{{ $categoricalSales }}">
        </div>
    </div>

    <!-- Best Menus Section -->
    <!--div class="row mt-5">
    <div class="col-12">
        <h2 class="text-center mb-4">Best Menus</h2>
    </div>

   
    @foreach($sortedSales as $product)
    <div class="col-lg-3 col-md-4 col-sm-6 mb-4 flex-center">
    <div class="col-11 p-3 shadow rounded bg-white">
        <img src="{{ asset('menuImages/' . $product->image) }}" alt="{{ $product->x }}" class="img-fluid mb-3" style="height: 200px; object-fit: cover;">
        <h5 class="text-center">{{ $product->x }}</h5>
        <p class="text-center">Sales Count: {{ $product->y }}</p>
    </div>
</div>
    @endforeach
</div-->
















    <div class="horizontal-line bold-divider"></div>

     <!--Reservation Analytics-->
    <div class="row mt-5">
        <div class="col mt-lg-0 mt-5">
            <h1 class="mt-lg-0 mt-3">Reservation Dashboard</h1>
        </div>
        <div class="col-lg-5 col-12 d-flex justify-content-center mt-lg-0 mt-5">
            <div class="col-11 flex-center py-2 shadow rounded bg-white">
            <div class="flex-center">
            <img src="{{ URL::asset('/images/calendar.svg') }}" style="height: 32px; width: 32px;">
            </div>
            <p class="flex-center mt-lg-0 px-3">From: {{ $rstartDate }}</p>
            <p class="flex-center mt-lg-0 px-3">To: {{ $rtoday }} </p>
            </div>
        </div>
    </div>

<!-- Best Reservation Month and Best Events/Services -->
<div class="row my-5 justify-content-between">
<!-- Best Reservation Month -->
<div class="col-lg-6 col-12 mb-3 position-relative">
    <div id="best-month" class="col-12 p-4 shadow-lg rounded bg-gradient-light position-relative overflow-hidden" 
         style="border: 2px solid #E0E0E0; background: linear-gradient(135deg, #f7f7f7, #fdeaea); transition: transform 0.3s ease;">
        <div class="icon-overlay" style="position: absolute; top: -20px; right: -20px; opacity: 0.1; z-index: 0;">
            <img src="{{ URL::asset('/images/calendar.svg') }}" style="height: 100px; width: 100px;">
        </div>
        <h5 class="text-center mb-3 position-relative" style="z-index: 1;">
            <img src="{{ URL::asset('/images/calendar.svg') }}" style="height: 28px; width: 28px; margin-right: 10px; vertical-align: middle;">
            <span style="color: #8B0000; font-weight: bold;">Best Reservation Month</span> <!-- Dark Red Color -->
        </h5>
        <div class="position-relative" style="background: rgba(255, 255, 255, 0.9); padding: 10px; border-radius: 10px; z-index: 1;">
            <h2 class="my-4 apexcharts-yaxis-title fw-bold text-center" style="color: #8B0000;"> <!-- Dark Red Text -->
                @if($reservationMonthData)
                    @php
                        // Map month numbers to names
                        $months = [
                            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 
                            5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 
                            9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
                        ];
                        $monthName = $months[$reservationMonthData['month']] ?? 'Unknown';
                    @endphp
                    {{ $monthName }}
                @else
                    <span style="color: #8B0000;">No Data Available</span> <!-- Dark Red for No Data -->
                @endif
            </h2>

            <!-- Small Calendar inside the card -->
            <div class="calendar-container" style="position: relative; height: 198px; overflow: hidden;">
                <!-- FullCalendar Placeholder -->
                <div id="calendar" style="width: 100%;"></div> 
            </div>

        </div>
        <p class="small text-muted text-center mt-2 position-relative" style="z-index: 1;">Month with the Most Reservations</p>
    </div>
</div>

<!-- FullCalendar JS and CSS -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.2.0/dist/fullcalendar.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.2.0/dist/fullcalendar.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize FullCalendar
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: [
                {
                    title: 'Best Month',
                    start: `2024-${String({{ $reservationMonthData['month'] ?? 'null' }}).padStart(2, '0')}-01`,
                    backgroundColor: '#8B0000', // Dark Red Color
                    borderColor: '#8B0000', // Dark Red Border
                }
            ],
            // Callback after rendering the calendar
            dayRender: function(date, cell) {
                // Get the best month from the dynamic data
                const bestMonth = {{ $reservationMonthData['month'] ?? 'null' }};
                if (bestMonth) {
                    const bestMonthDate = `2024-${String(bestMonth).padStart(2, '0')}-01`;
                    // Highlight the first day of the best month
                    if (date.format('YYYY-MM-DD') === bestMonthDate) {
                        cell.css({
                            'background-color': '#8B0000', // Dark Red for best month
                            'color': '#fff' // White text for contrast
                        });
                    }
                }
            }
        });
    });
</script>



<!-- Best Events or Services -->
<div class="col-lg-6 col-12 mb-3 position-relative">
    <div id="best-services" class="col-12 p-4 shadow-lg rounded bg-gradient-light position-relative overflow-hidden" 
         style="border: 2px solid #E0E0E0; background: linear-gradient(135deg, #ffe5d4, #ffd8b1); transition: transform 0.3s ease;">
        <div class="icon-overlay" style="position: absolute; bottom: -20px; left: -20px; opacity: 0.1; z-index: 0;">
            <img src="{{ asset('/images/services.svg') }}" style="height: 100px; width: 100px;">
        </div>
        <h5 class="text-center mb-3 position-relative" style="z-index: 1;">
            <img src="{{ asset('/images/services.svg') }}" style="height: 28px; width: 28px; margin-right: 10px; vertical-align: middle;">
            <span style="color: #FF4500; font-weight: bold;">Best Events</span> <!-- Dark Orange Color -->
        </h5>
        <div class="position-relative" style="background: rgba(255, 255, 255, 0.9); padding: 10px; border-radius: 10px; z-index: 1;">
            <h2 class="my-4 apexcharts-yaxis-title fw-bold text-center" style="color: #FF4500;"> <!-- Dark Orange Text -->
                @if($eventOrServiceData)
                    {{ $eventOrServiceData['name'] }}
                @else
                    <span style="color: #FF4500;">No Data Available</span> <!-- Dark Orange for No Data -->
                @endif
            </h2>

                    <!-- Collage of Gallery Images -->
            <div class="gallery-collage" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px;">
                <!-- Directly referencing images in the public/gallery folder -->
                <div class="gallery-item" style="position: relative;">
                    <img src="{{ asset('/galleryImages/1727052993-gigcafe img 1.jpg') }}" alt="Gallery Image" 
                        style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px;">
                </div>
                <div class="gallery-item" style="position: relative;">
                    <img src="{{ asset('/galleryImages/1727053071-358067062_709105824564439_6559889952019422459_n.jpg') }}" alt="Gallery Image" 
                        style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px;">
                </div>
                <div class="gallery-item" style="position: relative;">
                    <img src="{{ asset('/galleryImages/1727052904-357098911_704934234981598_6771800479847694702_n.jpg') }}" alt="Gallery Image" 
                        style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px;">
                </div>
            </div>

        </div>
        <p class="small text-muted text-center mt-2 position-relative" style="z-index: 1;">Event with the Most Reservations</p>
    </div>
</div>

<style>
    .gallery-collage {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 8px; /* Adjust spacing between images */
}

.gallery-item img {
    border-radius: 8px; /* Rounded corners for images */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Optional shadow for the images */
    transition: transform 0.3s ease;
}

.gallery-item img:hover {
    transform: scale(1.05); /* Zoom effect on hover */
}

</style>


<div class="row my-4 justify-content-between">
<!-- HTML content -->
<div class="col-lg-3 col-md-6 col-12 mb-lg-0 mb-3 flex-center">
    <div id="estimated-rcost" class="col-12 p-4 h-100 shadow rounded bg-white animated-card">
        <h5 class="text-center">Estimated Cost</h5>
        <h2 class="my-4 apexcharts-yaxis-title fw-bold text-center">₱ {{ number_format($totalAmount, 2) }}</h2>
        <p class="small text-muted text-center">Total Amount of Payments for Fulfilled Reservations</p>
    </div>
</div>
<div class="col-lg-3 col-md-6 col-12 mb-lg-0 mb-3 flex-center">
    <div id="total-reservation" class="col-12 p-4 h-100 shadow rounded bg-white animated-card">
        <h5 class="text-center">Total Reservations</h5>
        <h2 class="my-4 apexcharts-yaxis-title fw-bold text-center">{{ $totalReservations }}</h2>
        <p class="small text-muted text-center">Total Number of Fulfilled Reservations</p>
    </div>
</div>
<div class="col-lg-3 col-md-6 col-12 mb-lg-0 mb-3 flex-center">
    <div id="customers" class="col-12 p-4 h-100 shadow rounded bg-white animated-card">    
        <h5 class="text-center">Total Customers</h5>
        <h2 class="my-4 apexcharts-yaxis-title fw-bold text-center">{{ $resCustomer }}</h2>
        <p class="small text-muted text-center">Total Number of Customers Who Made Reservations</p>
    </div>
</div>
<div class="col-lg-3 col-md-6 col-12 mb-lg-0 mb-3 flex-center">
    <div id="pending-approved-reservation" class="col-12 p-3 h-100 shadow rounded bg-white animated-card">    
        <h5 class="xs text-center" style="font-size: 0.8em;">Pending / Approved / InProgress</h5>
        <h2 class="my-4 apexcharts-yaxis-title fw-bold text-center d-flex align-items-center justify-content-center">
            {{ $pendingReservations }}  &nbsp;&nbsp;&nbsp;
            <span class="divider mx-3"></span>  &nbsp;&nbsp;&nbsp;
            {{ $approvedReservations }}  &nbsp;&nbsp;&nbsp;
            <span class="divider mx-3"></span>  &nbsp;&nbsp;&nbsp;
            {{ $inProgressReservations }}
        </h2>
        <style>
            .divider {
                border-left: 2px solid black; /* Adjust thickness and color */
                height: 50px; /* Adjust the height of the vertical line */
                display: inline-block;
            }
        </style>
        <p class="small text-muted text-center">Pending, Approved and In Progress Reservations</p>
    </div>
</div>
</div>


<!-- Reservation Analytics -->
<div class="row my-4 justify-content-between">
    <div class="col-lg-6 col-12 mb-3">
        <div class="p-3 shadow rounded bg-white">
            <h5 class="text-center">Reservation Status Overview</h5>
            <canvas id="reservationChart" width="400" height="200"></canvas>
        </div>
    </div>

    <div class="col-lg-6 col-12 mb-3">
    @if(isset($reservationsByMonth) && isset($reservationsByWeek))
        <div id="reservation-analytics" class="h-100 shadow rounded bg-white position-relative"
             data-reservations-month="{{ json_encode($reservationsByMonth) }}"
             data-reservations-week="{{ json_encode($reservationsByWeek) }}">
            <h5 class="text-center pt-3">Reservation Analytics</h5>
            <canvas id="reservation-chart"></canvas>

            <!-- Hamburger menu for download options in top-right -->
            <div class="dropdown position-absolute top-0 end-0 mt-2 me-3">
            <button class="primary-btn dropdown-toggle" type="button" id="dropdownMenuButton" 
                    data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 12px; padding: 5px 10px;">
                ☰
            </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" id="download-png" href="#">Download as PNG</a></li>
                    <li><a class="dropdown-item" id="download-svg" href="#">Download as SVG</a></li>
                    <li><a class="dropdown-item" id="download-csv" href="#">Download as CSV</a></li>
                </ul>
            </div>
        </div>
    @endif
</div>
</div>




<div class="horizontal-line bold-divider"></div>

<script>
    // Best Reservation Month Radar Chart
    const reservationMonthData = @json($reservationMonthData); // Data passed from the controller

    const reservationMonthRadarData = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],  // You can use months if needed
        datasets: [{
            label: 'Reservations',
            data: reservationMonthData ? [reservationMonthData.count] : [0], // Using the count from data
            borderColor: '#3498db',
            backgroundColor: 'rgba(52, 152, 219, 0.2)',
            borderWidth: 2,
            fill: true
        }]
    };

    const reservationMonthRadarOptions = {
        responsive: true,
        maintainAspectRatio: true,
        scale: {
            ticks: {
                beginAtZero: true
            }
        }
    };

    new Chart(document.getElementById('reservationMonthRadarChart'), {
        type: 'radar',
        data: reservationMonthRadarData,
        options: reservationMonthRadarOptions
    });

    // Best Events / Services Pie Chart
    const eventOrServiceData = @json($eventOrServiceData); // Data passed from the controller

    const eventsPieChartData = {
        labels: eventOrServiceData ? [eventOrServiceData.name] : ['No Data'],
        datasets: [{
            label: 'Reservations',
            data: eventOrServiceData ? [eventOrServiceData.count] : [0], // Using the count from data
            backgroundColor: ['#e74c3c', '#f39c12', '#2ecc71'],
            borderColor: '#fff',
            borderWidth: 2
        }]
    };

    const eventsPieChartOptions = {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: {
                position: 'top'
            },
            tooltip: {
                callbacks: {
                    label: function(tooltipItem) {
                        return tooltipItem.label + ': ' + tooltipItem.raw + ' reservations';
                    }
                }
            }
        }
    };

    new Chart(document.getElementById('eventsPieChart'), {
        type: 'pie',
        data: eventsPieChartData,
        options: eventsPieChartOptions
    });
</script>
<script>
// JavaScript for downloading the canvas as PNG, SVG, and CSV

// Function to calculate the total reservations based on the chart data
function calculateTotalReservations(data) {
    return data.reduce((sum, row) => sum + row.count, 0);
}

// Download the canvas as PNG with a white background
document.getElementById('download-png').addEventListener('click', function () {
    var canvas = document.getElementById('reservation-chart');
    var totalReservations = calculateTotalReservations({!! json_encode($reservationsByMonth) !!});
    
    // Create a temporary canvas to add a white background
    var tempCanvas = document.createElement('canvas');
    var tempContext = tempCanvas.getContext('2d');
    tempCanvas.width = canvas.width;
    tempCanvas.height = canvas.height;

    // Fill the background with white
    tempContext.fillStyle = "#ffffff";
    tempContext.fillRect(0, 0, tempCanvas.width, tempCanvas.height);

    // Copy the original chart content onto the new canvas
    tempContext.drawImage(canvas, 0, 0);

    // Add total reservations to the image (optional, position as needed)
    tempContext.font = '20px Arial';
    tempContext.fillStyle = "black"; // Ensure the text is visible
    tempContext.fillText('Total Reservations: ' + totalReservations, 10, tempCanvas.height - 20);

    // Create and trigger download
    var link = document.createElement('a');
    link.href = tempCanvas.toDataURL('image/png');
    link.download = 'reservation-chart.png';
    link.click();
});

// Download the chart as SVG with a white background and total reservations
document.getElementById('download-svg').addEventListener('click', function () {
    var canvas = document.getElementById('reservation-chart');
    var totalReservations = calculateTotalReservations({!! json_encode($reservationsByMonth) !!});
    var svgData = `
        <svg xmlns="http://www.w3.org/2000/svg" width="${canvas.width}" height="${canvas.height}">
            <rect width="100%" height="100%" fill="white"></rect> <!-- White background -->
            <foreignObject width="100%" height="100%">
                <canvas xmlns="http://www.w3.org/1999/xhtml" width="${canvas.width}" height="${canvas.height}">
                    ${canvas.outerHTML}
                </canvas>
                <text x="10" y="${canvas.height - 20}" font-size="20" fill="black">
                    Total Reservations: ${totalReservations}
                </text>
            </foreignObject>
        </svg>`;
    
    var blob = new Blob([svgData], { type: 'image/svg+xml;charset=utf-8' });
    var link = document.createElement('a');
    link.href = URL.createObjectURL(blob);
    link.download = 'reservation-chart.svg';
    link.click();
});

// Download the data as CSV with total reservations
document.getElementById('download-csv').addEventListener('click', function () {
    var data = {!! json_encode($reservationsByMonth) !!}; // You may adjust the data source
    var totalReservations = calculateTotalReservations(data);
    var csvContent = "data:text/csv;charset=utf-8,";
    csvContent += "Month,Count\n"; // Add headers
    
    data.forEach(function (row) {
        csvContent += row.month + "," + row.count + "\n"; // Convert each row to CSV
    });
    
    csvContent += "\nTotal Reservations," + totalReservations + "\n"; // Add total reservations

    var encodedUri = encodeURI(csvContent);
    var link = document.createElement('a');
    link.href = encodedUri;
    link.download = 'reservation-data.csv';
    link.click();
});

</script>

<script>
    var ctx = document.getElementById('reservationChart').getContext('2d');
    var reservationChart = new Chart(ctx, {
        type: 'bar', // or 'pie' or 'line' based on your preference
        data: {
            labels: ['Pending', 'Approved', 'In Progress'], // Labels for the x-axis
            datasets: [{
                label: '', // Label for the Pending dataset
                data: [{{ $pendingReservations }}, 0, 0], // Only data for Pending
                backgroundColor: 'rgba(255, 99, 132, 0.2)', // Color for Pending
                borderColor: 'rgba(255, 99, 132, 1)', // Border color for Pending
                borderWidth: 1
            }, {
                label: '', // Label for the Approved dataset
                data: [0, {{ $approvedReservations }}, 0], // Only data for Approved
                backgroundColor: 'rgba(75, 192, 192, 0.2)', // Color for Approved
                borderColor: 'rgba(75, 192, 192, 1)', // Border color for Approved
                borderWidth: 1
            }, {
                label: '', // Label for the In Progress dataset
                data: [0, 0, {{ $inProgressReservations }}], // Only data for In Progress
                backgroundColor: 'rgba(255, 206, 86, 0.2)', // Color for In Progress
                borderColor: 'rgba(255, 206, 86, 1)', // Border color for In Progress
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script> 

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get data from the div's data attributes
        var reservationsMonth = JSON.parse(document.getElementById('reservation-analytics').getAttribute('data-reservations-month'));
        var reservationsWeek = JSON.parse(document.getElementById('reservation-analytics').getAttribute('data-reservations-week'));

        var monthLabels = [];
        var monthCounts = [];
        reservationsMonth.forEach(function (reservation) {
            monthLabels.push(new Date(reservation.year, reservation.month - 1).toLocaleString('default', { month: 'long', year: 'numeric' }));
            monthCounts.push(reservation.count);
        });

        var weekLabels = [];
        var weekCounts = [];
        reservationsWeek.forEach(function (reservation) {
            weekLabels.push(`Week ${reservation.week}, ${reservation.year}`);
            weekCounts.push(reservation.count);
        });

        // Merge the labels to create a combined x-axis
        var combinedLabels = Array.from(new Set([...monthLabels, ...weekLabels]));
        var monthData = combinedLabels.map(label => {
            var index = monthLabels.indexOf(label);
            return index !== -1 ? monthCounts[index] : 0;
        });
        var weekData = combinedLabels.map(label => {
            var index = weekLabels.indexOf(label);
            return index !== -1 ? weekCounts[index] : 0;
        });

        // Create the chart
        var ctx = document.getElementById('reservation-chart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: combinedLabels,
                datasets: [
                    {
                        label: 'by Month',
                        data: monthData,
                        backgroundColor: 'rgba(139, 0, 0, 0.5)', // Dark red color with transparency
                        borderColor: 'rgba(139, 0, 0, 1)', // Dark red color
                        borderWidth: 1,
                        barThickness: 40, // Set the thickness of the bars
                    },
                    {
                        label: 'by Week',
                        data: weekData,
                        backgroundColor: 'rgba(255, 140, 0, 0.5)', // Dark orange color with transparency
                        borderColor: 'rgba(255, 140, 0, 1)', // Dark orange color
                        borderWidth: 1,
                        barThickness: 40, // Set the thickness of the bars
                    }
                ]
            },
            options: {
                scales: {
                    x: {
                        ticks: {
                            font: {
                                size: 10 // Smaller font size for x-axis labels
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            font: {
                                size: 10 // Smaller font size for y-axis labels
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            font: {
                                size: 12 // Smaller font size for legend labels
                            }
                        }
                    }
                },
                elements: {
                    bar: {
                        borderWidth: 1 // Smaller border width for bars
                    }
                }
            }
        });
    });
</script>
<!-- End Reservation Analytics -->






</section>


@endsection





<!--div class="row my-3 justify-content-between">
    @if(isset($paymentsByDate))-->
    <!-- Payment Analytics -->
        <!--div class="col-lg-4 col-12 mb-lg-0 mb-3 flex-center">
            <div id="payment-analytics" class="col-11 p-3 h-100 shadow rounded bg-white">
                <h5 class="text-center">Payment Analytics</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Total Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($paymentsByDate as $payment)
                            <tr>
                                <td>{{ $payment->date }}</td>
                                <td>{{ $payment->total_amount }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div-->