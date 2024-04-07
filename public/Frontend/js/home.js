$(document).ready(function() {
  
  let header = $('.header');
  let cursor = $('.cursor');
  let Headervideo = $('.hero_video');
  let scrollVideo = $('#section07');
  let modalTrailer = $('.modal_trailer');
  let closeTrailerBtn = $('.modal_trailer_close');

  // CURSOR ANIMATION
  scrollVideo.mouseenter(function() {
    cursor.css('display', 'none');
  });

  Headervideo.mouseleave(function() {
    cursor.css('display', 'none');
  });

  Headervideo.mousemove(function(e) {
    cursor.attr("style", "top: " + (e.pageY - 60) + "px; left: " + (e.pageX - 60) + "px;");
  });

  Headervideo.click(function() {
    cursor.addClass('click');
    setTimeout(function() {
      cursor.removeClass('click');
    }, 500);
  });

  // MODAL TRAILER
  Headervideo.click(function() {
    modalTrailer.addClass('active');
  });

  closeTrailerBtn.click(function() {
    modalTrailer.removeClass('active');
  });

  // MOUSE ANIMATION
  header.mouseenter(function() {
    cursor.css('display', 'none');
  });

});
