$(function() {
  $('#sidebarCollapse').on('click', function() {
    $('#sidebar, #content').toggleClass('active');
  });
});

$(document).ready(function() {
  var headerHeight = $('header').outerHeight();
  $('.menu-sidebar').css('top', headerHeight + 'px');
});
