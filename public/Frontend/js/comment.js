$(document).ready(function() {
  
    $(document).on('click', '.replay_btn', function() {
        let index = $('.replay_btn').index(this);
        $('.replay_box').eq(index).toggleClass('active');
    });

    $(document).on('click', '.comment_like', function() {
        $(this).toggleClass('active');
    });


    // Nhấn nút Enter gửi dữ liệu form
    $('form').keypress(function(event) {
        if (event.which === 13) {
            let comment_text = $('.comment_text').val();
            let comment_movie_id = $('.comment_single').attr('data-index');
            let comment_movie_slug = $('.comment_movie_slug').val();

            commentAjax (comment_text,comment_movie_id,comment_movie_slug);
        }

    });
    $('.login_comment').on('click',  function() {
          Swal.fire({
            icon: "error",
            title: "Error !!",
            width : '600px',
            html: "You haven't login please login <a style='color:red;'href='{{route('userlogin')}}'>here</a>",
            showConfirmButton: false,
          });
            $('.comment_text').val('');

    })


    // Ngăn chặn hành phi submit form
    $('form').submit(function(event) {
        event.preventDefault();
    });

    // Toast error comment
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

});
