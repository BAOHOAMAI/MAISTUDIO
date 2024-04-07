<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Movie;
use Carbon\Carbon;

class LeechMovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resp = Http::get("https://ophim1.com/danh-sach/phim-moi-cap-nhat?page=1")->json();
        return view('admin.leech.index',compact('resp'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function leech_detail($slug)
    {
        $resp = Http::get("https://ophim1.com/phim/".$slug)->json();
        $resp_movie[] = $resp['movie'];
        return view('admin.leech.leech_detail',compact('resp_movie'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function leech_add(Request $request,$slug)
    {
        $resp = Http::get("https://ophim1.com/phim/".$slug)->json();
        $resp_movie[] = $resp['movie'];
        
        foreach ($resp_movie as $key => $res) {

            $movie = new Movie();
            $movie->title = $res['name'];
            $movie->slug = $res['slug']; 
            $movie->duration = $res['time']; 
            $movie->image = $res['poster_url']; 
            $movie->image_thumb = $res['thumb_url']; 
            $olddur = $res['time'];
            $newdurr = str_replace("phút/tập", "min", $olddur);
            $movie->duration = $newdurr; 
            $movie->category_id = 11; 
            $movie->genre_id = 2; 
            $movie->episode_total = $res['episode_total']; 
            $movdescrip = str_replace(['<p>', '</p>'], '', $res['content']);
            $movie->description =  $movdescrip;
            $movie->ngaytao = Carbon::now('Asia/Ho_Chi_Minh');
            $movie->ngaycapnhat = Carbon::now('Asia/Ho_Chi_Minh');
            $movie->status = 1;

            $movie->save();

        }
            return redirect()->back()->with('success','Successfully added a movie'); 

    }

     * Display the specified resource.
    /**
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
    public function getpage(Request $request)
    {
        $page = $request->page;
        $resp = Http::get("https://ophim1.com/danh-sach/phim-moi-cap-nhat?page=".$page)->json();
        return view('admin.leech.index',compact('resp'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
