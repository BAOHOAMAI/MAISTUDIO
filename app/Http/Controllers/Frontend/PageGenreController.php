<?php

namespace App\Http\Controllers\Frontend;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Movie_Genre;

class PageGenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getCategory()
    {
        $movie = Movie::orderBy('ngaycapnhat','DESC')->paginate(12);
        $genre = Genre::orderBy('id','ASC')->get();
        $category = Category::orderBy('id','ASC')->get();
        return view('Frontend.category.category',compact('genre','movie','category'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function categorySelect($slug)
    {
        $genre = Genre::orderBy('id','ASC')->get();
        $category = Category::orderBy('id','ASC')->get();
        $genre_slug = Genre::where('slug',$slug)->first();
        $multi_genre = [];
        $movie_genre = Movie_Genre::where('genre_id' , $genre_slug->id)->get();
        foreach( $movie_genre as $key => $movi ) {
            $multi_genre[]=$movi->movie_id;
        }
        $movie = Movie::whereIn('id',$multi_genre)->orderBy('ngaycapnhat','DESC')->paginate(12);
         return view('Frontend.category.categorySelect',compact('genre','genre_slug','movie','category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function genreSelect($slug)
    {
        $genre = Genre::orderBy('id','ASC')->get();
        $category = Category::orderBy('id','ASC')->get();
        $category_slug = Category::where('slug',$slug)->first();
        $movie = Movie::where('category_id',$category_slug->id)->orderBy('ngaycapnhat','DESC')->paginate(12);
        return view('Frontend.category.category',compact('category','category_slug','movie','genre'));
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
