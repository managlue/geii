$(document).ready(function () {
    $('.collapse').on('show.bs.collapse', function () {
      $(this).prev('.card-header').find('.btn').addClass('active');
    });

    $('.collapse').on('hide.bs.collapse', function () {
      $(this).prev('.card-header').find('.btn').removeClass('active');
    });
  });