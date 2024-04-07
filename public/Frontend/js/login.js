 $(document).ready(function() {
    var login = $("#login");
    var loginBtn = $(".login-btn");
    var register = $("#register");
    var registerBtn = $(".register-btn");


    function Login() {
        login.css("left", "85px");
        register.css("left", "600px");
    }

    function Register() {
        login.css("left", "-550px");
        register.css("left", "4px");
    }

    // Gọi hàm khi click vào các button tương ứng

    loginBtn.click(Login);
    registerBtn.click(Register);
});