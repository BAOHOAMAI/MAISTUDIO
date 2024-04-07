<?php

namespace App\Http\Controllers\Frontend;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Movie_Genre;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getSearch()
    {     
        $genre = Genre::orderBy('id','ASC')->get();
        $category = Category::all();
        return view('Frontend.search.search',compact('genre','category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function postSearch(Request $request)
    { 

        $data = $request->all();

        if ($request->has('name')) {
            $name = $request->name;
            $movie = Movie::where('title','LIKE',"%{$name}%")->get();
        } 

        return $movie;

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
    public function filterSearch(Request $request)
    {
        $genre = Genre::orderBy('id','ASC')->get();
        $category = Category::all();
        $query = Movie::query();
       
        if ($request->filled('genre')) {
            $multi_genre = [];
            $movie_genre = Movie_Genre::where('genre_id' , $request->genre)->get();
            foreach( $movie_genre as $key => $movi ) {
                $multi_genre[]=$movi->movie_id;
            }
            $query->whereIn('id',$multi_genre)->orderBy('ngaycapnhat','DESC')->paginate(12);
        }
        
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('status')) {
            if ($request->status == 1) {
               $query->latest('ngaycapnhat');
            }
            if ($request->status == 2) {
               $query->oldest('ngaycapnhat');
            }
        }

        $data = $query->orderBy('id')->get();

        return view('frontend.search.search', compact('data','genre','category'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
