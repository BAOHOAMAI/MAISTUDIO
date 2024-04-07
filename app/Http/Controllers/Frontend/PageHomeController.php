<?php

namespace App\Http\Controllers\Frontend;
use App\Models\Genre;
use App\Models\Category;
use App\Models\Movie;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function main()
    {
        $genre = Genre::orderBy('id','ASC')->get();
        $category = Category::orderBy('id','ASC')->get();
        $updatemovie = Movie::orderBy('ngaycapnhat','DESC')->take(10)->get();
        $trending = Movie::orderBy('user_rated', 'desc')->take(10)->get();
        $topmovie = Movie::where('category_id', '=', 11)->orderBy('user_rated', 'desc')->take(10)->get();
        $topseries = Movie::where('category_id', '=', 12)->orderBy('user_rated', 'desc')->take(10)->get();
        return view('Frontend.home.home',compact('genre','category','topseries','topmovie','updatemovie','trending'));
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
    public function store(Request $request)
    {
        //
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
