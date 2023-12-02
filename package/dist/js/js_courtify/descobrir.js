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
    processData: false,
  })

    .done(function (msg) {
      console.log(msg);
      $("#marcacaoModalidades").html(msg.trim());
    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}

$(function () {
  getMarcacoesAbertas();
  $(".animated-text").addClass("show");

  $(".owl-carousel").each(function () {
    var carouselId = $(this).closest(".carousel-container").attr("id");
    $(this).owlCarousel({
      loop: true,
      margin: 20,
      dots: true,
      autoplay: true,
      autoplayTimeout: 5000,
      autoplayHoverPause: true,
      responsive: {
        0: {
          items: 1,
        },
        768: {
          items: 2,
        },
        1200: {
          items: 3,
        },
      },
    });
  });

  $("[data-toggle = 'tooltip']").tooltip();
});
