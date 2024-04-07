@extends('frontend.layout.main')

@section ('content')
    @if (session('success'))
        <script>
            Swal.fire({
              position: "center",
              icon: "success",
              title: "Congratulation !!!",
              width : '600px',
              timer: 2000,
              text: "{{ session('success') }}",
              showConfirmButton: false,
            });
        </script>

    @endif
    @if(session('error'))
        <script>
            Swal.fire({
              icon: "error",
              title: "Login error !!",
              width : '600px',
              timer: 2000,
              text: "{{ session('error') }}",
              showConfirmButton: false,
            });
        </script>
    @endif
    <div class="form">
        <div class="form_box">
            <!-- Login Form -->
                <div class="login_container" id="login" >
                <form method="POST" action="{{route('postlogin')}}" id="form-login">
                @csrf
                <div class="top">
                    <span class="top_login">Don't have an account?<span  class="register-btn" >Register</span></span>
                    <header>Login</header>
                </div>
                <div class="input_box">
                    <input type="email" class="input_field" placeholder="Email" name="login-email">
                        @error('login-email')
                            <div class="error-message">{{ $message }}</div>
                        @enderror 
                </div>
                <div class="input_box">
                    <input type="password" class="input_field" placeholder="Password" name="login-password">
                        @error('login-password')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                </div>
                <div class="two_col">
                    <div class="one">
                        <input type="checkbox" id="check">
                        <label for="check">Remember Me</label>
                    </div>
                    <div class="two">
                        <label for=""><a href="#">Forgot Password ? </a></label>
                    </div>
                </div>
                <div class="input_box">
                    <button type="submit" class="submit" data-form="form-login">Sign In</button>
                </div>
            </form>
    
            </div>

            <!-- Register Form -->

            <div class="register_container" id="register">
                <form method="POST" action="{{route('post-register')}}" >
                @csrf
                <div class="top">
                    <span class="top_register">Have an account?<span   class="login-btn" >Login</span></span>
                    <header>Sign up</header>
                </div>
                <div class="input_box">
                    <input type="text" class="input_field"  placeholder="Name" name="name">
                        @error('name')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                </div>
                <div class="input_box">
                    <input type="email" class="input_field"  placeholder="Email" name="register-email">
                        @error('register-email')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                </div>
                <div class="input_box">
                    <input type="password" class="input_field"  placeholder="Password " name="register-password">
                        @error('register-password')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                </div>
                <div class="input_box">
                    <input type="password" class="input_field"  placeholder="Password Confirm" name="password-confirm">
                        @error('password-confirm')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                </div>
                <div class="two_col">
                    <div class="two">
                        <label for=""><a href="#">Term & Condition</a></label>
                    </div>
                </div>
                <div class="input_box">
                    <button type="submit" class="submit" >Register</button>
                </div>
         </form>

            </div>
        </div>
    </div>
    <script src="{{asset('Frontend/js/login.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
          // Thiết lập transform cho các phần tử khi trang đã tải xong
          $('.form_box').css('transform','scale(1)');

        });
    </script>
@endsection
