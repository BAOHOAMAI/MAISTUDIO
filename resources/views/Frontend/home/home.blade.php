@extends('frontend.layout.main')

@section ('content')

      <div class="main">
      <div class="hero_main">
        <!-- VIDEO -->
          <div class="hero_video">
              <!-- CURSOR -->
              <div class="cursor">
              <span class="cursor_watch">WATCH</span>
              <div class="cursor_play">
                <i class="fa-solid fa-play"></i>
              </div>
            </div>
            <video src="{{asset('Frontend/video/home/solo leveling.mp4')}}" autoplay loop muted  type='video/mp4'></video>
          </div>
          <section id="section07" class="demo">
            <a href="#section_header"><span></span><span></span><span></span><p>Scroll</p></a>
          </section>
      </div>
    </div>
    <!-- MODAL TRAILER -->
    <div class="modal_trailer">
      <div class="modal_trailer_container">
        <iframe width="700" height="400" src="https://www.youtube.com/embed/YvGSK8mIlt8?si=aDgcHQl9m7Kkd9es" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        <div class="modal_trailer_close">
          <i class="fa-solid fa-xmark"></i>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="section">
        <div class="section_header" id="section_header">
          <h2 class="section_header_title">Trending Movies</h2>
          <button class="home_button">
            <a href="{{route('category')}}" class="film_button">View more
              <span class="about-narrow">
                <svg viewBox="0 0 45 7">
                   <polyline points="0,7 45,7 24,0 24,6 0,6"></polyline>
                </svg>
             </span>
            </a>
          </button>
        </div>
        <div class="movie_list">
          <div class="swiper mySwiper">
            <div class="swiper-wrapper">
              @foreach ($trending as $key => $trend)
                @php 
                $image_check = substr($trend->image, 0, 5);
                @endphp

                <div class="swiper-slide">
                    <a href="{{ route('film', $trend->slug) }}">
                        <div class="movie_card" style="background-image: url('{{ $image_check == 'https' ? $trend->image : asset('uploads/movie/'.$trend->image) }}')" >
                            <div class="video-box">
                                <div class="play-btn">
                                    <i class="fa-solid fa-play"></i>
                                </div>
                            </div>
                        </div>
                        <h3 class="movie_title">{{ $trend->title }}</h3>
                    </a>
                </div>
            @endforeach

            </div>
        </div>
      </div>
      </div>
      <div class="section">
      <div class="section_header" id="section_header">
        <h2 class="section_header_title">Recently Updated</h2>
        <button class="home_button">
          <a href="{{route('category')}}" class="film_button">View more
            <span class="about-narrow">
              <svg viewBox="0 0 45 7">
                 <polyline points="0,7 45,7 24,0 24,6 0,6"></polyline>
              </svg>
           </span>
          </a>
        </button>
      </div>
      <div class="movie_list">
        <div class="swiper mySwiper">
          <div class="swiper-wrapper">
              @foreach ($updatemovie as $key => $update)
                @php 
                    $image_check = substr($update->image, 0, 5);
                @endphp
              <div class="swiper-slide">
                    <a href="{{route('film' , $update->slug)}}">
                      <div class="movie_card" style="background-image: url('{{ $image_check == 'https' ? $update->image : asset('uploads/movie/'.$update->image) }}')">
                        <div class=" video-box">
                          <div class="play-btn ">
                              <i class="fa-solid fa-play"></i>
                          </div>
                        </div>
                      </div>
                      <h3 class="movie_title">{{$update->title}}</h3>
                    </a>
                  </div>
              @endforeach
            </div>
      </div>
    </div>
      </div>
      <div class="section">
    <div class="section_header" id="section_header">
      <h2 class="section_header_title">Top Rated Movies</h2>
      <button class="home_button">
        <a href="{{route('topall')}}" class="film_button">View more
          <span class="about-narrow">
            <svg viewBox="0 0 45 7">
               <polyline points="0,7 45,7 24,0 24,6 0,6"></polyline>
            </svg>
         </span>
        </a>
      </button>
    </div>
    <div class="movie_list">
      <div class="swiper mySwiper">
        <div class="swiper-wrapper">
          @foreach ($topmovie as $key => $topmov)
                @php 
                    $image_check = substr($topmov->image, 0, 5);
                @endphp
              <div class="swiper-slide">
                    <a href="{{route('film' , $topmov->slug)}}">
                      <div class="movie_card" style="background-image: url('{{ $image_check == 'https' ? $topmov->image : asset('uploads/movie/'.$topmov->image) }}')">
                        <div class=" video-box">
                          <div class="play-btn ">
                              <i class="fa-solid fa-play"></i>
                          </div>
                        </div>
                      </div>
                      <h3 class="movie_title">{{$topmov->title}}</h3>
                    </a>
                  </div>
          @endforeach
        </div>  
    </div>
  </div>
      </div>
      <div class="section">
        <div class="section_header" id="section_header">
          <h2 class="section_header_title">Top Rated Series</h2>
          <button class="home_button">
            <a href="{{route('topall')}}" class="film_button">View more
              <span class="about-narrow">
                <svg viewBox="0 0 45 7">
                   <polyline points="0,7 45,7 24,0 24,6 0,6"></polyline>
                </svg>
             </span>
            </a>
          </button>
        </div>
        <div class="movie_list">
          <div class="swiper mySwiper">
            <div class="swiper-wrapper">
              @foreach ($topseries as $key => $topser)
                  @php 
                    $image_check = substr($topser->image, 0, 5);
                @endphp
              <div class="swiper-slide">
                    <a href="{{route('film' , $topser->slug)}}">
                      <div class="movie_card" style="background-image: url('{{ $image_check == 'https' ? $topser->image : asset('uploads/movie/'.$topser->image) }}')">
                        <div class=" video-box">
                          <div class="play-btn ">
                              <i class="fa-solid fa-play"></i>
                          </div>
                        </div>
                      </div>
                      <h3 class="movie_title">{{$topser->title}}</h3>
                    </a>
                  </div>
          @endforeach
            </div> 
        </div>
      </div>
        </div>
    </div>
    <script src="{{asset('Frontend/js/home.js')}}" ></script>
    <script>

    // SLIDE FILM
  	document.addEventListener('DOMContentLoaded', function () {
	    var swiper = new Swiper(".mySwiper", {
	      slidesPerView: 6,
	      spaceBetween: 30,
	    });
	   });

  </script>

@endsection
