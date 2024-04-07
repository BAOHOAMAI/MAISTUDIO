@extends('frontend.layout.main')

@section ('content')
    <div class="main">
        @php 
            $image_check = substr($movie->image, 0, 5);
        @endphp
      <div class="banner" style="background-image: url('{{ $image_check == 'https' ? $movie->image : asset('uploads/movie/'.$movie->image) }}')"></div>
        <div class="movie_content_container ">
          <div class="movie_content_poster">
            <div class="movie_content_img">
              <img src="{{$image_check == 'https' ? $movie->image : asset('uploads/movie/'.$movie->image)}}" alt="">
            </div>
          </div>
          <div class="movie_content_info">
            <div class="title">{{$movie->title}}</div>
            <div class="genre">
              @foreach($movie->movie_genre as $val)
              <span class="genres__item">
                <a href="{{route('categorySelect',$val->slug)}}" style="padding: 8px 15px;">{{$val->title}}</a>
              </span>
              @endforeach
            </div>
            <div class="duration">Duration : 
              @if ($movie->category_id === 11)
              {{$movie->duration}} 
              @else
              {{$movie->duration}} / episode
              @endif
            </div>
            <div class="episode">Episode : 
              @if ($movie->category_id === 11)
                {{$movie->episode_total}}
              @else
                {{$episode_list_count}} / {{$movie->episode_total}}
              @endif  

            </div>
            <div class="rating">Rating :     
              @for ($i = 0; $i < 5 ; $i++)
                @if ($roundRate > $i) 
                  <i class="fa-solid fa-star"></i>
                @else 
                  <i class="fa-regular fa-star"></i>
                @endif
              @endfor
              ( {{$reviews}} reviews )
            </div>
            <div class="description">
              {{$movie->description}}
            </div>
            <div class="link">
              @if(isset($firstep))
                <a href="{{url('watch/'.$movie->slug.'/ep-'.$firstep->episode_num)}}" class="watch_now">WATCH NOW</a>
              @endif
              <a href="#trailer" class="watch_trailer" style="margin-right: 20px;">WATCH TRAILER</a>
              <span  class="watch_trailer favourite {{ isset($favourite) ? 'active ' : ''}}"><i class="fa-regular fa-heart" style="margin-right: 10px;"></i>FAVOURITE
               
              </span>
            </div>
          </div>
        </div>
        <div class="video_component" id="trailer">
          <div class="video">
            <div class="video_container">
              <div class="video_title">
                <h2>{{$movie->trailer_title}}</h2>
              </div>
              <iframe width="100%" height="800" src="https://www.youtube.com/embed/{{$movie->trailer_link}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>
          </div>
          <div class="comment">
            <div class="comment_header">
              <h2>Comments</h2>
            </div>
            <input type="hidden" name="" value="{{$movie->slug}}" class="comment_movie_slug">
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
                  <form >
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
                    <input type="text" placeholder="Comment Here ..." class="comment_text" name="comment_text">
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
  <script src="{{asset('Frontend/js/comment.js')}}" ></script>
  <script type="text/javascript">

    document.addEventListener('DOMContentLoaded', function () {
      var swiper = new Swiper(".mySwiper", {
        slidesPerView: 6,
        spaceBetween: 30,
      });
     });


   $(document).ready(function() {
    $('.movie_content_img img').css('transform','scale(1)');
    $('.movie_content_info>*').css('transform','scale(1)');
    $('.movie_content_info>*').css('opacity','1');

    // Load dữ liệu comment pagination không refresh page

    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();

        var page = $(this).attr('href').split('page=')[1];
        let comment_movie_slug = $('.comment_movie_slug').val();

        var substring = comment_movie_slug;
      
        fetchdata(page, substring);
    });

    function fetchdata(page, substring) {
       var url = "{{ route('fetch', ['slug' => ':substring']) }}";
       url = url.replace(':substring', substring);
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
                substring: substring // Pass the slug as data
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
        console.log($('.send_comment_replay'));
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


        // Add Movie vào Favourite
       $('.favourite').on('click', function() {
          var check = "{{Auth::check()}}"
          if (check) {
            if ($(this).hasClass("active")) {
              Swal.fire({
                  icon: "error",
                  title: "You have added this movie to your favourites!",
                  width: '700px',
                  html: "Please go to your <a style='color:red;' href='{{route('favourite')}}'>account</a> to see your favourite movies.",
                  showConfirmButton: false,
              });
          } else {
              let movie_id = $('.comment_movie_id').val();
              let user_id = $('.comment_user_id').val();
              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                  }
              });

              $.ajax({
                  method: "POST",
                  url: "{{ route('addfavou') }}",
                  data: {
                      movie_id: movie_id,
                      user_id: user_id,
                  },
                  success: function(data) {

                      $('.favourite').addClass('active');

                      const Toast = Swal.mixin({
                          toast: true,
                          position: "center",
                          showConfirmButton: false,
                          timer: 2000,
                          background: '#346939',
                          color: 'white',
                          width: '500px',
                          height: '500px',
                          padding: 20,
                          timerProgressBar: true,
                          didOpen: (toast) => {
                              toast.onmouseenter = Swal.stopTimer;
                              toast.onmouseleave = Swal.resumeTimer;
                          }
                      });
                      Toast.fire({
                          icon: "success",
                          title: "Success!",
                          html: "Added to Favourites successfully.",
                      });
                  },
              });
          }
          } else {
                        Swal.fire({
            icon: "error",
            title: "Error !!",
            width : '600px',
            html: `You haven't login please login <a style='color:red;'href='{{route('userlogin')}}'>here</a>`,
            showConfirmButton: false,
          });
          }
      }); 

});

  </script>
@endsection
