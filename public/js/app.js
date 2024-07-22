// Override Barang Page Sidebar
$(document).ready(function() {
  $("#body").removeClass('toggle-sidebar');
    if (window.location.href.indexOf("Barang") > -1 || window.location.href.indexOf("barang") > -1) {
      $('body').addClass('toggle-sidebar');
      var windowWidth = $(window).width();
      if (windowWidth < 1200) {
        $('body').removeClass('toggle-sidebar');
      }
    };
  });

// Active Nav-link
$(document).ready(function() {
  var path = $(location).attr('href');
  $('.nav-link').each(function() {
    var href = $(this).attr('href');
    if (href === path) {
      $(this).removeClass('collapsed');
      $(this).addClass('active');
    }
  });
});
