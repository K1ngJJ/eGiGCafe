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
<table class="table table-hover">
    <div class="col-12 pt-3 h-100 shadow rounded bg-white ">
        <h6 class="d-flex justify-content-center menu-title ">DETAILS</h2>
        <br>
    </div>
</table>

         <hr class="my-4 gradient-hr">
<form method='post' action="{{ route('updateMenuDetails') }}" class="px-4 py-3" style="min-width: 350px">
    @csrf
    <input name="menuID" type="hidden" value="{{ $menu['id'] }}">

    <div class="mb-2">
        <label for="ItemType" class="form-label">Item Type</label>
        <div class="input-group mb-3">
            <label class="input-group-text" for="itemTypeInputGroup">Type:</label>
            <select name="menuType" class="form-select" id="itemTypeInputGroup" >
                <option selected>{{ $menu['type'] }}</option>
                <option name="menuType" value="Silog">Silog</option>
                <option name="menuType" value="Sandwich">Sandwich</option>
                <option name="menuType" value="Burger">Burger</option>
                <option name="menuType" value="Pasta">Pasta</option>
                <option name="menuType" value="Snacks">Snacks</option>
                <option name="menuType" value="Milk Tea">Milk Tea</option>
                <option name="menuType" value="Fruit Tea">Fruit Tea</option>
                <option name="menuType" value="Etc.">Etc.</option>
            </select>
        </div>
    </div>
    
    {{-- Para sa pagtanggal ng double choices kapag naselect na yung option keneme di na lalabas ulit, wag mo tanggalin king --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        var selectedOption = "{{ $menu['type'] }}";
        $("#itemTypeInputGroup option[value='" + selectedOption + "']").hide();
    });
    </script>

    <div class="dropdown-divider"></div>

    <div class="mb-1">
        <label for="ItemName" class="form-label">Item Name</label>
        <div class="input-group mb-3">
            <input name="menuName" type="text" class="form-control" placeholder="Name" aria-label="Item Name" value="{{ $menu['name'] }}" required>
        </div>
    </div>

    <div class="dropdown-divider"></div>

    <div class="mb-1">
        <label for="ItemPrice" class="form-label">Item Price</label>
        <div class="input-group mb-3">
            <span class="input-group-text">₱</span>
            <input name="menuPrice" type="number" min=0 step=0.01 class="form-control price-class" class="form-control" placeholder="Price" aria-label="Item Price" value="{{ $menu['price'] }}" required>
            <span class="validity"></span>
        </div>
    </div>

    <div class="dropdown-divider"></div>

    <div class="mb-1">
        <label for="ItemCost" class="form-label">Item Estimated Cost</label>
        <div class="input-group mb-3">
            <span class="input-group-text">₱</span>
            <input name="menuEstCost" type="number" min=0 step=0.01 class="form-control price-class" class="form-control" placeholder="Cost" aria-label="Item Cost" value="{{ $menu['estCost'] }}" required>
            <span class="validity"></span>
        </div>
    </div>

    <div class="dropdown-divider"></div>

    <div class="mb-1">
        <label for="ItemDescription" class="form-label">Item Description</label>
        <div class="input-group mb-3">
            <textarea name="menuDescription" class="form-control" placeholder="Description" aria-label="Item Description" required>{{ $menu['description'] }}</textarea>
        </div>
    </div>

    <div class="dropdown-divider"></div>
    
    <div class="mb-2">
        <label for="ItemSize" class="form-label">Portion</label>
        <div class="input-group mb-3">
            <label class="input-group-text" for="itemSizeInputGroup">Size:</label>
            <select name="menuSize" class="form-select" id="itemSizeInputGroup">
                <option selected>{{ $menu->size }}</option>
                @if($menu['size'] == "1-2")
                @else
                    <option name="menuSize" value="1-2">1 - 2 People</option>
                @endif
                @if($menu['size'] == "3-4")
                @else
                    <option name="menuSize" value="3-4">3 - 4 People</option>
                @endif
                @if($menu['size'] == ">5")
                @else
                    <option name="menuSize" value=">5">>5 People</option>
                @endif
            </select>
        </div>
    </div>

    <div class="dropdown-divider"></div>

    <div class="mb-1">
        <label for="SpecialCondition" class="form-label">Special Condition</label>
        <div class="form-check">
            <input name="menuAllergic" type="hidden" value=0>

            @if( $menu['allergic'] == 1)
            <label class="form-check-label active" for="dropdownCheck">
                <input name='menuAllergic' value=1 type="checkbox" class="form-check-input" id="dropdownCheck" checked="checked">Allergic
            </label>
            @else
            <input name='menuAllergic' value=1 type="checkbox" class="form-check-input" id="dropdownCheck">
            <label class="form-check-label" for="dropdownCheck">
            Allergic
            </label>
            @endif
        </div>
        <div class="form-check">
            <input name="menuVegetarian" type="hidden" value=0>

            @if( $menu['vegetarian'] == 1)
            <label class="form-check-label active" for="dropdownCheck">
                <input name='menuVegetarian' value=1 type="checkbox" class="form-check-input" id="dropdownCheck" checked="checked">Vegetarian
            </label>
            @else
            <input name='menuVegetarian' value=1 type="checkbox" class="form-check-input" id="dropdownCheck">
            <label class="form-check-label" for="dropdownCheck">
            Vegetarian
            </label>
            @endif
        </div>
        <div class="form-check">
            <input name="menuVegan" type="hidden" value=0>
        
            @if( $menu['vegan'] == 1)
            <label class="form-check-label active" for="dropdownCheck">
                <input name='menuVegan' value=1 type="checkbox" class="form-check-input" id="dropdownCheck" checked="checked">Vegan
            </label>
            @else
            <input name='menuVegan' value=1 type="checkbox" class="form-check-input" id="dropdownCheck">
            <label class="form-check-label" for="dropdownCheck">
            Vegan
            </label>
            @endif
        </div>
    </div>

    <div class="dropdown-divider"></div>
    <div class="row">
        <div>
            <button type="submit" class="btn btn-outline-success">Save Changes</button>
            <a href={{ url()->previous() }}><button type="button" class="btn btn-outline-danger">Back</button></a>
        </div>
    </div>
</form>
  <hr class="my-4 gradient-hr">
@endsection