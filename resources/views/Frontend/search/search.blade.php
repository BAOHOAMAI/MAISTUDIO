@extends('frontend.layout.main')

@section ('content')

    <div class="container">
        <div class="search_component">
            <div class="section_search">
                <div class="search_modal">
                    <div class="movie_search">
                        <input class="search_input" type="text" id="search" placeholder="Search . . . ." name="search" >
                    </div>
                </div>
            </div>
        </div>
        <!-- SORT BY -->
        <div class="sort_by">
          <div class="sort_by_btn">
            <input type="checkbox" id="checkbox">
            <label for="checkbox" class="toggle">
              <div class="bars" id="bar1"></div>
              <div class="bars" id="bar2"></div>
              <div class="bars" id="bar3"></div>
            </label>
            <span>Sort by</span>
          </div>
          <div class="sort_list">
            <form method="POST" action="{{route('filter')}}"> 
              @csrf
            <select name="genre" id="genre" style="--i:1">
              <option value="" disabled selected>Category</option>
              @foreach ($genre as $key => $gen)
              <option value="{{$gen->id}}">{{$gen->title}}</option>
              @endforeach
            </select>
            <select name="status" id="status" style="--i:2">
              <option value="" disabled selected>Status</option>
              <option value="1">Newest</option>
              <option value="2">Oldest</option>
            </select>
            <select name="category" id="category" style="--i:3">
              <option value="" disabled selected>Movie / Series</option>
              @foreach($category as $key => $cate)
              <option value="{{$cate->id}}">{{$cate->description}}</option>
              @endforeach
            </select>

            <button type="submit">Search </button>
            </form>
          </div>
        </div>
        <!-- MOVIE GRID -->
        <div class="movie_grid" id="result">
          @if(isset($data)) 
          @foreach($data as $key => $mov)
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
          @endif
        </div>
    </div>
    <script src="{{asset('Frontend/js/search.js')}}"></script>
    <script type="text/javascript">
     $(document).ready(function() {
    $('#search').keyup(function() {
        var name = $('#search').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            url: '{{ route('postsearch') }}',
            data: {
                name: name,
            },
            success: function(data) {
                var html = "";

                $.each(data, function(key, value) {
                    var slug = value.slug;
                    var image = value.image;
                    var image_check = image.substr(0, 5);
                    var title = value.title;

                    html += '<a href="/film/' + slug + '" class="movie_category">' +
                                '<div class="movie_card" style="background-image: url(\'' + (image_check == 'https' ? image : '{{ asset('uploads/movie/') }}/' + image) + '\')">' +
                                    '<div class="video-box">' +
                                        '<div class="play-btn">' +
                                            '<i class="fa-solid fa-play"></i>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                                '<h3 class="movie_title">' + title + '</h3>' +
                            '</a>';
                });

                $('.movie_grid').html(html);
            }
        });
    });
});

    </script>

@endsection
