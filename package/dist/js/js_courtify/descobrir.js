$(function () {
    

    $(".owl-carousel").each(function () {
        var carouselId = $(this).closest(".carousel-container").attr("id");
        $(this).owlCarousel({
          margin: 20,
          loop: true,
          nav: false,
          autoplay: true,
          autoplayHoverPause: true,
          responsive: {
            0: {
              items: 1
            },
            768: {
              items: 1
            },
            992: {
              items: 3
            }
          }
        });
      });
});