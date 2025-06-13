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

.custom-file-upload {
    width: 100%;
    border: 2px solid #ccc;
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
    border-radius: 5px;
}

.custom-file-upload:hover {
    background-color: #f0f0f0;
}

.custom-file-upload i {
    margin-right: 5px;
}

.gradient-hr {
    border: none; /* Remove default border */
    height: 4px; /* Adjust height as needed */
    background: linear-gradient(to right, #000000, #FF8C00, #dc3545); /* Black to dark orange to danger red */
    border-radius: 8px;
}
</style>

<style>
    /* Center image container */
    .flex-center {
        display: flex;
        justify-content: center;
        align-items: center;
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
function previewImage(input) {
    console.log("Preview image function called");
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#image-preview').attr('src', e.target.result).show();
        }

        reader.readAsDataURL(input.files[0]); 
    } else {
        $('#image-preview').hide();
    }
}
</script>

@if (Auth::check() && auth()->user()->role == 'admin')
<section class="menu" style="margin-top: 15vh;">
@else
<section class="menu" style="margin-top: 20vh;">
@endif
    <div class="container">
    <table class="table table-hover ">
        <div class="col-12 pt-3 h-100 shadow rounded bg-white ">
        <h6 class="d-flex justify-content-center menu-title">GALLERY</h2>
            <br>
        </div>
        </table>
        @if (session('success'))
        <div class="alert alert-success fixed-bottom" role="alert" style="width:500px;left:30px;bottom:20px">
            {{ session('success') }}
        </div>
        @endif
        <table class="table table-hover">
        <div class="col-12 pt-1">
        <div class="row menu-bar">
        <hr class="my-2 gradient-hr">
        @if (Auth::check() && auth()->user()->role != 'customer')
        <div class="d-flex justify-content-center">    
            <div class="col-md-1 d-flex align-items-center">
            <div class="d-flex">
                <a class="my-md-1 px-3 py-2 bg-red-500 btn-sm primary-btn flex-md-row flex-column justify-content-md-between me-2" href="{{ route('discount') }}">
                    <i class="fa fa-ticket" style="font-size: 17px;"></i>
                    <!--span>Discount</span-->
                </a>
                <a class="my-md-1 px-3 py-2 bg-red-500 btn-sm primary-btn flex-md-row flex-column justify-content-md-between me-2" href="{{ route('kitchenOrder') }}">
                    <i class="fa fa-shopping-cart" style="font-size: 17px;"></i>
                    <!--span>Order</span-->
                </a>
            </div>
                <div class="dropstart">    
                    <button type="button" class="btn btn-success" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" id="filter-button">
                        <i class="fa fa-plus" aria-hidden="true"></i></i>
                    </button>
                    <div class="dropdown-menu p-3" style="width: 80%; max-width: 300px; min-width: 200px;">

                        <form method='post' action="{{ route('saveImage') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-1">
                                <label for="category" class="form-label">Event</label>
                                <div class="input-group mb-3">
                                    <select name="category" class="form-select" aria-label="Category" required>
                                    <option value="" disabled selected>Select Event</option>
                                        @foreach ($services as $service)
                                            <option value="{{ $service->name }}">{{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="input-group mb-3">
                                    <input id="image-upload-input" type="file" name="image" accept="image/*" required style="display: none;" onchange="previewImage(this)">
                                    <label for="image-upload-input" class="custom-file-upload">
                                        <i class="fas fa-camera"></i> Choose Image
                                    </label>
                                </div>

                                <img id="image-preview" class="card-img-top menuImage" src="#" alt="Image Preview" style="display: none;">
                                </div>

                            <div class="dropdown-divider"></div>

                            <button type="submit" class="btn btn-outline-success">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        @endif
        @if (Auth::check() && auth()->user()->role != 'customer')
       <div class="col-md-9 text-center">
            <form method="get" action="{{ route('filterGallery') }}" class="d-flex flex-wrap justify-content-center">
                @foreach ($services as $service)
                    <button type="submit" name="galleryType" value="{{ $service->name }}" class="btn btn-light menu-type-button">{{ $service->name }}</button>
                @endforeach
            </form>
            </div>
        @else
          <div class="col-md-12 text-center">
            <form method="get" action="{{ route('filterGallery') }}"  class="d-flex flex-wrap justify-content-center">
                @foreach ($services as $service)
                    <button type="submit" name="galleryType" value="{{ $service->name }}" class="btn btn-light menu-type-button">{{ $service->name }}</button>
                @endforeach
            </form>
            </div>
        @endif
        <hr class="my-2 gradient-hr">
          @if (Auth::check() && auth()->user()->role != 'customer')
                <div class="col-md-1 d-flex align-items-center">
                    <div class="dropstart w-100 d-flex justify-content-end">
                        <!-- Filter Button -->
                        <button type="button" class="btn btn-dark" data-bs-toggle="dropdown" aria-expanded="false" id="filter-button" aria-label="Filter options">
                            <i class="fa fa-filter" aria-hidden="true"></i>
                        </button>
                
                        <!-- Dropdown Menu -->
                        <div class="dropdown-menu p-3" style="width: 80%; max-width: 300px; min-width: 200px;">
                            <form method="get" action="{{ route('filterGallery') }}">
                                <!-- Item Type Selection -->
                                <div class="mb-3">
                                    <label for="itemTypeInputGroup" class="form-label">Item Type</label>
                                    <div class="input-group">
                                        <label class="input-group-text" for="itemTypeInputGroup">Type:</label>
                                        <select name="galleryType" class="form-select" id="itemTypeInputGroup">
                                            <option value="">All</option>
                                            <option value="Wedding">Wedding</option>
                                            <option value="Birthday">Birthday</option>
                                        </select>
                                    </div>
                                </div>
                
                                <div class="dropdown-divider"></div>
                
                                <!-- Filter Button -->
                                <button type="submit" class="btn btn-outline-dark w-100">Apply Filter</button>
                            </form>
                        </div>
                    </div>
                </div>
                  @else
                   <div class="col-md-12 d-flex align-items-center">
                    <div class="dropstart w-100 d-flex justify-content-end">
                        <!-- Filter Button -->
                        <button type="button" class="btn btn-dark" data-bs-toggle="dropdown" aria-expanded="false" id="filter-button" aria-label="Filter options">
                            <i class="fa fa-filter" aria-hidden="true"></i>
                        </button>
                
                        <!-- Dropdown Menu -->
                        <div class="dropdown-menu p-3" style="width: 80%; max-width: 300px; min-width: 200px;">
                            <form method="get" action="{{ route('filterGallery') }}">
                                <!-- Item Type Selection -->
                                <div class="mb-3">
                                    <label for="itemTypeInputGroup" class="form-label">Item Type</label>
                                    <div class="input-group">
                                        <label class="input-group-text" for="itemTypeInputGroup">Type:</label>
                                        <select name="galleryType" class="form-select" id="itemTypeInputGroup">
                                            <option value="">All</option>
                                            <option value="Wedding">Wedding</option>
                                            <option value="Birthday">Birthday</option>
                                        </select>
                                    </div>
                                </div>
                
                                <div class="dropdown-divider"></div>
                
                                <!-- Filter Button -->
                                <button type="submit" class="btn btn-outline-dark w-100">Apply Filter</button>
                            </form>
                        </div>
                    </div>
                </div>
                  @endif
            </div>
        </div>
</table>
        
<div class="d-flex flex-wrap mt-4 mb-5">
       @forelse ($galleries as $gallery)
    <div class="card col-md-3 col-6 d-flex align-items-center">
        <div class="card-body w-100">
 
        <div class="flex-center">
            <!-- Image Thumbnail -->
            <img class="card-img-top menuImage" src="{{ asset('galleryImages/' . $gallery->image) }}" alt="Gallery Image" onclick="toggleModal(this)">

            <!-- Modal for Preview -->
            <div class="modal" onclick="closeModal(event)">
                <img src="{{ asset('galleryImages/' . $gallery->image) }}" alt="Full-size Gallery Image">
            </div>
        </div>
            <form class="d-flex flex-column justify-content-between h-100" action="" method="post">
                @csrf
               @if (Auth::check() && auth()->user()->role != 'customer')
                        <div class="dropdown w-100 mt-3">
                            <a href="#" role="button" id="dropdownMenuLink" 
                                data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                <button class="primary-btn w-100">Edit</button>
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="{{ route('showGalleryImages', ['id' => $gallery->id]) }}">Edit Image</a></li>
                                <li><a class="dropdown-item" href="{{ route('deleteImage', ['id' => $gallery->id]) }}">Delete</a></li>
                            </ul>
                        </div>
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
    </div>
</section>
@endsection

