@extends(( !Auth::check() || auth()->user()->role == 'customer' ) ? 'layouts.app' : 'layouts.backend' )

@section('links')
<link href="{{ asset('css/menu.css') }}" rel="stylesheet">
@endsection

@section('bodyID')
{{ 'menu' }}@endsection

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

.btn-success {
    background-color: black;
    color: white;
} 
.btn-success:hover {
    background-color: white;
    color: black;
}
.gradient-hr {
    border: none; /* Remove default border */
    height: 8px; /* Increase height for a bolder appearance */
    background: linear-gradient(to right, #000000, #FF4500, #dc3545); /* Increase contrast by using a more intense orange */
    border-radius: 8px; /* Keep the rounded edges */
}

.border-gradient {
    border-image: linear-gradient(to right, black, #FF8C00, #dc3545)1;
}
</style>

<style>
    /* Center image container */
    .flex-center {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 20px; /* Optional spacing between images */
    }

    /* Hide modal by default */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    /* Image styling inside the modal */
    .modal img {
        max-width: 90%;
        max-height: 90%;
    }
</style>

@if (Auth::check() && auth()->user()->role != 'customer')
<section class="menu" style="margin-top: 15vh;">
@else
<section class="menu" style="margin-top: 20vh;">
@endif
    <div class="container">
    <table class="table table-hover">
        <div class="col-12 pt-3 h-100 shadow rounded bg-white ">
            <h6 class="d-flex justify-content-center menu-title ">OUR MENU</h2>
            <br>
        </div>
    </table>
        @if (session('success'))
        <div class="alert alert-success fixed-bottom" role="alert" style="width:500px;left:30px;bottom:20px">
            {{ session('success') }}
        </div>
        @endif
 <hr class="my-2 gradient-hr">
    <div class="row menu-bar">
        @if (Auth::check() && auth()->user()->role != 'customer')
            <div class="col-md-2 d-flex align-items-center">
                <div class="dropstart">    
                    <button type="button" class="btn btn-success" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" id="filter-button">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </button>
                    <div class="dropdown-menu p-3" style="width: 100%; max-width: 350px; min-width: 290px;">    
                        <form method='post' action="{{ route('saveMenuItem') }}" enctype="multipart/form-data" class="px-4 py-3">
                            @csrf
                            <div class="container">
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="item-image" class="form-label">Item Image</label>
                                        <input name="menuImage" class="form-control" type="file" id="item-image" required>
                                    </div>
                                </div>
                            
                                <div class="dropdown-divider"></div>
                            
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="itemTypeInputGroup" class="form-label">Item Type</label>
                                        <div class="input-group">
                                            <label class="input-group-text" for="itemTypeInputGroup">Type:</label>
                                            <select name="menuType" class="form-select" id="itemTypeInputGroup">
                                                <option value="Silog">Silog</option>
                                                <option value="Sandwich">Sandwich</option>
                                                <option value="Burger">Burger</option>
                                                <option value="Pasta">Pasta</option>
                                                <option value="Snacks">Snacks</option>
                                                <option value="Milk Tea">Milk Tea</option>
                                                <option value="Fruit Tea">Fruit Tea</option>
                                                <option value="Etc.">Etc.</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="dropdown-divider"></div>
                            
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="itemName" class="form-label">Item Name</label>
                                        <input name="menuName" type="text" class="form-control" placeholder="Name" aria-label="Item Name" required>
                                    </div>
                                </div>
                            
                                <div class="dropdown-divider"></div>
                            
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="itemPrice" class="form-label">Item Price</label>
                                        <div class="input-group">
                                            <span class="input-group-text">₱</span>
                                            <input name="menuPrice" type="number" min="0" step="0.01" class="form-control" placeholder="Price" aria-label="Item Price" required>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="dropdown-divider"></div>
                            
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="itemEstCost" class="form-label">Item Estimated Cost</label>
                                        <div class="input-group">
                                            <span class="input-group-text">₱</span>
                                            <input name="menuEstCost" type="number" min="0" step="0.01" class="form-control" placeholder="Cost" aria-label="Item Cost" required>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="dropdown-divider"></div>
                            
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="itemDescription" class="form-label">Item Description</label>
                                        <textarea name="menuDescription" class="form-control" placeholder="Description" aria-label="Item Description" required></textarea>
                                    </div>
                                </div>
                            
                                <div class="dropdown-divider"></div>
                            
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="itemSizeInputGroup" class="form-label">Portion</label>
                                        <div class="input-group">
                                            <label class="input-group-text" for="itemSizeInputGroup">Size:</label>
                                            <select name="menuSize" class="form-select" id="itemSizeInputGroup">
                                                <option value="1-2">1 - 2 People</option>
                                                <option value="3-4">3 - 4 People</option>
                                                <option value=">5">More than 5 People</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="dropdown-divider"></div>
                            
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="specialCondition" class="form-label">Special Condition</label>
                                        <div class="form-check">
                                            <input name="menuAllergic" type="hidden" value="0">
                                            <input name="menuAllergic" value="1" type="checkbox" class="form-check-input" id="allergicCheck">
                                            <label class="form-check-label" for="allergicCheck">
                                                Allergic
                                            </label>
                                            <input name='menuAllergic' value=1 type="checkbox" class="form-check-input" id="dropdownCheck">
                                            <label class="form-check-label" for="dropdownCheck">
                                            Allergic
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input name="menuVegetarian" type="hidden" value="0">
                                            <input name="menuVegetarian" value="1" type="checkbox" class="form-check-input" id="vegetarianCheck">
                                            <label class="form-check-label" for="vegetarianCheck">
                                                Vegetarian
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input name="menuVegan" type="hidden" value="0">
                                            <input name="menuVegan" value="1" type="checkbox" class="form-check-input" id="veganCheck">
                                            <label class="form-check-label" for="veganCheck">
                                                Vegan
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="dropdown-divider"></div>
                            
                                <button type="submit" class="btn btn-outline-success">Add Item</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    
        <div class="col-md-12 text-center">
            <form method="get" action="{{ route('filterMenu') }}" class="d-flex flex-wrap justify-content-center">
                <button type="submit" name="menuType" value="" class="btn btn-light menu-type-button mx-1 my-1">All</button>
                <button type="submit" name="menuType" value="Silog" class="btn btn-light menu-type-button mx-1 my-1">Silog</button>
                <button type="submit" name="menuType" value="Sandwich" class="btn btn-light menu-type-button mx-1 my-1">Sandwich</button>
                <button type="submit" name="menuType" value="Burger" class="btn btn-light menu-type-button mx-1 my-1">Burger</button>
                <button type="submit" name="menuType" value="Pasta" class="btn btn-light menu-type-button mx-1 my-1">Pasta</button>
                <button type="submit" name="menuType" value="Snacks" class="btn btn-light menu-type-button mx-1 my-1">Snacks</button>
                <button type="submit" name="menuType" value="Milk Tea" class="btn btn-light menu-type-button mx-1 my-1">Milk Tea</button>
                <button type="submit" name="menuType" value="Fruit Tea" class="btn btn-light menu-type-button mx-1 my-1">Fruit Tea</button>
                <button type="submit" name="menuType" value="Etc." class="btn btn-light menu-type-button mx-1 my-1">Etc.</button>
            </form>
        </div>
     <hr class="my-2 gradient-hr">

   <!-- Filter Dropdown (Accessible to All Users) -->

    <div class="col-md-12 d-flex align-items-center">
         @if (Auth::check() && auth()->user()->role != 'customer')
            <div class="d-flex">
                <a class="my-md-1 px-3 py-2 bg-red-500 btn-sm primary-btn flex-md-row flex-column justify-content-md-between me-2" href="{{ route('kitchenOrder') }}">
                    <i class="fa fa-shopping-cart" style="font-size: 17px;"></i>
                    <!--span>Order</span-->
                </a>
                <a class="my-md-1 px-3 py-2 bg-red-500 btn-sm primary-btn flex-md-row flex-column justify-content-md-between me-2" href="{{ route('discount') }}">
                    <i class="fa fa-ticket" style="font-size: 17px;"></i>
                    <!--span>Discount</span-->
                </a>
            </div>
        @endif
        <div class="dropstart w-100 d-flex justify-content-end">    
            <button type="button" class="btn btn-dark" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" id="filter-button">
                <i class="fa fa-filter" aria-hidden="true"></i>
            </button>
            <div class="dropdown-menu p-3" style="width: 80%; max-width: 300px; min-width: 200px;">
                <form method="get" action="{{ route('filterMenu') }}" class="row g-2">
                    <div class="col-12">
                        <label for="itemTypeInputGroup" class="form-label">Item Type</label>
                        <div class="input-group">
                            <label class="input-group-text" for="itemTypeInputGroup">Type:</label>
                            <select name="menuType" class="form-select" id="itemTypeInputGroup">
                                <option value="">All</option>
                                <option value="Silog">Silog</option>
                                <option value="Sandwich">Sandwich</option>
                                <option value="Burger">Burger</option>
                                <option value="Pasta">Pasta</option>
                                <option value="Snacks">Snacks</option>
                                <option value="Milk Tea">Milk Tea</option>
                                <option value="Fruit Tea">Fruit Tea</option>
                                <option value="Etc.">Etc.</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <label for="priceRangeInputGroup" class="form-label">Price Range</label>
                        <div class="input-group">
                            <span class="input-group-text">₱</span>
                            <input name="fromPrice" type="number" class="form-control" placeholder="Min" aria-label="From Price">
                            <span class="input-group-text">to</span>
                            <input name="toPrice" type="number" class="form-control" placeholder="Max" aria-label="To Price">
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <label for="sizeInputGroup" class="form-label">Portion</label>
                        <div class="input-group">
                            <label class="input-group-text" for="sizeInputGroup">Size:</label>
                            <select name="menuSize" class="form-select" id="sizeInputGroup">
                                <option value="">All</option>
                                <option value="1-2">1 - 2 People</option>
                                <option value="3-4">3 - 4 People</option>
                                <option value=">5">More than 5 People</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <label for="specialConditionInputGroup" class="form-label">Special Condition</label>
                        <div class="form-check">
                            <input name='menuAllergic' value=1 type="checkbox" class="form-check-input" id="dropdownCheckAllergic">
                            <label class="form-check-label" for="dropdownCheckAllergic">Allergic</label>
                        </div>
                        <div class="form-check">
                            <input name='menuVegetarian' value=1 type="checkbox" class="form-check-input" id="dropdownCheckVegetarian">
                            <label class="form-check-label" for="dropdownCheckVegetarian">Vegetarian</label>
                        </div>
                        <div class="form-check">
                            <input name='menuVegan' value=1 type="checkbox" class="form-check-input" id="dropdownCheckVegan">
                            <label class="form-check-label" for="dropdownCheckVegan">Vegan</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="ratingInputGroup" class="form-label">Minimum Rating</label>
                        <div class="input-group">
                            <label class="input-group-text" for="ratingInputGroup">Rating:</label>
                            <select name="rating" class="form-select" id="ratingInputGroup">
                                <option value="">All</option>
                                <option value="5">
                                    &#9733;&#9733;&#9733;&#9733;&#9733; 5 Stars
                                </option>
                                <option value="4">
                                    &#9733;&#9733;&#9733;&#9733; 4 Stars & Up
                                </option>
                                <option value="3">
                                    &#9733;&#9733;&#9733; 3 Stars & Up
                                </option>
                                <option value="2">
                                    &#9733;&#9733; 2 Stars & Up
                                </option>
                                <option value="1">
                                    &#9733; 1 Star & Up
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-dark w-100">Apply Filter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="d-flex flex-wrap mt-2 mb-5">
    @forelse ($menus as $menu)
        <div class="card col-md-3 col-6 d-flex align-items-center">
            <div class="card-body w-100">
                <form class="d-flex flex-column justify-content-between h-100" action="{{ route('addToCart') }}" method="post">
                    @csrf
                    <div class="flex-center">
                        <!-- Image Thumbnail -->
                        <img class="card-img-top menuImage" src="{{ asset('menuImages/' . $menu->image) }}" alt="Menu Image" onclick="toggleModal(this)">

                        <!-- Modal for Preview -->
                        <div class="modal" onclick="closeModal(event)">
                            <img src="{{ asset('menuImages/' . $menu->image) }}" alt="Full-size Menu Image">
                        </div>
                    </div>
                    <h5 class="card-title mt-3">{{ $menu->name }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $menu->description }}</h6>
                    <h6 class="card-subtitle mb-2 text-muted">For {{ $menu->size }} people</h6>

                    <!-- Display Ratings and Customer Count -->
                    <div class="ratings d-flex justify-content-between align-items-center">
                        <div class="stars" style="color: #f5c518;">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= floor($menu->averageRating))
                                    &#9733; <!-- Full Star -->
                                @else
                                    &#9734; <!-- Empty Star -->
                                @endif
                            @endfor
                            <small>({{ round($menu->averageRating, 1) }} / 5)</small>
                        </div>
                        <div class="comment-count d-flex align-items-center">
                            <i class="fa fa-comments click-to-view-comments" id="customer-count-{{ $menu->id }}" data-bs-toggle="modal" data-bs-target="#commentModal" data-menu-id="{{ $menu->id }}" aria-hidden="true" style="font-size: 1.2rem; color: #007bff; margin-right: 0.25rem;"></i>
                            <span>{{ $menu->commentCount }}</span>
                        </div>
                        <!--div class="customer-count d-flex align-items-center">
                            <i class="fa fa-user click-to-view-comments" id="customer-count-{{ $menu->id }}" data-bs-toggle="modal" data-bs-target="#commentModal" data-menu-id="{{ $menu->id }}" aria-hidden="true" style="font-size: 1.2rem; color: #333; margin-right: 0.25rem;"></i>          
                                {{ $menu->customerCount }}
                        </div-->
                    </div>

                    <div class="d-flex justify-content-between mt-3">
                        <p class="card-text fs-5 fw-bold">₱ {{ number_format($menu->price, 2) }}</p>
                        <h6 class="card-text flex-center">
                            @if($menu->allergic)
                                <i class="fa fa-exclamation-circle allergic-alert" aria-hidden="true" data-bs-toggle="tooltip" title="Allergic Warning"></i>
                            @endif

                            @if($menu->vegan)
                                <i class="fa fa-tree" aria-hidden="true" data-bs-toggle="tooltip" title="Vegan Friendly"></i>
                            @elseif($menu->vegetarian)
                                <i class="fa fa-leaf" aria-hidden="true" data-bs-toggle="tooltip" title="Vegetarian Friendly"></i>
                            @endif
                        </h6>
                        <div class="customer-count d-flex align-items-center">
                            <i class="fa fa-user click-to-view-comments" id="customer-count-{{ $menu->id }}" data-bs-toggle="modal" data-bs-target="#commentModal" data-menu-id="{{ $menu->id }}" aria-hidden="true" style="font-size: 1.2rem; color: #333; margin-right: 0.25rem;"></i>          
                                {{ $menu->customerCount }}
                        </div>
                    </div>

                    <input name="menuID" type="hidden" value="{{ $menu->id }}">
                    <input name="menuName" type="hidden" value="{{ $menu->name }}">
                    @if (Auth::check())
                        @if (auth()->user()->role == 'customer')
                            <button type="submit" class="primary-btn w-100 mt-3">Add to Cart</button>
                        @else
                            <div class="dropdown w-100 mt-3">
                                <a href="#" role="button" id="dropdownMenuLink" 
                                    data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                    <button class="primary-btn w-100">Edit</button>
                                </a>

                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <li><a class="dropdown-item" href="{{ url('./editMenuImages/'.$menu->id) }}">Edit Images</a></li>
                                    <li><a class="dropdown-item" href="{{ url('./editMenuDetails/'.$menu->id) }}">Edit Details</a></li>
                                    <li><a class="dropdown-item" href="{{ url('./delete/'.$menu->id) }}">Delete</a></li>
                                </ul>
                            </div>
                        @endif
                    @endif
                </form>
            </div>
        </div>
    @empty
        <div class="row">
            <div class="col-12">
                <h1>No result found... <i class="fa fa-frown-o" aria-hidden="true"></i></h1>
            </div>
        </div>
    @endforelse
</div>


<style>
/* Lighter backdrop */
.modal-backdrop {
    background-color: rgba(0, 0, 0, 0.3) !important; /* Lightens the dark overlay */
}

/* Ensure the close button is not blocked */
.modal-dialog {
    z-index: 1050; /* Adjust the z-index to ensure the modal is on top */
}

.modal-content {
    position: relative;
    z-index: 1060; /* Keep modal content above the backdrop */
}

/* Modal Body */
.modal-body {
    max-height: 400px;  /* Limit height of modal body */
    overflow-y: auto;   /* Allow scroll if comments exceed the height */
}

/* Comment Card */
.card {
    border: 1px solid #ddd;
    border-radius: 8px;
}

.card-body {
    padding: 15px;
}

.card-body p {
    font-size: 13px; /* Smaller text for the comments */
    color: #555;
    line-height: 1.4;
}

.modal-title {
    font-size: 1rem;
    font-weight: bold;
}

.modal-footer {
    display: flex;
    justify-content: flex-end;
}

.btn-close {
    font-size: 1.5rem;
}

.modal-header {
    background-color: #f5c518; /* Bright yellow */
    color: black;
}

.modal-body .text-center h6 {
    font-weight: bold;
    font-size: 1.1rem; /* Slightly larger heading for clarity */
}

.modal-body .text-muted {
    font-size: 0.8rem; /* Slightly smaller text for the description */
}

.modal-footer .btn-outline-danger {
    width: 100px;
}

.modal-footer .btn-sm {
    font-size: 0.85rem;
}
</style>
   <!-- Customer Comments Modal -->
<div style="z-index: 1060;" class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content rounded-3 shadow-lg border-0">
            <!-- Modal Header -->
            <div class="modal-header bg-warning text-black rounded-top">
                <h5 class="modal-title" id="commentModalLabel">Comments</h5>
                <button type="button" class="btn-close text-black" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><b>&times;</b></span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="text-center mb-3">
                    <h6 class="text-dark">Customer Feedback</h6>
                    <p class="text-muted small">Here are the reviews shared by our valued customers regarding this item.</p>
                </div>

                <div id="comment-modal-body" class="comment-details">
                    <!-- Dynamic comment content will go here -->
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer justify-content-center border-top-0">
                <button type="button" class="primary-btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const customerCountElements = document.querySelectorAll('.click-to-view-comments');

    customerCountElements.forEach(element => {
        element.addEventListener('click', function () {
            const menuId = this.getAttribute('data-menu-id');

            fetch(`/menu/${menuId}/comments`)
                .then(response => response.json())
                .then(data => {
                    let commentsHtml = '';

                    data.ratings.forEach(rating => {
                        // Render stars based on the rating score
                        const stars = Array(5)
                            .fill('&#9734;') // Empty star
                            .map((star, index) => index < rating.rating ? '&#9733;' : star) // Full star for rating
                            .join('');

                        commentsHtml += `
                            <div class="card mb-3">
                                <div class="card-body">
                                    <strong>${rating.user.username}</strong> 
                                    <div class="text-warning mt-2">${stars}</div>
                                    <p class="mt-2">${rating.comment}</p>
                                </div>
                            </div>
                        `;
                    });

                    // Update the modal content
                    document.getElementById('comment-modal-body').innerHTML = commentsHtml || '<p class="text-center text-muted">No comments yet.</p>';
                })
                .catch(error => {
                    console.error('Error loading comments:', error);
                    document.getElementById('comment-modal-body').innerHTML = '<p class="text-center text-muted">Failed to load comments.</p>';
                });
        });
    });
});


</script>


<script>
    // Toggle modal display when image is clicked
    function toggleModal(image) {
        const modal = image.nextElementSibling;
        modal.style.display = modal.style.display === 'flex' ? 'none' : 'flex';
    }

    // Close modal when clicking outside the full-size image
    function closeModal(event) {
        if (event.target.classList.contains('modal')) {
            event.target.style.display = 'none';
        }
    }
</script>
</section>
@endsection