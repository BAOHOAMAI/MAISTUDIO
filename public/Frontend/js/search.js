$(document).ready(function() {
  let sortBy = $('.sort_by');
  let sortByBtn = $('.sort_by_btn');

  sortByBtn.click(function() {
    sortByBtn.toggleClass('active');
    sortBy.toggleClass('active');
  });
});
