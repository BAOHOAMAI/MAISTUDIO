      @foreach ($comments as $keys => $comment)
      @if ($comment->level == 0)
     <div class="comment_single" data-index="{{$comment->movie_id}}">
        <div class="comment_img">
            @if (isset($comment->comment_avarta)) 
                <img src="{{ asset('uploads/user/' . $comment->comment_user_id . '/' . $comment->comment_avarta) }}" alt="">
            @else
                 <img src="{{ asset('uploads/user/empty.jpg') }}" alt="">
            @endif
        </div>
        <div class="comment_container">
          <div class="comment_container_header">
            <div class="comment_header_two">
              <div class="author_name">{{$comment->comment_name}}</div>
              <div class="author_rating">
                @if (isset($rate))
                  @foreach($rate as $key => $rat)
                  @if ($rat->user_id === $comment->comment_user_id)
                    @for ($i = 0; $i < 5 ; $i++)
                      @if ($rat->rate > $i) 
                        <i class="fa-solid fa-star"></i>
                      @else 
                        <i class="fa-regular fa-star"></i>
                      @endif
                    @endfor
                  @endif
                  @endforeach
                @endif

              </div>
            </div>
            <div class="comment_time">
              <i class="fa-regular fa-clock"></i> {{$comment->comment_date}}
            </div>
          </div>
          <div class="author_description">{{$comment->comment}} </div>
          <div class="comment_single_btn">

            <div class="replay_btn">
              <i class="fa-solid fa-reply"></i>    Replay
            </div>
          @php
              $total = 0;
              foreach ($replay as $key => $value) {
                  if ($value->level == $comment->comment_id) {
                      $total += 1;
                  }
              }
              if ($total != 0) {
                  echo '<div class="view_replies">View all  ( ' . $total . ' ) replies    <i class="fa-solid fa-chevron-down"></i></div>';
              }
          @endphp


          </div>
          <div class="replay_box">
            <form>
              <input type="hidden" placeholder="Comment Here ..." class="parent_comment_id" value="{{$comment->comment_id}}">
              <input type="text" placeholder="Comment Here ..." class="replay_text">
              <div class="notify_replay">Comment thành công <i class="fa-solid fa-check" style="margin-left: 10px; color: green;"></i></div>

              <div class="comment_btn">
                <button type="button" class="btn_comment send_comment_replay">Replay</button>
              </div>
            </form>
          </div>
          <div class="rep-container ">
             @foreach ($replay as $value)
          @if ($value->level ==  $comment->comment_id)
            <div class="replay_comment">
            <div class="replay_img">
            @if (isset($value->comment_avarta)) 
                <img src="{{ asset('uploads/user/' . $value->comment_user_id . '/' . $value->comment_avarta) }}" alt="">
            @else
                 <img src="{{ asset('uploads/user/empty.jpg') }}" alt="">
            @endif
            </div>
        <div class="replay_container">
          <div class="replay_container_header">
            <div class="replay_header_two">
              <div class="replay_author_name">{{$value->comment_name}}</div>
              <div class="replay_author_rating">
                @if (isset($rate))
                  @foreach($rate as $key => $rat)
                  @if ($rat->user_id === $value->comment_user_id)
                    @for ($i = 0; $i < 5 ; $i++)
                      @if ($rat->rate > $i) 
                        <i class="fa-solid fa-star"></i>
                      @else 
                        <i class="fa-regular fa-star"></i>
                      @endif
                    @endfor
                  @endif
                  @endforeach
                @endif
              </div>
            </div>
            <div class="comment_time">
              <i class="fa-regular fa-clock"></i> {{$value->comment_date}}
            </div>
          </div>
          <div class="replay_author_description"><span style="font-family: Bona Nova; font-size: 15px;
          color:#903030;">@if($value->level == $comment->comment_id && $comment->level == 0 && $value->replies == null)
                 @ {{$comment->comment_name}}
              @else
                 @ {{$value->replies}}
                          @endif</span>  {{$value->comment}}</div>
          <div class="replay_comment_single_btn">
            <div class="replay_btn">
              <i class="fa-solid fa-reply"></i>    Replay
            </div>
          </div>
          <div class="replay_box">
            <form>
              <input type="hidden" placeholder="Comment Here ..." class="comment_replies_name" value="{{$value->comment_name}}">
              <input type="hidden" placeholder="Comment Here ..." class="parent_comment_id" value="{{$comment->comment_id}}">

              <input type="text" placeholder="Comment Here ..." class="replay_text">
              <div class="notify_replay">Comment thành công <i class="fa-solid fa-check" style="margin-left: 10px; color: green;"></i></div>
              <div class="comment_btn">
              <button class="btn_comment send_comment_replay">Replay</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      @endif

      @endforeach
          </div>
        </div>
      </div>
      @endif
      @endforeach
      {!! $comments->links("pagination::bootstrap-5") !!}

      <script>

        $('.send_comment_replay').each(function() {

          $(this).on('click',function() {

            let data = $(this).closest('.replay_box').find('.replay_text');
            let comment_text = data.val();
            let comment_movie_id = $('.comment_single').attr('data-index');
            let comment_movie_slug = $('.comment_movie_slug').val();
            let data_level = $(this).closest('.replay_box').find('.parent_comment_id');
            let comment_level = data_level.val();
            let comment_replies_name = $(this).closest('.replay_box').find('.comment_replies_name');
            let comment_replies_name_data = comment_replies_name.val();

            commentAjax (comment_text,comment_movie_id,comment_movie_slug,comment_level,comment_replies_name_data);
         });
      })
      

      function commentAjax (comment_text,comment_movie_id,comment_movie_slug,comment_level,comment_replies_name_data) {

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
                comment_replies_name_data:comment_replies_name_data,
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
              var check = "{{Auth::check()}}";
              var error = '';
              if (check) {
                if (comment_text == '') {
                  error = 'Comment text is required <i class="fa-solid fa-circle-exclamation"></i>';
                  toastComment(error);
                } else {
                  error ='Comment text maximum 255 characters <i class="fa-solid fa-circle-exclamation"></i>'
                  toastComment(error);
                }
              }
            }
        });
       } 

      // Toast comment error

       function toastComment (error) {
            const Toast = Swal.mixin({
                toast: true,
                position: "center",
                showConfirmButton: false,
                timer: 2000,
                background: '#903030',
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
              icon: "error",
              title: "Error !!!",
              html : error,

            });
          }


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
            },
        });
    }
    $('.send_comment_replay').on('click',  function() {
      var check = "{{Auth::check()}}";
      if (!check) {
           Swal.fire({
            icon: "error",
            title: "Error !!",
            width : '600px',
            html: "You haven't login please login <a style='color:red;'href='{{route('userlogin')}}'>here</a>",
            showConfirmButton: false,
          });
            $('.replay_text').val('');
          };

    })

    $('.view_replies').each(function() {

      $(this).on('click',function() {

        let data = $(this).closest('.comment_single').find('.rep-container');
        data.toggleClass('active');
     });
    })
        // Ngăn chặn hành phi submit form
    $('form').submit(function(event) {
        event.preventDefault();
    });



      </script>