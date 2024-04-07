$(document).ready(function() {
    $('.header_wrap').css('opacity','1');

  let headerWrap = $('.header_wrap');
  let subMenu = $('.modal_inner');
  let subList = $('.category_film');
  let categoryHead = $('.header_category');

  // HEADER STICKY
  $(window).scroll(function() {
    headerWrap.toggleClass("sticky", $(this).scrollTop() > 0);
    categoryHead.toggleClass("sticky", $(this).scrollTop() > 0);
  });

  // SUBMENU
  const modalSub = $(".modal_submenu");
  const openModal = $(".nav_movie");

  openModal.click(function() {
    if (modalSub.hasClass("active")) {
      closeModal();
    } else {
      openModall();
    }
  });

  function openModall() {
    subMenu.addClass('open');
    modalSub.addClass('active');
    headerWrap.addClass("sticky");
    $('body').css('overflow', 'hidden');
  }

  function closeModal() {
    subMenu.removeClass('open');
    modalSub.removeClass('active');
    headerWrap.removeClass("sticky");
    $('body').css('overflow', 'visible');
  }
});
