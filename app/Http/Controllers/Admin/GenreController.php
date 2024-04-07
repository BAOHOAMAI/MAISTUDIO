<?php

namespace App\Http\Controllers\Admin;
use App\Models\Genre;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\GenreRequest;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list = Genre::all();
        return view ('admin.genre.form' , compact('list'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GenreRequest $request)
    {
        $data = $request->all();
        $genre = new Genre();
        $genre->title = $data['title']; 
        $genre->slug = $data['slug']; 
        $genre->description = $data['description']; 
        $genre->status = $data['status'];
        $genre->save();
        return redirect()->back()->with('success','Successfully added a genre'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $genre = Genre::find($id);
        $list = Genre::all();
        return view ('admin.genre.form' , compact('genre','list'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GenreRequest $request, $id)
    {
        $data = $request->all();
        $genre = Genre::find($id);
        $genre->title = $data['title']; 
        $genre->slug = $data['slug']; 
        $genre->description = $data['description']; 
        $genre->status = $data['status'];
        $genre->save();
        return redirect()->back()->with('success','Successfully edit '); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Genre::find($id)->delete();
        return redirect()->back()->with('success','Successfully delete '); 
    }
}
