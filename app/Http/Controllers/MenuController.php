<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuRating;
use File;


class MenuController extends Controller
{
 
    public function index() {
        $layout = (Auth::check() && auth()->user()->role != 'customer') ? 'layouts.backend' : 'layouts.app';
        $menus = Menu::get();
        return view('menu', compact('menus','layout'));
    }

    /**
     * Store a newly created menu in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        if (auth()->user()->role == 'customer')
        abort(403, 'This route is only meant for restaurant staffs.');
        // Validate user inputs
        $request->validate([
            'menuName' => 'required',
            'menuDescription' => 'required',
            'menuPrice' => 'required|regex:/^\d+(\.\d{1,2})?/',
            'menuEstCost' => 'required|regex:/^\d+(\.\d{1,2})?/',
            'menuSize' => 'required',
            'menuImage' => 'required|mimes:jpg,png,jpeg|max:10240'
        ]);
        
        $newImageName = time() . '-' . $request->menuName . '.' .
        $request->menuImage->extension();
        $request->menuImage->move(public_path('menuImages'), $newImageName);

        // Create new menu item and save into database
        $newMenuItem = new Menu();
        $newMenuItem->type = $request->menuType;
        $newMenuItem->name = $request->menuName;
        $newMenuItem->description = $request->menuDescription;
        $newMenuItem->price = $request->menuPrice;
        $newMenuItem->estCost = $request->menuEstCost;
        $newMenuItem->image = $newImageName;
        $newMenuItem->size = $request->menuSize;
        $newMenuItem->allergic = $request->menuAllergic;
        $newMenuItem->vegetarian = $request->menuVegetarian;
        $newMenuItem->vegan = $request->menuVegan;
        $newMenuItem->save();
        
        return redirect('/menu/filter?menuType=');
    }

    // Display the specific menu item details fields for edit
    public function showDetails($id)
    {
        $menu = Menu::find($id);
        return view('editMenuDetails', ['menu' => $menu]);
    }

    // Display the specific menu image field for edit
    public function showImages($id)
    {
        $menu = Menu::find($id);
        return view('editMenuImages', ['menu' => $menu]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateDetails(Request $request)
    {
        if (auth()->user()->role == 'customer')
        abort(403, 'This route is only meant for restaurant staffs.');

        // Validate user inputs
        $request->validate([
            'menuName' => 'required',
            'menuDescription' => 'required',
            'menuPrice' => 'required|regex:/^\d+(\.\d{1,2})?/',
            'menuEstCost' => 'required|regex:/^\d+(\.\d{1,2})?/',
            'menuSize' => 'required',
        ]);
        
        // Update menu details
        $menu = Menu::find($request->menuID);
        $menu->type = $request->menuType;
        $menu->name = $request->menuName;
        $menu->description = $request->menuDescription;
        $menu->price = $request->menuPrice;
        $menu->estCost = $request->menuEstCost;
        $menu->size = $request->menuSize;
        $menu->allergic = $request->menuAllergic;
        $menu->vegetarian = $request->menuVegetarian;
        $menu->vegan = $request->menuVegan;
        $menu->save();

        return redirect()->route('menu');
    }

    public function updateImages(Request $request)
    {
        if (auth()->user()->role == 'customer')
        abort(403, 'This route is only meant for restaurant staffs.');

        if($request->hasFile('menuImage'))
        {
            $menu = Menu::find($request->menuID);

            // Validate user input
            $request->validate([
                'menuImage' => 'required|mimes:jpg,png,jpeg|max:10240'
            ]);
            
            // Delete the original image in the public/menuImages folder
            $imagePath = 'menuImages/' . $menu->image;

            if(File::exists($imagePath))
            {
                File::delete($imagePath);
            }


            // Save the file locally in the storage/public/ folder under a new folder named /menuImages
            $newImageName = time() . '-' . $menu->name . '.' .
            $request->menuImage->extension();

            $request->menuImage->move(public_path('menuImages'), $newImageName);


            $menu->image = $newImageName;
            $menu->save();
        }   
        return redirect()->route('menu');
    }

    // Query database according to filtering options
public function filter(Request $request)
{
    $menu = Menu::query();

    // Handle filtering by rating
    if ($request->filled('rating')) {
        $menu->whereHas('ratings', function ($query) use ($request) {
            $query->select('menu_id')
                ->groupBy('menu_id')
                ->havingRaw('AVG(rating) >= ?', [$request->rating]);
        });
    }

    // Handle filtering by menuType
    if ($request->filled('menuType')) {
        $menu->where('type', $request->menuType);
    }

    // Handle filtering by price range
    if ($request->filled('fromPrice')) {
        $menu->where('price', '>=', $request->fromPrice);
    }
    if ($request->filled('toPrice')) {
        $menu->where('price', '<=', $request->toPrice);
    }

    // Handle filtering by portion size
    if ($request->filled('menuSize')) {
        $menu->where('size', $request->menuSize);
    }

    // Handle special conditions (Allergic, Vegan, Vegetarian)
    if ($request->filled('menuVegan')) {
        $menu->where('vegan', $request->menuVegan);
    }
    if ($request->filled('menuVegetarian')) {
        $menu->where('vegetarian', $request->menuVegetarian);
    }
    if ($request->filled('menuAllergic')) {
        $menu->where('allergic', $request->menuAllergic);
    }

    // Return the filtered menus
    $menus = $menu->get();

    return view('menu', compact('menus'));
}


    /**
     * Remove the specified menu item from database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        if (auth()->user()->role == 'customer')
        abort(403, 'This route is only meant for restaurant staffs.');
        
        $menu = Menu::find($id);
        $imagePath = 'menuImages/' . $menu->image;
        // Delete the image in the public/menuImages folder
        if(File::exists($imagePath))
        {
            File::delete($imagePath);
        }

        $menu->delete();
        return redirect()->route('menu');
    }



    public function showMenu()
    {
        $menus = Menu::with('menuRatings')->get();
    
        foreach ($menus as $menu) {
            $menu->averageRating = $menu->menuRatings->avg('rating') ?? 0;
            $menu->customerCount = $menu->menuRatings->count();
            $menu->commentCount = $menu->menuRatings->whereNotNull('comment')->count(); // Ensure comment count is correct
        }
    
        return view('menu', compact('menus'));
    }
    
    

    public function getComments($menuId)
    {
        // Fetch the menu and its ratings with user data
        $menu = Menu::with(['ratings.user'])->findOrFail($menuId);
    
        // Filter ratings: only include non-null comments
        $filteredRatings = $menu->ratings->filter(function ($rating) {
            return !is_null($rating->comment) && trim($rating->comment) !== '';
        });
    
        // Return filtered ratings in JSON format
        return response()->json([
            'ratings' => $filteredRatings->map(function ($rating) {
                return [
                    'user' => $rating->user,
                    'comment' => $rating->comment,
                    'rating' => $rating->rating, // Add star rating
                    'created_at' => $rating->created_at->format('F j, Y'),
                ];
            })->values(), // Reset array keys for cleaner JSON
        ]);
    }
    
}
