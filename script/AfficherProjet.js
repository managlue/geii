document.addEventListener("DOMContentLoaded", function() {
  var multipleCardCarousel = document.querySelector("#carouselExampleControls");
  if (window.matchMedia("(min-width: 768px)").matches) {
    var carousel = new bootstrap.Carousel(multipleCardCarousel, {
      interval: false,
    });
    var carouselWidth = multipleCardCarousel.querySelector(".carousel-inner").scrollWidth;
    var cardWidth = multipleCardCarousel.querySelector(".carousel-item").offsetWidth;
    var scrollPosition = 0;
    multipleCardCarousel.querySelector(".carousel-control-next").addEventListener("click", function () {
      if (scrollPosition < carouselWidth - cardWidth * 4) {
        scrollPosition += cardWidth;
        multipleCardCarousel.querySelector(".carousel-inner").scrollLeft = scrollPosition;
      }
    });
    multipleCardCarousel.querySelector(".carousel-control-prev").addEventListener("click", function () {
      if (scrollPosition > 0) {
        scrollPosition -= cardWidth;
        multipleCardCarousel.querySelector(".carousel-inner").scrollLeft = scrollPosition;
      }
    });
  } else {
    multipleCardCarousel.classList.add("carousel-slide");
  }
});