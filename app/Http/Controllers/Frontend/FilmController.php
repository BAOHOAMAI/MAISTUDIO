<?php

namespace App\Http\Controllers\Frontend;
use App\Models\Genre;
use App\Models\Rating;
use App\Models\Comment;
use App\Models\Favourite;
use App\Models\Movie;
use App\Models\Episode;
use App\Models\Category;
use App\Models\Movie_Genre;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Requests\CommentRequest;
use DB;
class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getFilm($slug)
    {
        $genre = Genre::orderBy('id','ASC')->get();
        $category = Category::orderBy('id','ASC')->get();
        $movie = Movie::with('category','genre','movie_genre')->where('slug',$slug)->first();
        $related = Movie::with('category','genre')->where('genre_id',$movie->genre->id)->orderBy(DB::raw('RAND()'))->whereNotIn('slug',[$slug])->get();
        $firstep = Episode::with('movie')->where('movie_id',$movie->id)->orderBy('episode_num','ASC')->first();
        $episode_list = Episode::where('movie_id',$movie->id)->get();
        $episode_list_count = $episode_list->count();
        $comments = Comment::with('movie')->where('movie_id', $movie->id)->where('level','=',0)->orderBy('comment_id','DESC')->paginate(5);
        $replay = Comment::with('movie')->where('movie_id', $movie->id)->get();
        $rating = Rating::with('movie')->where('movie_id', $movie->id)
                         ->where('user_id', Auth::id())
                         ->first();
        $rate = Rating::with('movie')->where('movie_id',$movie->id)->get();
        $avgRate = Rating::with('movie')->where('movie_id',$movie->id)->avg('rate');
        $reviews = Rating::with('movie')->where('movie_id',$movie->id)->get()->count();
        $roundRate = round($avgRate);
        $favourite = Favourite::with('movie')->where('movie_id', $movie->id)
                         ->where('user_id', Auth::id())
                         ->first();
        return view('Frontend.film.filmDetail',compact('genre','movie','related','category','firstep','episode_list_count','comments','replay','rating','roundRate','reviews','rate','favourite'));
    } 

    /**
     * Show the form for creating a new resource.
     */
    public function filmWatch($slug, $ep)
    {   

        if(isset($tap)) {
            $tap = $ep ;
        } else {
            $tap = 1;
        }
        $tap = substr($ep,3,20);
        $seasonslug = substr($slug,0,5);
        $genre = Genre::orderBy('id','ASC')->get();
        $category = Category::orderBy('id','ASC')->get();
        $movie = Movie::with('category','genre','movie_genre','episode')->where('slug',$slug)->first();
        $season = Movie::with('category','genre','movie_genre','episode')->where('slug','LIKE',"%{$seasonslug}%")->get();
        $comments = Comment::with('movie')->where('movie_id', $movie->id)->where('level','=',0)->orderBy('comment_id','DESC')->paginate(5);
        $replay = Comment::with('movie')->where('movie_id', $movie->id)->get();
        // return response()->json($season);
        $related = Movie::with('category','genre')->where('genre_id',$movie->genre->id)->orderBy(DB::raw('RAND()'))->whereNotIn('slug',[$slug])->get();
        $episode = Episode::where('movie_id',$movie->id)->where('episode_num',$tap)->first();
        $rating = Rating::with('movie')->where('movie_id', $movie->id)
                         ->where('user_id', Auth::id())
                         ->first();
        $rate = Rating::with('movie')->where('movie_id',$movie->id)->get();
        return view('Frontend.film.film',compact('genre','category','movie','related','episode','season','comments','replay','rating','rate'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function fetch_data(Request $request, $slug)
    {
        $movie = Movie::with('category', 'genre', 'movie_genre')->where('slug', $slug)->first();
        $comments = Comment::with('movie')->where('movie_id', $movie->id)->where('level','=',0)->orderBy('comment_id','DESC')->paginate(5);
        $replay = Comment::with('movie')->where('movie_id', $movie->id)->get();
        $replies = Comment::with('movie')->where('movie_id', $movie->id)->get();
        $rate = Rating::with('movie')->where('movie_id',$movie->id)->get();

        if ($request->ajax()) {
            return view('Frontend.film.pagination_data', compact('comments','replay','rate'));
        }
    }




    /**
     * Show the form for editing the specified resource.
     */
    public function fetch_data_comment(Request $request, $slug, $ep)
    {
        $movie = Movie::with('category', 'genre', 'movie_genre')->where('slug', $slug)->first();
        $comments = Comment::with('movie')->where('movie_id', $movie->id)->where('level','=',0)->orderBy('comment_id','DESC')->paginate(5);
        $replay = Comment::with('movie')->where('movie_id', $movie->id)->get();
        $replies = Comment::with('movie')->where('movie_id', $movie->id)->get();
        $rate = Rating::with('movie')->where('movie_id',$movie->id)->get();

        if ($request->ajax()) {
            return view('Frontend.film.pagination_data', compact('comments','replay','rate'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function sendcomment(Request $request)
    {
       $comment_text = $request->comment_text;
       $comment_movie_id = $request->comment_movie_id;
       $comment_level = $request->comment_level;
       $comment_replies_name = $request->comment_replies_name_data;
       $comment = new Comment();
       $ngayThangNam = Carbon::today()->toDateString();
            if ($request->comment_level) {
       $comment->level= $comment_level ;
            }
       $comment->comment = $comment_text;
       $comment->comment_name = Auth::user()->name;
       $comment->replies = $comment_replies_name;
       $comment->comment_avarta = Auth::user()->avarta;
       $comment->comment_date = $ngayThangNam ;
       $comment->movie_id = $comment_movie_id ;
       $comment->comment_user_id = Auth::id() ;
       $comment->save();


    }

    /**
     * Remove the specified resource from storage.
     */
    public function rating(Request $request)
    {   
        $rated = $request->rated;
        $movie_id = $request->movie_id;
        $user_id = $request->user_id;

        $existingRating = Rating::where('movie_id', $movie_id)
                                 ->where('user_id', $user_id)
                                 ->first();

        if ($existingRating) {
            $existingRating->rate = $rated;
            $existingRating->save();
        } else {
            $rating = new Rating();
            $rating->rate = $rated;
            $rating->movie_id = $movie_id;
            $rating->user_id = $user_id;
            $rating->save();
        }
        
    }
}
