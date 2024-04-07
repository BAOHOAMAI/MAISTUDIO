@extends('frontend.layout.main')

@section ('content')

    <div class="main_account">
        <div class="account_wrapper">
            <div class="left_menu">
              <div class="left_menu_img">
                @if (isset(Auth::user()->avarta)) 
                    <img src="{{ asset('uploads/user/' . Auth::id() . '/' . Auth::user()->avarta) }}" alt="">
                @else
                     <img src="{{ asset('uploads/user/empty.jpg') }}" alt="">
                @endif
                <div class="name_account">               
                 @if (isset(Auth::user()->name_account)) 
                    {{Auth::user()->name_account}}
                @else
                     {{Auth::user()->name}}
                @endif
              </div>
                <div class="date_join_account">Join on {{Auth::user()->create}}</div>
              </div>
                <div class="left_item"> 
                    <a href="{{route('account')}}">ACCOUNT DETAIL</a>
                </div>
                <div class="left_item">
                    <a href="{{route('favourite')}}">FAVOURITE LIST</a>
                </div>
                <div class="left_item">
                    <a href="{{route('history')}}">HISTORY LIST</a>
                </div>
                <div class="left_item">
                    <a href="{{route('userlogout')}}">LOG OUT</a>
                </div>
            </div>
            <div class="right_menu">
                <div class="right_menu_header">
                    FAVOURITE MOVIE
                </div>
                <div class="history_wrapper">
                  <div class="history_btn">
                    <div class="sort_by_history">
                      <span>Sort by : </span>
                      <form method="POST" action="{{route('filfavourite')}}">
                        @csrf
                      <select name="sort" id="sort"> 
                        <option value="1">Newest</option>
                        <option value="2">Oldest</option>
                      </select>
                      <button type="submit" class="sort">Sort</button>
                      </form>

                    </div>
                    <div class="delete_history">
                    <form action="{{route('deletefavou')}}" id="form_fav" method="POST">
                      @csrf
                      <button type="submit" class="delete_all">DELETE ALL</button>
                    </form>
                    </div>
                  </div>
                </div>
                <div class="list_favourite">

                  @foreach($favourite as $key => $fav)
                     @php 
                        $image_check = substr($fav->image, 0, 5);
                     @endphp
                  <a href="{{route('film',$fav->movie->slug)}}" class="movie_category">
                    <div class="movie_card" style="background-image: url('{{ $image_check == 'https' ? $fav->image : asset('uploads/movie/'.$fav->image) }}')">
                      <div class=" video-box">
                        <div class="play-btn ">
                            <i class="fa-solid fa-play"></i>
                        </div>
                      </div>
                    </div>
                    <h3 class="movie_title">{{$fav->movie->title}}</h3>
                    <form action="{{route('deletefavou')}}" id="form_fav" method="POST">
                      @csrf
                      <input type="hidden" name="fav_id"  class="fav_id" value="{{$fav->id}}">
                       <button type="submit" class="delete_favourite">
                           <i class="fa-solid fa-square-xmark"></i>
                      </button>
                    </form>
                </a>
                @endforeach

                </div>
                  {!! $favourite->links("pagination::bootstrap-4") !!}

            </div>
        </div>
    </div>
    <script type="text/javascript">


   $(document).ready(function() {
          $('.left_menu_img img').css('transform','scale(1)');
          $('.right_menu_header').css('transform','scale(1)');
    // Xóa dữ liệu movie favourite
    $('form#form_fav').submit(function(event) {
        event.preventDefault();

        var form = this;
        var fav_id = $(form).find('.fav_id').val();
        var url = $(form).attr('action');

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#dc3545",
            confirmButtonColor: "#198754",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    }
                });
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        fav_id: fav_id,
                    },
                    success: function(response) {
                        Swal.fire({
                          title: "Deleted!",
                          text: "Your file has been deleted.",
                          icon: "success",
                          showConfirmButton: false,
                          timer:2000,
                          })
                            .then(() => {
                                location.reload();
                            });
                    },
                });
            }
        });
    });




});
    </script>
@endsection
