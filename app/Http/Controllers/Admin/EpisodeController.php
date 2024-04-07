<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Movie_Genre;
use App\Models\Movie;
use App\Models\Episode;
use App\Http\Requests\Admin\EpisodeRequest;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Episode::with('movie')->orderBy('id','DESC')->get();

        return view ('admin.episode.index' , compact('list'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list = Movie::orderBy('id','DESC')->get();
        return view ('admin.episode.form' , compact('list'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EpisodeRequest $request)
    {
        $data = $request->all();
        $episode = new Episode();
        $episode->movie_id = $data['film']; 
        $episode->link = $data['link-film']; 
        $episode->episode_num = $data['episode']; 
        $episode->episode_title = $data['episode_title']; 


        $get_image_thumb = $request->file('episode_thumb');

        if($get_image_thumb) {
            $get_name_image = $get_image_thumb->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,999).'.'.$get_image_thumb->getClientOriginalExtension();
            $get_image_thumb->move('uploads/episode_thumb/',$new_image);
            $episode->episode_thumb = $new_image;
        }

        $episode->save();
        return redirect()->back()->with('success','Successfully added a episode'); 
    }

    /**
     * Display the specified resource.
     */
    public function add_episode(string $id)
    {
        $list = Episode::with('movie')->where('movie_id',$id)->orderBy('id','DESC')->get();
        $movie = Movie::find($id);
        return view ('admin.movie.add_episode' , compact('list','movie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $episode  = Episode::find($id);
        $list = Movie::all();
        return view ('admin.episode.form' , compact('episode','list'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EpisodeRequest $request, string $id)
    {
        $data = $request->all();
        $episode = Episode::find($id);
        $episode->movie_id = $data['film']; 
        $episode->link = $data['link-film']; 
        $episode->episode_num = $data['episode']; 
        $episode->episode_title = $data['episode_title']; 


        $get_image_thumb = $request->file('episode_thumb');

        if($get_image_thumb) {
            if (file_exists('uploads/episode_thumb/'.$episode->episode_thumb)) {
                unlink('uploads/episode_thumb/'.$episode->episode_thumb);
            }
            $get_name_image = $get_image_thumb->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,999).'.'.$get_image_thumb->getClientOriginalExtension();
            $get_image_thumb->move('uploads/episode_thumb/',$new_image);
            $episode->episode_thumb = $new_image;
        }

        $episode->save();
        return redirect()->back()->with('success','Successfully edit'); 

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $episode = Episode::find($id);

        if (!empty($episode->episode_thumb)) {
            unlink('uploads/episode_thumb/'.$episode->episode_thumb);
        }

        $episode->delete();
        return redirect()->back()->with('success','Successfully delete'); 
    }
}
