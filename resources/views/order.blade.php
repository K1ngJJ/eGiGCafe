@extends('layouts.app')

@section('links')
    <link href="{{ asset('css/order.css') }}" rel="stylesheet">
@endsection

@section('bodyID')
{{ 'order' }}@endsection

@section('navTheme')
{{ 'light' }}@endsection

@section('logoFileName')
{{ URL::asset('/images/Black Logo.png') }}@endsection


@section('content')
<style>
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
@if (!$activeOrder && !$allOrders->count())
<!-- when user has not made an order before -->
<section class="empty-order min-vh-100 pt-5 flex-center">
    <div class="container d-flex flex-column justify-content-center align-items-center">
        <div class="hero-wrapper">
            <img src="{{ URL::asset('/images/empty_order.svg') }}" alt="">
        </div>
        <h3 class="mt-4 mb-2">No Orders Yet.</h3>
        <p class="text-muted">It seems like you haven't made your choice yet...</p>
        <!-- <a href="{{ route('menu') }}"><button class="primary-btn w-100 py-2">See Menu</button></a> -->
        <a href="{{ route('menu') }}"><button class="primary-btn mt-3">Discover menu</button></a>
    </div>
</section>
@elseif ($activeOrder)
<!-- todo - session success stuff -->
<section class="active-order d-flex">
    <div class="container">
        <div class="order-metadata mb-4">
            <div class="d-flex">
                <h2>ORDER #{{ $activeOrder->id }}</h2>
                @if ($activeOrder->completed)
                <div class="mx-5 px-3 alert alert-success">
                    Fulfilled
                </div>
                @else
                <div class="mx-5 px-3 alert alert-warning">
                    Not fulfilled
                </div>
                @endif
            </div>
            <div class="d-flex">
                <p class="text-muted">{{ \Carbon\Carbon::parse($activeOrder->getOrderDate())->format('F j, Y') }}</p>
                <p class="px-3 text-muted">{{ \Carbon\Carbon::parse($activeOrder->getOrderTime())->format('h:i A') }}</p>
            </div>
        </div>

        <div class="row">
            <div class="order-cart p-4 mb-5 col-lg-8 col-md-12">
                <h3 class="pb-4 px-2">Your cart</h3>
                <div class="flex-center flex-column order-cart-items">
                @foreach ($activeOrder->cartItems as $orderItem)
                    <div class="order-cart-item d-flex justify-content-around">
                        <div class="food-img-wrapper">
                            <img class="order-food shadow" src="{{ asset('menuImages/' . $orderItem->menu->image) }}">
                        </div>
                        <div class="food-desc-wrapper">
                            <div class="d-flex justify-content-between">
                                <h5>{{ $orderItem->menu->name }}</h5>
                                @if ($orderItem->fulfilled)
                                    <div class="px-3 alert alert-success">
                                        Fulfilled
                                    </div>  
                                @else
                                    <div class="px-3 alert alert-warning">
                                        Not fulfilled
                                    </div>  
                                @endif
                            </div>
                            <div class="mobile d-flex pt-2">
                                <p class="price">₱ {{ number_format($orderItem->menu->price, 2) }}</p>
                                <p class="quantity">x{{ $orderItem->quantity }}</p>
                                <p class="cart-item-total">₱ {{ number_format($orderItem->menu->price * $orderItem->quantity, 2) }}</p>        
                            </div>
                            <p class="text-muted desktop">{{ $orderItem->menu->description }}</p>
                        </div>
                        <p class="price desktop">₱ {{ number_format($orderItem->menu->price, 2) }}</p>
                        <p class="quantity desktop">x{{ $orderItem->quantity }}</p>
                        <p class="cart-item-total desktop">₱ {{ number_format($orderItem->menu->price * $orderItem->quantity, 2) }}</p>
                    </div>
                    <hr>
                @endforeach
                </div>
            </div>

            <div class="order-summary p-4 col-lg-3 offset-lg-1 col-md-12">
                <h3 class="pb-3">Summary</h3>
                <div class="d-flex justify-content-between">
                    <h6>Subtotal</h6>
                    <p>₱ {{ $subtotal = $activeOrder->getSubtotal() }}</p>
                </div>
                <div class="d-flex justify-content-between">
                    <h6>Discount</h6>
                    <p>-₱ {{ $discount = $activeOrder->getDiscount($subtotal) }}</p>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <h6>Total</h6>
                    <p>₱ {{ $activeOrder->getTotal($subtotal, $discount) }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

@if ($allOrders->count())
    @if (!$activeOrder)
        <div class="pt-18vh"></div>
    @endif
    <section class="order-histories d-flex align-items-center mt-lg-0">
        <div class="container mt-lg-0">
            <h2 class="mt-5 mb-4 text-left" style="font-size: 1.0rem; font-style: italic;">Previous Orders</h2>
            <div class="row my-3 justify-content-between">
                <div class="col-12 pt-3 h-100 shadow rounded bg-white">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr class="text-left">
                                    <th scope="col" class="text-left pl-3">Order&nbsp;ID</th>
                                    <th scope="col" class="text-left pl-3">Date</th>
                                    <th scope="col" class="text-left pl-3">Time</th>
                                    <th scope="col" class="text-left pl-3">Final&nbsp;Price</th>
                                    <th scope="col" class="text-left pl-3">Status</th>
                                    <th scope="col" class="text-left pl-3">Rate</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allOrders as $order)
                                    <tr>
                                        <td class="text-left pl-3">
                                            <a href="{{ route('specificOrder', $order->id) }}" class="my-md-2 mt-4 mb-5 px-3 py-1 btn-sm primary-btn flex-md-row">
                                                <strong>#</strong>&nbsp;{{ $order->id }}
                                            </a>
                                        </td>
                                        <td class="text-left pl-3">{{ \Carbon\Carbon::parse($order->getOrderDate())->format('F j, Y') }}</td>
                                        <td class="text-left pl-3">{{ \Carbon\Carbon::parse($order->getOrderTime())->format('h:i A') }}</td>
                                        <td class="text-left pl-3">₱&nbsp;{{ $order->getTotalFromScratch() }}</td>
                                        <td class="text-left pl-3">
                                            @if ($order->completed)
                                                <div class="px-3 alert alert-success">Fulfilled</div>
                                            @else
                                                <div class="px-3 alert alert-warning">Not&nbsp;fulfilled</div>
                                            @endif
                                        </td>
                                        <td class="text-left pl-3">
                                            @if ($order->completed)
                                                @if ($order->isRated())
                                                    <button class="btn btn-secondary btn-sm" disabled>Rated</button>
                                                @else
                                                    <button 
                                                        class="btn btn-warning btn-sm rate-order-btn" 
                                                        data-order-id="{{ $order->id }}"
                                                        data-items="{{ json_encode($order->cartItems) }}">
                                                        Rate Order
                                                    </button>
                                                @endif
                                            @else
                                            <button class="btn btn-light btn-sm" disabled>
                                                <div class="spinner-border spinner-border-sm text-secondary" role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
                                            </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row mt-md-4">
                <div class="col-12 flex-center">
                    {{ $allOrders->links() }}
                </div>
            </div>
        </div>
    </section>
    @if(!$activeOrder)
</div>
@endif
    <!-- Rate Order Modal -->
    <div class="modal fade" id="rateOrderModal" tabindex="-1" aria-labelledby="rateOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="rateOrderForm" method="POST" action="{{ route('rateMenu') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="rateOrderModalLabel">Rate Order</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="order-items-container">
                        <!-- Dynamic content will be injected here -->
                    </div>
                    <!-- Add a single textarea for all items' feedback -->
                    <div class="mb-3 modal-body">
                        <label class="form-label">Leave a comment for your order (optional)</label>
                        <textarea name="overall_comment" class="form-control" rows="3" placeholder="Leave a comment about your order"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit Ratings</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endif

<!-- CSS for Star Rating -->
<style>
    .rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: flex-end;
    }

    .rating input {
        display: none;
    }

    .rating label {
        font-size: 2rem;
        color: #ddd;
        cursor: pointer;
        padding: 0 5px;
    }

    .rating input:checked ~ label,
    .rating label:hover,
    .rating label:hover ~ label {
        color: #f5c518;
    }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const rateOrderButtons = document.querySelectorAll('.rate-order-btn');
    const rateOrderForm = document.getElementById('rateOrderForm');
    const orderItemsContainer = document.getElementById('order-items-container');

    rateOrderButtons.forEach(button => {
        button.addEventListener('click', function () {
            const orderId = this.dataset.orderId;
            const items = JSON.parse(this.dataset.items);

            // Clear previous ratings
            orderItemsContainer.innerHTML = '';

            // Prepare the form fields dynamically for each item
            items.forEach(item => {
                const itemDiv = document.createElement('div');
                itemDiv.classList.add('mb-3');
                itemDiv.innerHTML = `
                    <label class="form-label">${item.menu.name}</label>
                    <input type="hidden" name="ratings[${item.menu.id}][menu_id]" value="${item.menu.id}">
                    <input type="hidden" name="ratings[${item.menu.id}][order_id]" value="${orderId}">
                    <div class="rating">
                        ${[5, 4, 3, 2, 1].map(star => `
                            <input type="radio" name="ratings[${item.menu.id}][rating]" id="star-${item.menu.id}-${star}" value="${star}">
                            <label for="star-${item.menu.id}-${star}" class="star">&#9733;</label>
                        `).join('')}
                    </div>
                `;
                orderItemsContainer.appendChild(itemDiv);
            });

            // Open the modal
            const rateOrderModal = new bootstrap.Modal(document.getElementById('rateOrderModal'));
            rateOrderModal.show();
        });
    });

    // Optionally update the button after form submission
    rateOrderForm.addEventListener('submit', function () {
        rateOrderButtons.forEach(button => {
            const orderId = button.dataset.orderId;
            if (orderId) {
                button.disabled = true;
                button.textContent = 'Rated';
            }
        });
    });
});
</script>



@endsection