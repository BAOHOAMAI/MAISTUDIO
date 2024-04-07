<?php

namespace App\Http\Controllers\Frontend;
use App\Models\Genre;
use App\Models\Favourite;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class FavouriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getFavourite()
    {
        $genre = Genre::orderBy('id','ASC')->get();
         $favourite = Favourite::with('movie')
                         ->where('user_id', Auth::id())
                         ->paginate(5);
        $category = Category::orderBy('id','ASC')->get();
        return view('Frontend.account.favourite',compact('genre','category','favourite'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function addFavourite(Request $request)
    {
        $movie_id = $request->movie_id;
        $user_id = $request->user_id;
        $ngayThangNam = Carbon::today()->toDateString();
        $favourite = new Favourite();

        $favourite->movie_id = $movie_id;
        $favourite->user_id = $user_id;
        $favourite->date_create = $ngayThangNam;
        $favourite->save();  
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function filterFav(Request $request)
    {
        $genre = Genre::orderBy('id','ASC')->get();
        $category = Category::orderBy('id','ASC')->get();
         if ($request->filled('sort')) {
            if ($request->sort == 1) {
               $favourite = Favourite::where('user_id',Auth::id())->latest('date_create')->paginate(5);
            }
            if ($request->sort == 2) {
              $favourite = Favourite::where('user_id',Auth::id())->oldest('date_create')->paginate(5);
            }
        }
        return view('Frontend.account.favourite',compact('genre','category','favourite'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {   
    $id = $request->fav_id;
    
    if ($id) {
        $favourite = Favourite::find($id);

        if ($favourite) {
            $favourite->delete();
        } 
    } else {
            Favourite::where('user_id',Auth::id())->delete();
        }
    }
}
