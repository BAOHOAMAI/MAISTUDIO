@extends('frontend.layout.main')

@section ('content')
        <div class="main_category">
        <div class="header_category">
            <div class="header_category_wrapper">
            <div class="header_title">Category > </div>
            <div class="header_select_category">
              <div class="select_category_box">
                <span>ALL</span>
                <i class="fa-solid fa-chevron-down"></i>
              </div>
              <div class="sub_select_category">
                <div class="select_category_row">
                  @foreach ($genre as $key => $gen)
                      <a href="{{route('categorySelect',$gen->slug)}}">{{$gen->title}}</a>
                  @endforeach
                </div>
              </div>
            </div>
            </div>
            <div class="header_category_genre">
              <div class="header_select_genre">
              <div class="select_genre_box">
                <span>{{isset($category_slug) ? $category_slug->description : 'Movies / Series'}}</span>
                <i class="fa-solid fa-chevron-down"></i>
              </div>
              <div class="sub_select_genre">
                <div class="select_genre_row">
                    <a href="{{route('category')}}">Movies / Series </a>
                  @foreach ($category as $key => $cate)
                    <a href="{{route('genreSelect',$cate->slug)}}">{{$cate->description}}</a>
                  @endforeach
                </div>
              </div>
            </div>
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
          $('.header_title').css('transform','translateX(0)');
          $('.header_select_category, .header_select_genre').css('transform','scale(1)')
            .click(function() {
              $(this).toggleClass('active');
            });
        });
    </script>
@endsection
