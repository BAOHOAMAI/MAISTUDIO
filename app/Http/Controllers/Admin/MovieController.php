<?php

namespace App\Http\Controllers\Admin;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Episode;
use App\Models\Movie_Genre;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\MovieRequest;
use File;
class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Movie::with('category','genre','movie_genre','episode')->withCount('episode')->orderBy('id','DESC')->get();
        $destinationPath = public_path()."/json_movie/";

        if (!is_dir($destinationPath)) {
            mkdir($destinationPath,0777,true);
        }
        File::put($destinationPath.'movie.json',json_encode($list));
        return view ('admin.movie.index' , compact('list'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category= Category::all();
        $genre= Genre::all();

        return view ('admin.movie.form' , compact('category','genre'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MovieRequest $request)
    {   
        $data = $request->all();

        $movie = new Movie();
        $movie->title = $data['title'];
        $movie->slug = $data['slug']; 
        $movie->duration = $data['duration']; 
        $movie->episode_total = $data['episode']; 
        $movie->rated = $data['rated']; 
        $movie->user_rated = $data['user_rated']; 
        $movie->trailer_title = $data['trailer_title']; 
        $movie->trailer_link = $data['trailer_link']; 
        $movie->description = $data['description'];
        $movie->category_id = $data['category_id'];
        foreach ($data['genre'] as $key => $gen) {
         $movie->genre_id = $data['genre'][0];
        }
        $movie->ngaytao = Carbon::now('Asia/Ho_Chi_Minh');
        $movie->ngaycapnhat = Carbon::now('Asia/Ho_Chi_Minh');
        $movie->status = $data['status'];


        $get_image = $request->file('image');
        $get_image_thumb = $request->file('image_thumb');

        if($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/movie/',$new_image);
            $movie->image=$new_image;
        }

        if($get_image_thumb) {
            $get_name_image_thumb = $get_image_thumb->getClientOriginalName();
            $name_image_thumb = current(explode('.', $get_name_image_thumb));
            $new_image_thumb = $name_image.rand(0,999).'.'.$get_image_thumb->getClientOriginalExtension();
            $get_image_thumb->move('uploads/movie_thumb/',$new_image_thumb);
            $movie->image_thumb=$new_image_thumb;
        }
        $movie->save();
        // Thêm nhiều thể loại phim 

        $movie->movie_genre()->attach($data['genre']); 
        return redirect()->back()->with('success','Successfully added a movie'); 
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
        $movie = Movie::find($id);
        $list = Movie::with('category','genre')->orderBy('id','DESC')->get();
        $category= Category::all();
        $genre= Genre::all();
        $movie_genre = $movie->movie_genre;
        return view ('admin.movie.form' , compact('list','category','genre','movie','movie_genre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MovieRequest $request, string $id)
    {
        $data = $request->all();
        $movie = Movie::find($id);
        $movie->title = $data['title'];
        $movie->slug = $data['slug']; 
        $movie->duration = $data['duration']; 
        $movie->episode_total = $data['episode']; 
        $movie->rated = $data['rated']; 
        $movie->user_rated = $data['user_rated']; 
        $movie->trailer_title = $data['trailer_title']; 
        $movie->trailer_link = $data['trailer_link']; 
        $movie->description = $data['description'];
        $movie->category_id = $data['category_id'];      
        $movie->ngaycapnhat = Carbon::now('Asia/Ho_Chi_Minh');
        $movie->status = $data['status'];


        $get_image = $request->file('image');
        $get_image_thumb = $request->file('image_thumb');

        if($get_image) {

            if (file_exists('uploads/movie/'.$movie->image)) {
                unlink('uploads/movie/'.$movie->image);

            } else {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/movie/',$new_image);
            $movie->image=$new_image;
            }
        }

        if($get_image_thumb) {
            if (file_exists('uploads/movie_thumb/'.$movie->image_thumb)) {
                unlink('uploads/movie_thumb/'.$movie->image_thumb);
            } else {
            $get_name_image_thumb = $get_image_thumb->getClientOriginalName();
            $name_image_thumb = current(explode('.', $get_name_image_thumb));
            $new_image_thumb = $name_image_thumb.rand(0,999).'.'.$get_image_thumb->getClientOriginalExtension();
            $get_image_thumb->move('uploads/movie_thumb/',$new_image_thumb);
            $movie->image_thumb=$new_image_thumb;
            }
        }

        foreach ($data['genre'] as $key => $gen) {
         $movie->genre_id = $data['genre'][0];
        }
        $movie->save();

        $movie->movie_genre()->sync($data['genre']); 

        return redirect()->back()->with('success','Successfully edit '); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $movie = Movie::find($id);
        if (!empty($movie->image)) {
            unlink('uploads/movie/'.$movie->image);
        }
        
        if (!empty($movie->image_thumb)) {
            unlink('uploads/movie_thumb/'.$movie->image_thumb);
        }

        $moviedel = Movie_Genre::whereIn('movie_id',[$movie->id])->delete();
        $epdel = Episode::whereIn('movie_id',[$movie->id])->delete();

        $movie->delete();
        return redirect()->back()->with('success','Successfully delete'); 
    }
}
