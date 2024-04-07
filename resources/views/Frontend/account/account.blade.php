@extends('frontend.layout.main')

@section ('content')
    @if (session('success'))
        <script>
            const Toast = Swal.mixin({
              toast: true,
              position: "center",
              showConfirmButton: false,
              timer: 2000,
              background: 'white',
              color:'black',
              width : '600px',
              height: '600px',
              padding : '40px',
              didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
              }
            });
            Toast.fire({
              icon: "success",
              title: "Congratulation !!!",
              text : "{{ session('success') }}",

            });
        </script>
    @endif
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
                    <a href="">ACCOUNT DETAIL</a>
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
                    ACCOUNT DETAIL
                </div>
                <div class="right_menu_wrapper">
                    <div class="right_menu_container">
                        <form action="{{route('update-user')}}" method="POST"  enctype="multipart/form-data">
                            @csrf
                            <div class="form_group">
                                <span>Email</span>
                                <input type="email" value="{{Auth::user() -> email}}" >
                            </div>
                            <div class="form_group">
                                <span>Account</span>
                                <input type="text" placeholder="Name Account" name="name_account" value="{{Auth::user() -> name_account}}">
                            </div>
                            <div class="form_group">
                                <span>Name</span>
                                <input type="text" placeholder="Name" value="{{Auth::user()->name}}" disabled>
                            </div>
                            <div class="form_group">
                                <span>Phone</span>
                                <input type="text" placeholder="Phone Number" name="phone" value="{{Auth::user() -> phone}}">
                            </div>
                            <div class="form_group">
                                <span>Password</span>
                                <input type="password" id="password" placeholder=" * Leave blank if you do not want to change" name="password">
                            </div>
                            <div class="form_group">
                                <span>Avarta</span>
                                <input type="file" name="avarta">
                            </div>
                            <span class="warn">(Ảnh nhỏ hơn 5MB, nếu ảnh lớn hơn 5MB sẽ được chọn mặc định)</span>
                            <button type="submit" class="update">UPDATE</button>
                        </form>
                    </div>
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
