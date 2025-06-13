@extends('layouts.backend')

@section('links')
    <link href="{{ asset('css/order.css') }}" rel="stylesheet">
@endsection

@section('bodyID')
{{ 'previousOrder' }}
@endsection

@section('navTheme')
{{ 'light' }}@endsection

@section('logoFileName')
{{ URL::asset('/images/Black Logo.png') }}@endsection


@section('content')

<style>

.btn-dark {
    background-color: black;
    color: white;
} 

.btn-dark:hover {
    background-color: white;
    color: black;
} 

.btn-danger {
    background-color: black; 
    color: white;
    border: gray;
}

.btn-complete {
    background-color: red; 
    color: white;
    border: gray;
} 

.btn-warning {
    background-color: darkorange; 
    color: white;
} 

.btn-warning:hover {
    background-color: white; /* Changing background color on hover */
    color: black; /* Changing text color on hover */
}

.btn-success {
    color: green;
    background-color: transparent; /* Setting the background-color to transparent */
    border-color: green; /* Adding border color for better visibility */
}

.btn-success:hover {
    background-color: white; /* Changing background color on hover */
    color: white; /* Changing text color on hover */
}

.bold-divider {
    font-weight: bold; /* Make text bold */
    height: 2px; /* Increase height to make the line bolder */
    background-color: black; /* Ensure the line is visible */
    margin-top: 0.5rem;
    margin-bottom: 0.5rem;
}

.custom-status-span {
    background-color: maroon; /* Red background */
    color: white; /* White text */
    padding: 0.25rem 0.5rem; /* Padding for some spacing */
    font-size: 0.75rem; /* Small font size */
    font-weight: bold; /* Bold text */
    text-transform: uppercase; /* Uppercase text */
    letter-spacing: 0.05em; /* Tracking wider */
    border-color: white;
}

.custom-red-icon {
    color: black; /* Red color */
    border: 2px solid darkred; /* Red border */
    padding: 4px; /* Padding for spacing between border and icon */
    border-radius: 5px; /* Rounded corners */
    transition: color 0.3s ease, border-color 0.3s ease; /* Smooth transition for hover effect */
}

.custom-red-icon:hover {
    color: white; /* Change icon color on hover */
    border-color: white; /* Change border color on hover */
    background-color: darkred; /* Add background color on hover */
}

.alert-failed{
    color: #400200; 
    border: 1px solid #C54644;
    padding: 4px;
    border-radius: 5px;
    background-color: #f3d3d9;
}

.modal-body {
        border-radius: 10px;
        background-color: #f9f9f9;
    }
    .reservation-info h5 {
        font-size: 1.25rem;
        color: #007bff;
    }
    .reservation-info .table {
        margin-bottom: 0; /* Remove margin below the table */
    }
    .reservation-info .table th {
        background-color: #f1f1f1; /* Light grey background for table headers */
        font-weight: 600; /* Bold headers */
    }
    .reservation-info .table td, .reservation-info .table th {
        padding: 0.75rem;
    }.custom-modal-body {
        border-radius: 15px;
        background-color: #fdfdfd;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .reservation-info h5 {
        font-size: 1.5rem;
        color: #007bff;
        text-align: center;
        margin-bottom: 1.5rem;
    }
    .info-item {
        display: flex;
        justify-content: space-between;
        padding: 0.5rem 0;
        border-bottom: 1px solid #e9ecef;
    }
    .info-item:last-child {
        border-bottom: none;
    }
    .info-label {
        font-weight: bold;
        color: #495057;
    }
    .info-value {
        color: #212529;
    }
    
</style>

<section class="kitchen-previous-orders min-vh-100 d-flex align-items-center mt-lg-0 mt-3">
    <div class="container mt-lg-0 mt-5">
    <h2 class="mt-5 mb-4" style="font-size: 1.0rem;font-style: italic;">Catering Equipments & Utensils</h2>
    <div class="row my-5 justify-content-between">
        <div class="col-12 pt-3 h-100 shadow rounded bg-white ">
        <div class="d-flex">
            <a class="my-md-1 px-3 py-2 bg-red-500 btn-sm primary-btn flex-md-row flex-column justify-content-md-between me-2" href="{{ route('cateringoptions.index') }}">
                <i class="fas fa-cogs" style="font-size: 17px;"></i>
                <!--span>Catering Options</span-->
            </a>
            <a class="my-md-1 px-3 py-2 bg-red-500 btn-sm primary-btn flex-md-row flex-column justify-content-md-between me-2" href="{{ route('reservations.index') }}">
                <i class="fa fa-calendar" style="font-size: 17px;"></i>
                <!--span>Catering Reserves</span-->
            </a>
        </div>
         <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">
                            <div class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-700 uppercase"><b>Name</b></div></th>
                            <th scope="col">
                            <div class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-700 uppercase"><b>Quantity</b></div></th>
                            <th scope="col">
                            <div class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-700 uppercase"><b>Status</b></div></th>
                            <th scope="col">
                            <div class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-700 uppercase"><b>Price</b></div></th>
                            <th scope="col">
                            <div class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-700 uppercase">
                            <a href="{{ route('ReservationsTxn.Pdf') }}" class="btn btn-dark btn-sm" id="pdfDownloadBtn"><i class="fa fa-download"></i></a>
                            <!-- Modal -->
                                <div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="loadingModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="loadingModalLabel">Preparing PDF</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Please wait while the PDF is being prepared for download...
                                    </div>
                                    </div>
                                </div>
                                </div>

                            <a href="{{ route('inventory.create') }}" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i></a>
                            </div>
                            </th>       
                        </tr>
                    </thead>
                <tbody>
                @foreach ($inventories as $inventory)
                <tr>
                    <td class="py-3 px-3 text-sm font-medium text-gray-900 whitespace-nowrap">
                        <div class="my-md-1 px-2 py-1">{{ $inventory->name }}</div>
                    </td>
                    <td class="py-3 px-3 text-sm font-medium text-gray-900 whitespace-nowrap">
                            <div id="quantity-{{ $inventory->id }}" class="my-md-1 px-2 py-1 mx-2">
                                @if ($inventory->quantity <= 0)
                                    <span class="badge bg-danger">Out of Stock</span>
                                @else
                                    {{ $inventory->quantity }}
                                @endif
                            </div>
                    </td>

                    <td class="py-3 px-3 text-sm font-medium text-gray-900 whitespace-nowrap">
                        <div class="my-md-1 px-2 py-1 {{ $inventory->status == 'Available' ? 'px-4 alert alert-success' : '' }} {{ $inventory->status == 'Unavailable' ? 'px-4 alert alert-warning' : '' }}">
                            {{ $inventory->status }}
                        </div>
                    </td>
                    
                    <td class="py-3 px-3 text-sm font-medium text-gray-900 whitespace-nowrap">
                        <div class="my-md-1 px-2 py-1">₱ {{ $inventory->price }}</div>
                    </td>
                    
                    <td class="py-3 px-3 text-sm font-medium text-gray-900 whitespace-nowrap">
                        <div class="d-flex">
                            <a href="#" class="view-details btn-sm" data-toggle="modal" data-target="#viewReservation{{ $inventory->id }}">
                                <i class="fas fa-eye px-3 py-1 custom-red-icon" style="font-size: 17px;"></i> 
                            </a>
                            <button type="button" class="my-md-1 px-2 py-1 bg-red-500 btn-sm primary-btn d-flex flex-md-row flex-column justify-content-md-between" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $inventory->id }}">
                                <i class="fa fa-trash" style="font-size: 17px;"></i>
                            </button>
                        </div>
                    </td>    
                </tr>


                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal{{ $inventory->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $inventory->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel{{ $inventory->id }}">Delete packages</h5>
                                                    
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this <strong>utensils #{{ $inventory->id }}</strong>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button>
                                                        <form action="{{ route( 'inventory.destroy', $inventory->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash" style="font-size: 20px;"></i></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                        <!-- End Delete Modal -->

                                          <!-- Modal for viewing reservation details -->
                        <div class="modal fade" id="viewReservation{{ $inventory->id }}" tabindex="-1" role="dialog" aria-labelledby="viewReservation{{ $inventory->id }}Label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewReservation{{ $inventory->id }}Label">Utensils Details</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body p-4 bg-light custom-modal-body">
                                        <div class="d-flex justify-content-between">
                                            <a href="{{ route('packages.pdf', $inventory->id) }}" class="btn btn-dark btn-md mr-auto">
                                                <i class="fa fa-download" style="font-size: 15px;"></i>
                                            </a>

                                            <span class="input-group-text py-1 px-2 text-xs font-small tracking-wider text-left text-gray-700 uppercase custom-status-span">
                                                Status
                                            </span>
                                            <select id="utensilStatus{{ $inventory->id }}" class="form-control">
                                                @foreach(\App\Enums\UtensilStatus::cases() as $status)
                                                        <option value="{{ $status->value }}" {{ $inventory->status === $status->value ? 'selected' : '' }}>{{ $status->value }}</option>
                                                @endforeach
                                            </select>

                                      
                                                <button onclick="window.location.href='{{ route('inventory.edit', $inventory->id) }}'" class="btn-md btn btn-warning ml-auto">
                                                    <i class="fa fa-edit" style="font-size: 20px;"></i>
                                                </button>
                                          
                                        </div>

                                        <div class="dropdown-divider bold-divider"></div>

                                        <div class="reservation-info">
                                            <div class="info-item">
                                                <span class="info-label">Name:</span> <span class="info-value"><strong>{{ $inventory->name }}</strong></span>
                                            </div>
                                            <div class="info-item">
                                                <span class="info-label">Quantity:</span>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <!-- Decrement button -->
                                                    <button type="button" onclick="changeTemporaryQuantity('{{ $inventory->id }}', -1)" class="btn btn-sm custom-red-icon"><strong>−</strong></button>

                                                    <!-- Quantity display with padding on left and right -->
                                                    <div id="quantity-{{ $inventory->id }}" class="mx-3 px-2">
                                                        @if ($inventory->quantity <= 0)
                                                            <span class="badge bg-danger">Out of Stock</span>
                                                        @else
                                                            {{ $inventory->quantity }}
                                                        @endif
                                                    </div>

                                                    <!-- Increment button -->
                                                    <button type="button" onclick="changeTemporaryQuantity('{{ $inventory->id }}', 1)" class="btn btn-sm custom-red-icon"><strong>+</strong></button>

                                                    <!-- Check button to finalize update -->
                                                    <button type="button" onclick="updateQuantity('{{ $inventory->id }}')" class="btn btn-sm primary-btn ml-2 mx-2 px-1">
                                                        <i class="fa fa-check" style="font-size: 16px;"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="info-item">
                                                <span class="info-label">Status:</span>
                                                <span class="info-value">{{ $inventory->status }}</span>
                                            </div>

                                            <div class="info-item">
                                                <span class="info-label">Price:</span> <span class="info-value">₱ {{ $inventory->price }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-between">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <div id="update-message-{{ $inventory->id }}" class="mt-2 p-2 text-sm text-gray-700 bg-yellow-100 border-l-4 border-yellow-500 d-none flex items-center">
                                            <svg class="w-6 h-6 mr-2" style="color: #FF8C00;" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 18h.01M9 21h6a2 2 0 002-2v-4a8 8 0 10-8 0v4a2 2 0 002 2z"></path>
                                            </svg>
                                            <span class="text-xs">Updated Successfully!</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
</div>
</div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Variable to track temporary quantities
    let tempQuantities = {};

    // Function to adjust temporary quantity display only
    function changeTemporaryQuantity(id, increment) {
        if (tempQuantities[id] === undefined) {
            const currentQuantity = parseInt($('#quantity-' + id).text().trim()) || 0;
            tempQuantities[id] = currentQuantity;
        }
        tempQuantities[id] += increment;
        if (tempQuantities[id] < 0) {
            tempQuantities[id] = 0;
            alert("Quantity cannot be negative.");
        }
        $('#quantity-' + id).html(tempQuantities[id] > 0 ? tempQuantities[id] : '<span class="badge bg-danger">Out of Stock</span>');
    }

    // Update the actual quantity in the database when check button is clicked
    function updateQuantity(id) {
        if (tempQuantities[id] === undefined) {
            alert("No changes to update.");
            return;
        }

        $.ajax({
            url: '{{ url("inventory") }}/' + id + '/update-quantity',
            type: 'PATCH',
            data: {
                quantity: tempQuantities[id],
                _token: '{{ csrf_token() }}',
            },
            success: function(response) {
                if (response.quantity <= 0) {
                    $('#quantity-' + id).html('<span class="badge bg-danger">Out of Stock</span>');
                    updateInventoryStatus(id, 'Unavailable');
                } else {
                    $('#quantity-' + id).text(response.quantity);
                    updateInventoryStatus(id, 'Available');
                }
                delete tempQuantities[id];

                // Show success message and refresh page after 2 seconds
                $('#update-message-' + id).removeClass('d-none');
                setTimeout(function() {
                    $('#update-message-' + id).addClass('d-none');
                    location.reload();
                }, 2000);
            },
            error: function(xhr) {
                alert("Error updating quantity: " + xhr.responseJSON.message);
            }
        });
    }

    // Update the inventory status
    function updateInventoryStatus(id, status) {
        $.ajax({
            url: '{{ url("inventory") }}/' + id + '/utensil-status',
            type: 'PATCH',
            data: {
                status: status,
                _token: '{{ csrf_token() }}',
            },
            success: function(response) {
                console.log("Status updated successfully");
            },
            error: function(xhr) {
                alert("Error updating status: " + xhr.responseJSON.message);
            }
        });
    }
</script>

<script>
   document.addEventListener('DOMContentLoaded', function () {
    // Add event listeners to all select elements that match the ID pattern for utensil status
    document.querySelectorAll('[id^="utensilStatus"]').forEach(function (selectElement) {
        selectElement.addEventListener('change', function () {
            const inventoryId = selectElement.id.replace('utensilStatus', '');  // Extract inventory ID from the select element's ID
            const newStatus = selectElement.value;

            fetch(`/inventory/${inventoryId}/status`, {  // Adjust the URL to match your route
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'  // Ensure you have the CSRF token for the request
                },
                body: JSON.stringify({ status: newStatus })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Status updated successfully');
                    location.reload();  // Refresh the page
                } else {
                    alert('Failed to update status');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});
</script>


<script>
document.getElementById('pdfDownloadBtn').addEventListener('click', function() {
   // Show loading modal
   $('#loadingModal').modal('show');
    // Show loading style (e.g., spinner)
    // You can add your loading animation here
    
    // Optionally, you can add a delay before starting the download
    // setTimeout(function() {
    //     // Start the download
    //     window.location.href = "{{ route('ReservationsTxn.Pdf') }}";
    // }, 1000); // 1000 milliseconds delay

    // Or, you can directly start the download without delay
    window.location.href = "{{ route('ReservationsTxn.Pdf') }}";

    // To prevent the default behavior (i.e., following the link) and handle the download manually
    // You can uncomment the following line if you want to prevent the default behavior
    // return false;
});
</script>

@endsection