@extends('frontend.layout.main')

@section ('content')
      <div class="film_main">
        <div class="film_container">
                <div class="video_film_container" style="{{$movie->category_id === 11 ? 'width:100%;' : 'width:950px;'}}">
                    <div class="player">
                      <iframe allowfullscreen frameborder="0" scrolling="0" src="{{$episode->link}}"></iframe>
                    </div>
                </div>
                 @if ($movie->category_id === 12)
            <div class="eposide_wrapper">
              <ul class="nav nav-pills mb-3 episode_list" id="pills-tab" role="tablist">
                <li class="eposide_header nav-item-episode active" role="presentation"> 
                  <button class="nav-link-episode active" id="pills-episode" data-bs-toggle="pill" data-bs-target="#episode" type="button" role="tab" aria-controls="pills-episode" aria-selected="true">Episode</button>
                </li>
                <li class="eposide_header nav-item-episode" role="presentation">
                 <button class="nav-link-episode " id="pills-season" data-bs-toggle="pill" data-bs-target="#season" type="button" role="tab" aria-controls="pills-season" aria-selected="false">Season
                 </button>
                </li>
              </ul>
              <div class="eposide_container">
              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="episode" role="tabpanel" aria-labelledby="pills-episode">
                  @foreach ($movie->episode as $key => $ep)
                    <a href="{{url('watch/'.$movie->slug.'/ep-'.$ep->episode_num)}}" class="eposide_item {{$episode == $ep ? 'active' : ''}}">
                        <div class="eposide_index">{{$ep->episode_num}}</div>
                        <div class="eposide_img">
                          @if (isset($ep->episode_thumb))
                            <img src=" {{asset('uploads/episode_thumb/'.$ep->episode_thumb)}}" alt="">
                          @else
                            <img src=" {{asset('uploads/movie_thumb/'.$movie->image_thumb)}}" alt="">
                          @endif
                            <div class=" eposide_box">
                                <div class="eposide_play_btn ">
                                    <i class="fa-solid fa-play"></i>
                                </div>
                              </div>
                        </div>
                        <div class="eposide_item_container">
                            <div class="eposide_title">
                                <span class="eposide_text">{{isset($ep->episode_title) ? $ep->episode_title : $movie->title}}</span>
                                <span>{{$movie->duration}}</span>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
                <div class="tab-pane fade" id="season" role="tabpanel" aria-labelledby="pills-season">
                  @foreach ($season as $key => $ss)
                   <a href="{{ url('watch/' . $ss->slug . '/ep-' . ($ss->episode_total === 'Full' ? 'Full' : '1')) }}"
 class="eposide_item {{$ss->title == $movie->title ? 'active' : ''}}">
                        <div class="eposide_img">
                            <img src=" {{asset('uploads/movie_thumb/'.$ss->image_thumb)}}" alt="">
                            <div class=" eposide_box">
                                <div class="eposide_play_btn ">
                                    <i class="fa-solid fa-play"></i>
                                </div>
                              </div>
                        </div>
                        <div class="eposide_item_container">
                            <div class="eposide_title">
                                <span class="season_text">{{$ss->title}}</span>
                                <span>
                                  @php

                                  $total = 0 ;
                                   foreach ($ss->episode as $key => $ep) {
                                      $total = $key+1;
                                   };
                                   if ($total === 1 && $ss->category_id !== 12) {
                                      echo 'Full / ' . $ss->episode_total ;

                                   } else {
                                      echo $total . ' / ' . $ss->episode_total . ' episode';

                                   }

                                  @endphp
                                  </span>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
              </div>
              </div>
            </div>
            @endif
        </div>
    </div>
    <div class="film_name"> 
      @if ($movie->category_id === 11)
        {{$movie->title}} - {{$episode->episode_num}}
      @else
        {{$movie->title}} - Episode {{$episode->episode_num}}
      @endif
    </div>
    <div class="film_comment">
        <div class="comment">
            <div class="comment_header">
              <h2>Comments</h2>
            </div>
            <input type="hidden" class="episode_comment" value="{{$episode->episode_num}}">
            <input type="hidden" value="{{$movie->slug}}" class="comment_movie_slug">
            <input type="hidden" name="" value="{{$movie->id}}" class="comment_movie_id">
            <input type="hidden" name="" value="{{Auth::id()}}" class="comment_user_id">
            @if (isset($rating))
               <input type="hidden" name="" value="{{$rating->rate}}" class="data_rating">
            @endif
            <div class="comment_list">
                <div class="comment_single not_active" data-index="{{$movie->id}}"></div>

                @include('Frontend.film.pagination_data')
                
            </div>
            <div class="comment_wrapper">
              <form>
                <div class="wrapper_header">
                  <h3>Your Rate About This Movie :</h3>
                    <div class="rating rating_film">
                        <input type="radio" id="5" name="rating_star" class="rating_star" value="5">
                        <label for="5" class="rating-label"></label>
                        <input type="radio" id="4" name="rating_star" class="rating_star" value="4">
                        <label for="4" class="rating-label"></label>
                        <input type="radio" id="3" name="rating_star" class="rating_star" value="3">
                        <label for="3" class="rating-label"></label>
                        <input type="radio" id="2" name="rating_star" class="rating_star" value="2">
                        <label for="2" class="rating-label"></label>
                        <input type="radio" id="1" name="rating_star" class="rating_star" value="1">
                        <label for="1" class="rating-label"></label>
                    </div>
                </div> 
                <input type="text" placeholder="Comment Here ..." class="comment_text">
                <div class="notify_comment">Comment thành công <i class="fa-solid fa-check" style="margin-left: 10px; color: green;"></i></div>

                <div class="comment_btn">
                  @if (Auth::check())
                   <button type="button" class="btn_comment send_comment" >Comment</button>
                  @else
                   <button type="button" class="btn_comment login_comment" >Comment</button>
                  @endif                
                </div>
              </form>
            </div>
            </div>
          </div>
          <div class="similar_video">
            <div class="similar_header">
              <h2>Similar Video</h2>
            </div>
            <div class="movie_list">
              <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                  @foreach($related as $key => $rel)
                   @php 
                          $image_check = substr($rel->image, 0, 5);
                    @endphp
                  <div class="swiper-slide">
                    <a href="{{route('film' , $rel->slug)}}">
                      <div class="movie_card" style="background-image: url('{{ $image_check == 'https' ? $rel->image : asset('uploads/movie/'.$rel->image) }}')">
                        <div class=" video-box">
                          <div class="play-btn ">
                              <i class="fa-solid fa-play"></i>
                          </div>
                        </div>
                      </div>
                      <h3 class="movie_title">{{$rel->title}}</h3>
                    </a>
                  </div>
                  @endforeach
                </div>
            </div>
          </div>
          </div>
    </div>

  <script src="{{asset('Frontend/js/comment.js')}}" ></script>
  <script type="text/javascript">

    document.addEventListener('DOMContentLoaded', function () {
      var swiper = new Swiper(".mySwiper", {
        slidesPerView: 6,
        spaceBetween: 30,
      });
     });

    $(document).ready(function() {



    // Load dữ liệu comment pagination không refresh page

    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();

        var page = $(this).attr('href').split('page=')[1];
        let comment_movie_slug = $('.comment_movie_slug').val();
        let episode_comment = $('.episode_comment').val();
        var substring = comment_movie_slug;
      
        fetchdata(page, substring ,episode_comment);
    });

    function fetchdata(page, substring , episode_comment) {
       var url = "{{ route('fetchcom', ['slug' => ':substring' , 'ep' => ':episode_comment']) }}";
       url = url.replace(':substring', substring);
       url = url.replace(':episode_comment', episode_comment);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });

        $.ajax({
            method:"POST",
            url: url , // Correctly construct the URL
            data: {
                page: page,
                substring: substring,
                episode_comment: episode_comment // Pass the slug as data
            },
            success: function(data) {
                $('.comment_list').html(data);

            }
        });
    }

    // Gửi dữ liệu comment không refresh page
    $('.send_comment').on('click',function() {

        let comment_text = $('.comment_text').val();
        let comment_movie_id = $('.comment_single').attr('data-index');
        let comment_movie_slug = $('.comment_movie_slug').val();
        let comment_level = 0;
        commentAjax (comment_text,comment_movie_id,comment_movie_slug,comment_level);
    });

    // Gửi dữ liệu replay comment

    function commentAjax (comment_text,comment_movie_id,comment_movie_slug,comment_level) {


        var page = 1;
        var substring = comment_movie_slug;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });

        $.ajax({
            method:"POST",
            url: "{{route('sendcomment')}}" , // Correctly construct the URL
            data: {
                comment_text: comment_text,
                comment_level: comment_level,
                comment_movie_id:comment_movie_id,
                comment_movie_slug :comment_movie_slug,
            },
            success: function(data) {
                
                fetchdata(page, substring);
                $('.comment_text').val('');
                $('.replay_text').val('');
                 const Toast = Swal.mixin({
                  toast: true,
                  position: "center",
                  showConfirmButton: false,
                  timer: 2000,
                  background: '#346939',
                  color:'white',
                  width : '500px',
                  height: '500px',
                  padding:20,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                  }
                 });
                  Toast.fire({
                    icon: "success",
                    title: "Success !!",
                    html : "Comment Success ",

                  });
            },
            error : function (data) {
              var error = '';
              if (comment_text == '') {
                  error = 'Comment text is required <i class="fa-solid fa-circle-exclamation"></i>';
                  toastComment(error);
              } else {
                  error ='Comment text maximum 255 characters <i class="fa-solid fa-circle-exclamation"></i>'
                  toastComment(error);
              }
            }
        });
   }

    // Rating Ajax

        $('.rating_star').each(function() {
          $(this).on('click',function() {
            let rated = $(this).val();
            let movie_id = $('.comment_movie_id').val();
            let user_id = $('.comment_user_id').val();
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });

        $.ajax({
            method:"POST",
            url: "{{route('rating')}}" , // Correctly construct the URL
            data: {
              movie_id:movie_id,
              user_id:user_id,
              rated:rated
            },
            success: function(data) {
              const Toast = Swal.mixin({
                  toast: true,
                  position: "center",
                  showConfirmButton: false,
                  timer: 2000,
                  background: '#346939',
                  color:'white',
                  width : '500px',
                  height: '500px',
                  padding:20,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                  }
                 });
                  Toast.fire({
                    icon: "success",
                    title: "Rating success !!",
                    html : "You have successfully rated ",

                  });
            },
          });
         });
        })


        // Hiện ra số sao đã rate trước đó (đã login)

        var check = "{{Auth::check()}}";
        if (check) {
           $('.rating-label').each(function() {
              var input = $(this).attr("for"); 
              var rating = $('.data_rating').val(); 

              if (input === rating) {
                  $(this).nextAll().addBack().addClass('rated');
              }
            });
        } 

        // Hiện error khi đánh giá mà chưa login 

        $('.rating_film').on('click',function () {
          var check = "{{Auth::check()}}"
          if (!check) {
             Swal.fire({
            icon: "error",
            title: "Error !!",
            width : '600px',
            html: "You haven't login please login <a style='color:red;'href='{{route('userlogin')}}'>here</a>",
            showConfirmButton: false,
          });
          }
        })



});

  </script>

@endsection
