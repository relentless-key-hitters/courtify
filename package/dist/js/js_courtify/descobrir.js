function getMarcacoesAbertas() {
  let dados = new FormData();
  dados.append("op", 1);

  $.ajax({
      url: "../../dist/php/controllerDescobrir.php",
      method: "POST",
      data: dados,
      dataType: "html",
      cache: false,
      contentType: false,
      processData: false
      })

      .done(function(msg) {
        $("#marcacaoLocalidade").html(msg);
      })
      
      .fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
      });
}




$(function () {

    $('.animated-text').addClass('show');

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