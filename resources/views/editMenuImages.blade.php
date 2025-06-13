@extends(( auth()->user()->role == 'customer' ) ? 'layouts.app' : 'layouts.backend' )


@section('bodyID')
{{ 'menu' }}@endsection

@section('navTheme')
{{ 'light' }}@endsection

@section('logoFileName')
{{ URL::asset('/images/Black Logo.png') }}
@endsection

@section('content')
<style>
.menu-title{
    text-align: center;
    font-style: italic;
    color: black;
    font-size: 20px;
}

.gradient-hr {
    border: none; /* Remove default border */
    height: 4px; /* Adjust height as needed */
    background: linear-gradient(to right, #000000, #FF8C00, #dc3545); /* Black to dark orange to danger red */
    border-radius: 8px;
}

</style>
<br>
<br>
<br>
<br>
<br>
    <div class="container">
        <div class="flex-center min-vh-80">
    <table class="table table-hover">
        <div class="col-12 pt-3 h-100 shadow rounded bg-white ">
            <h6 class="d-flex justify-content-center menu-title ">IMAGE</h2>
            <br>
        </div>
    </table>
    </div>
    <table class="table table-hover">
         <hr class="my-4 gradient-hr">
        <div class="col-12 pt-3 h-100 shadow rounded bg-white ">
    <form method="post" action="{{ route('updateMenuImages') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="menuID" value="{{ $menu['id'] }}">

        <div class="mb-2 px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
            <label for="formFile" class="form-label">Item Image (Only png, jpg, jpeg)</label>
             <label for="formFile" class="form-label">Max Size: 10MB</label>
           <span class="input-group-text alert-warning"> <i class="fas fa-camera">&nbsp;&nbsp;&nbsp;</i> 
           <input name="menuImage" class="form-control" type="file" id="item-image" required></span>
        </div>

        
        <div class="dropdown-divider"></div>

        <div class="row">
            <div  class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                <button type="submit" class="btn btn-outline-success">Save Changes</button>
                <a href="{{ url()->previous() }}"><button type="button" class="btn btn-outline-danger">Back</button></a>
            </div>
        </div>
    </form>
    </div>
      <hr class="my-4 gradient-hr">
    </table>
</div>
@endsection