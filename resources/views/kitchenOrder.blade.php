@extends(( auth()->user()->role == 'customer' ) ? 'layouts.app' : 'layouts.backend' )

@section('links')
    <link href="{{ asset('css/order.css') }}" rel="stylesheet">
@endsection

@section('bodyID')
{{ 'kitchenOrder' }}@endsection

@section('navTheme')
{{ 'light' }}@endsection

@section('logoFileName')
{{ URL::asset('/images/Black Logo.png') }}@endsection


@section('content')

@if (!$firstOrder)
<!-- no active orders -->
<section class="empty-order min-vh-100 flex-center pt-5">
    <div class="container d-flex flex-column justify-content-center align-items-center">
        <div class="hero-wrapper">
            <img src="{{ URL::asset('/images/empty_order.svg') }}" alt="">
        </div>
        <h3 class="mt-4 mb-2">No Orders Yet.</h3>
        <p class="text-muted">No customers with unfulfilled orders for now...</p>
        <div class="mt-5 d-flex justify-content-center align-items-center flex-wrap">
            <a class="my-1 px-3 py-2 bg-red-500 btn-sm primary-btn d-flex justify-content-between align-items-center me-2" href="{{ route('gallery') }}">
                <i class="fa fa-picture-o" style="font-size: 17px;"></i>
                <!-- You can add a span or text here if needed -->
            </a>
            
            <a href="{{ route('previousOrder') }}" class="my-1 px-3 py-2 bg-red-500 btn-sm primary-btn d-flex justify-content-between align-items-center me-2">
                <i class="fa fa-history" style="font-size: 17px;"></i>&nbsp;Previous Orders
            </a>
        
            <a href="{{ route('dashboard') }}" class="my-1 px-3 py-2 bg-red-500 btn-sm primary-btn d-flex justify-content-between align-items-center me-2">
                <i class="fa fa-tachometer" style="font-size: 17px;"></i>&nbsp;View Dashboard
            </a>
            
            <a class="my-1 px-3 py-2 bg-red-500 btn-sm primary-btn d-flex justify-content-between align-items-center me-2" href="{{ route('menu') }}">
                <i class="fa fa-book" style="font-size: 17px;"></i>
                <!-- You can add a span or text here if needed -->
            </a>
        </div>
    </div>
</section>
@else
<!-- todo - session success stuff -->
<section class="first-order d-flex">
    <div class="container">
        <div class="order-metadata mb-4">
            <div class="d-flex">
                <h2>ORDER #{{ $firstOrder->id }}</h2>
                @if ($firstOrder->completed)
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
                <p class="text-muted">{{ \Carbon\Carbon::parse($firstOrder->getOrderDate())->format('F j, Y') }}</p>
                <p class="px-3 text-muted">{{ \Carbon\Carbon::parse($firstOrder->getOrderTime())->format('h:i A') }}</p>
            </div>
        </div>

        <div class="order-cart p-4 mb-5">
            <h3 class="pb-4 px-2">Customer's cart</h3>
            <div class="flex-center flex-column order-cart-items">
            @foreach ($firstOrder->cartItems as $orderItem)
                <div class="order-cart-item d-flex justify-content-around">
                    <div class="food-img-wrapper">
                        <img src="{{ asset('menuImages/' . $orderItem->menu->image) }}" class="order-food">                      
                    </div>
                    <div class="food-desc-wrapper">
                        <div class="d-flex justify-content-between">
                            <h5>{{ $orderItem->menu->name }}</h5>
                            <div class="food-status-wrapper">
                            @if ($orderItem->fulfilled)
                                <form action="{{ route('orderStatusUpdate', $orderItem->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button class="primary-btn px-3 unfulfill">Unfulfill</button>
                                </form>
                            @else
                                <form action="{{ route('orderStatusUpdate', $orderItem->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button class="primary-btn px-3 fulfill">Fulfill</button>
                                </form>                                
                            @endif
                            </div>
                        </div>
                        <div class="mobile d-flex pt-2">
                            <p class="price">{{ number_format($orderItem->menu->price, 2) }}</p>
                            <p class="quantity">x{{ $orderItem->quantity }}</p>
                            <p class="cart-item-total">₱ {{ number_format($orderItem->menu->price * $orderItem->quantity, 2) }}</p>        
                        </div>
                        <p class="text-muted desktop w-75">{{ $orderItem->menu->description }}</p>
                    </div>
                    <p class="price desktop">₱ {{ number_format($orderItem->menu->price, 2) }}</p>
                    <p class="quantity desktop">x{{ $orderItem->quantity }}</p>
                    <p class="cart-item-total desktop">₱ {{ number_format($orderItem->menu->price * $orderItem->quantity, 2) }}</p>
                </div>
                <hr>
            @endforeach
            </div>
        </div>

        @if (!$activeOrders->count())
        <div class="d-flex justify-content-center">
            <a href="{{ route('previousOrder') }}" class="primary-btn">Previous Orders</a>
        </div>
        @endif

    </div>
</section>
@endif

@if ($activeOrders->count())
<section class="kitchen-active-orders">
    <div class="container">
        <h2 class="mt-5 mb-4" style="font-size: 1.0rem;font-style: italic;">Active Orders</h2>
        

      <div class="row my-3 justify-content-between">
        <div class="col-12 pt-3 h-100 shadow rounded bg-white">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr class="text-left">
                            <th scope="col" class="pl-3">Order&nbsp;ID</th>
                            <th scope="col" class="pl-3">Date</th>
                            <th scope="col" class="pl-3">Time</th>
                            <th scope="col" class="pl-3">Final&nbsp;Price</th>
                            <th scope="col" class="pl-3">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activeOrders as $order)
                            @if ($firstOrder->id == $order->id)
                                <tr class="table-active">
                            @else
                                <tr>
                            @endif
                                <th scope="row" class="pl-3">
                                    <a href="{{ route('specificOrder', $order->id) }}">
                                        <strong>#</strong>&nbsp;{{ $order->id }}
                                    </a>
                                </th>
                                <td class="pl-3">{{ \Carbon\Carbon::parse($order->getOrderDate())->format('F j, Y') }}</td>
                                <td class="pl-3">{{ \Carbon\Carbon::parse($order->getOrderTime())->format('h:i A') }}</td>
                                <td class="pl-3">₱&nbsp;{{ $order->getTotalFromScratch() }}</td>
                                <td class="pl-3">
                                    @if ($order->completed)
                                        <div class="px-3 alert alert-success">
                                            Fulfilled
                                        </div>  
                                    @else
                                        <div class="px-3 alert alert-warning">
                                            Not&nbsp;fulfilled
                                        </div>  
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
        <div class="mt-5 d-flex justify-content-start align-items-center flex-wrap">
            <!-- Gallery Button -->
            <a class="my-1 px-3 py-2 bg-red-500 btn-sm primary-btn d-flex justify-content-between align-items-center me-2" href="{{ route('gallery') }}">
                <i class="fa fa-picture-o" style="font-size: 17px;"></i>
                <!-- You can add a span or text here if needed -->
            </a>

            <!-- Previous Orders Button -->
            <a href="{{ route('previousOrder') }}" class="my-1 px-3 py-2 bg-red-500 btn-sm primary-btn me-2">
                Previous Orders
            </a>

            <!-- Menu Button -->
            <a class="my-1 px-3 py-2 bg-red-500 btn-sm primary-btn d-flex justify-content-between align-items-center me-2" href="{{ route('menu') }}">
                <i class="fa fa-book" style="font-size: 17px;"></i>
                <!-- You can add a span or text here if needed -->
            </a>

            <!-- Pagination Links (activeOrders links) -->
            <div class="my-1 me-2">
                {{ $activeOrders->links() }}
            </div>

        </div>

    </div>
</section>
@endif
@endsection