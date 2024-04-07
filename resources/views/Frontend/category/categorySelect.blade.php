@extends('frontend.layout.main')

@section ('content')
    <div class="main_category">
        <div class="header_category">
            <div class="header_category_wrapper">
            <div class="header_title_pick underline"><a href="{{route('category')}}">Category </a></div>
            <div class="header_category_pick">{{$genre_slug->title}}</div>
            </div>
        </div>
        <div class="movie_grid">
          @foreach ($movie as $key => $mov)
                       @php 
            $image_check = substr($mov->image, 0, 5);
              @endphp
            <a href="{{route('film',$mov->slug)}}" class="movie_category">
              <div class="movie_card" style="background-image: url('{{ $image_check == 'https' ? $mov->image : asset('uploads/movie/'.$mov->image) }}')">
                <div class=" video-box">
                  <div class="play-btn ">
                      <i class="fa-solid fa-play"></i>
                  </div>
                </div>
              </div>
              <h3 class="movie_title">{{$mov->title}}</h3>
            </a>
          @endforeach
        </div>
        {!! $movie->links("pagination::bootstrap-4") !!}

    </div>
    <script type="text/javascript">
        $(document).ready(function() {
          // Thiết lập transform cho các phần tử khi trang đã tải xong
          $('.header_title_pick').css('transform','translateX(0)');
          $('.header_category_pick').css('transform','scale(1)');

        });
    </script>
@endsection
