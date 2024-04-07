@extends('frontend.layout.main')

@section ('content')

    <div class="main_top_film">
        <div class="top_film_header">
            <div class="top_title">TOP</div>
            <div class="top_sub_title">FILM OF ALL </div>
            <div class="top_select_list">
              <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="pills-top-all" data-bs-toggle="pill" data-bs-target="#top-all" type="button" role="tab" aria-controls="pills-home" aria-selected="true">All</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#top-rated" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Rated</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#top-movies" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Movies</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#top-series" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Series</button>
                </li>
              </ul>
            </div>
        </div>
        <div class="top_film_container">
          <div class="top_film_list">
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="top-all" role="tabpanel" aria-labelledby="pills-top-all">
                @foreach($topall as $key => $all)
                <div class="top_item" style="background-image: url('{{asset('uploads/movie_thumb/'.$all->image_thumb)}}')">
                  <div class="top_item_rank">
                    @if($key < 9)
                      0{{$key+1}}
                      @else{{$key+1}}
                    @endif</div>
                  <div class="top_item_name"><a href="{{route('film',$all->slug)}}">{{$all->title}}</a></div>
                </div>
                @endforeach
              </div>
              <div class="tab-pane fade" id="top-rated" role="tabpanel" aria-labelledby="pills-profile-tab">
                @foreach($toprated as $key => $rated)
                <div class="top_item" style="background-image: url('{{asset('uploads/movie_thumb/'.$rated->image_thumb)}}')">
                  <div class="top_item_rank">
                    @if($key < 9)
                    0{{$key+1}}
                    @else{{$key+1}}
                    @endif</div>
                  <div class="top_item_name"><a href="{{route('film',$rated->slug)}}">{{$rated->title}}</a></div>
                </div>
                @endforeach
              </div>
              <div class="tab-pane fade" id="top-movies" role="tabpanel" aria-labelledby="pills-contact-tab">
                @foreach($topmovie as $key => $mov)
                <div class="top_item" style="background-image: url('{{asset('uploads/movie_thumb/'.$mov->image_thumb)}}')">
                  <div class="top_item_rank">
                    @if($key < 9)
                    0{{$key+1}}
                    @else{{$key+1}}
                    @endif</div>
                  <div class="top_item_name"><a href="{{route('film',$mov->slug)}}">{{$mov->title}}</a></div>
                </div>
                @endforeach
              </div>
              <div class="tab-pane fade" id="top-series" role="tabpanel" ari
              a-labelledby="pills-contact-tab">
                @foreach($topseries as $key => $ser)
                <div class="top_item" style="background-image: url('{{asset('uploads/movie_thumb/'.$ser->image_thumb)}}')">
                  <div class="top_item_rank">
                    @if($key < 9)
                    0{{$key+1}}
                    @else{{$key+1}}
                    @endif</div>
                  <div class="top_item_name"><a href="{{route('film',$ser->slug)}}">{{$ser->title}}</a></div>
                </div>
                @endforeach
              </div>
            </div>
        </div>
    </div>

@endsection
