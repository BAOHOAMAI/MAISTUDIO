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
                    HISTORY
                </div>
                <div class="history_wrapper">
                  <div class="history_btn">
                    <div class="sort_by_history">
                      <span>Sort by : </span>
                      <select name="sort" id="sort">
                        <option value="" selected>Newest</option>
                        <option value="">Oldest</option>
                      </select>
                    </div>
                    <div class="delete_history">
                      <button type="submit">DELETE ALL</button>
                    </div>
                  </div>
                </div>
                <div class="list_history">
                  <a href="" class="movie_category">
                    <div class="movie_card" style="background-image: url('{{ asset('Frontend/images/demo/Solo-1-game4v-1656899043-96.png') }}')">
                      <div class=" video-box">
                        <div class="play-btn ">
                            <i class="fa-solid fa-play"></i>
                        </div>
                      </div>
                    </div>
                    <h3 class="movie_title">Solo Leveling</h3>
                    <div class="delete_favourite">
                      <i class="fa-solid fa-square-xmark"></i>
                    </div>
                </a>
                <a href="" class="movie_category">
                  <div class="movie_card" style="background-image: url('{{ asset('Frontend/images/demo/kimetsu.jpg') }}')">
                    <div class=" video-box">
                      <div class="play-btn ">
                          <i class="fa-solid fa-play"></i>
                      </div>
                    </div>
                  </div>
                  <h3 class="movie_title">Kimetsu No Yaiba</h3>
                  <div class="delete_favourite">
                      <i class="fa-solid fa-square-xmark"></i>
                    </div>
                </a>
                <a href="" class="movie_category">
                  <div class="movie_card" style="background-image: url('{{ asset('Frontend/images/demo/evil.jpg') }}')">
                    <div class=" video-box">
                      <div class="play-btn ">
                          <i class="fa-solid fa-play"></i>
                      </div>
                    </div>
                  </div>
                  <h3 class="movie_title">The Worst Of Evil</h3>
                  <div class="delete_favourite">
                      <i class="fa-solid fa-square-xmark"></i>
                    </div>
                </a>
                <a href="" class="movie_category">
                  <div class="movie_card" style="background-image: url('{{ asset('Frontend/images/demo/prison.jpg') }}')">
                    <div class=" video-box">
                      <div class="play-btn ">
                          <i class="fa-solid fa-play"></i>
                      </div>
                    </div>
                  </div>
                  <h3 class="movie_title">Prison Break</h3>
                  <div class="delete_favourite">
                      <i class="fa-solid fa-square-xmark"></i>
                    </div>
                </a>
                <a href="" class="movie_category">
                  <div class="movie_card" style="background-image: url('{{ asset('Frontend/images/demo/loki.jpg') }}')">
                    <div class=" video-box">
                      <div class="play-btn ">
                          <i class="fa-solid fa-play"></i>
                      </div>
                    </div>
                  </div>
                  <h3 class="movie_title">Loki</h3>
                  <div class="delete_favourite">
                      <i class="fa-solid fa-square-xmark"></i>
                    </div>
                </a>
                <a href="" class="movie_category">
                  <div class="movie_card" style="background-image: url('{{ asset('Frontend/images/demo/it2.jpg') }}')">
                    <div class=" video-box">
                      <div class="play-btn ">
                          <i class="fa-solid fa-play"></i>
                      </div>
                    </div>
                  </div>
                  <h3 class="movie_title">IT Chapter 2</h3>
                  <div class="delete_favourite">
                      <i class="fa-solid fa-square-xmark"></i>
                    </div>
                </a>
                <a href="" class="movie_category">
                  <div class="movie_card" style="background-image: url('{{ asset('Frontend/images/demo/aquaman.jpg') }}')">
                    <div class=" video-box">
                      <div class="play-btn ">
                          <i class="fa-solid fa-play"></i>
                      </div>
                    </div>
                  </div>
                  <h3 class="movie_title">Aquaman : The Lost Kingdom</h3>
                  <div class="delete_favourite">
                      <i class="fa-solid fa-square-xmark"></i>
                    </div>
                </a>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
          // Thiết lập transform cho các phần tử khi trang đã tải xong
          $('.left_menu_img img').css('transform','scale(1)');
          $('.right_menu_header').css('transform','scale(1)');
        });
    </script>
@endsection
