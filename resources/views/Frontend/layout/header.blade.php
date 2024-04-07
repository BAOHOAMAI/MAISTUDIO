    <div class="header ">
      <div class="header_wrap container">
        <div class="header_logo">
          <!-- <img src="./scr/img/dfoyudo-68f919e7-4337-4f01-9ad7-3fcaf54c3f56.png" alt=""> -->
          <a href="{{route('main')}}" >MAIStudio</a>
        </div>
        <ul class="header__nav">
          <li class="underline"><a href="{{route('main')}}">HOME</a></li>
          <li class="underline nav_movie">CATEGORY
            <i class="fa-solid fa-chevron-down"></i>
          </li>
          @foreach ($category as $key => $cate)
          <li class="underline"><a href="{{route('genreSelect',$cate->slug)}}">{{$cate->title}}</a></li>
          @endforeach
          @if (Auth::check() && Auth::user()->level == 0)
            <li class="underline"><a href="{{route('account')}}">ACCOUNT</a></li>
          @endif
        </ul>
        <div class="search_container">
            <a href="{{route('search')}}">
                <input class="search_input" type="text" placeholder="  Search" >
                <i class="fa-solid fa-magnifying-glass"></i>
              </a>
          <div class="log_in">
            @if(Auth::check() && Auth::user()->level == 0)
                <a href="{{route('userlogout')}}"class="button_login">Log out</a>
            @else
                <a href="{{route('userlogin')}}"class="button_login">Log in</a>
            @endif
          </div>
        </div>
        <div class="modal_submenu">
          <div class="modal_inner">
            <div class="triangle_movie"></div>
            <div class="modal_category">
              <h2>Category</h2>
              <div class="all_view">
                <a href="{{route('category')}}" class="all_view_link">All View
                </a >
                <i class="fa-solid fa-chevron-right"></i>
                <i class="fa-solid fa-chevron-right"></i>
              </div>

              <div class="category_film">
                <ul class="category_list">
                  @foreach ($genre as $key => $gen)
                      <li class="category_item"><a href="{{route('categorySelect',$gen->slug)}}">{{$gen->title}}</a></li>
                  @endforeach
                </ul>
              </div>
            </div>     
            <div class="modal_rank">
              <div class="modal_rank_container">
                <div class="current_rank">
                  <div class="current_rank_header">TOP FILM :</div>
                  <a href="{{route('topall')}}" class="top_film_button">All</a>
                  <a href="{{route('topall')}}" class="top_film_button">Rated</a>
                  <a href="{{route('topall')}}" class="top_film_button">Movies</a>
                  <a href="{{route('topall')}}" class="top_film_button">Series</a>
                </div>
              </div>
            </div>    
          </div>
        </div>
      </div>
    </div>