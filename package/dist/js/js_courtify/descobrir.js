
function getMarcacoesAbertasModalidades() {

  let dados = new FormData();
  dados.append("op", 2);


  $.ajax({
    url: "../../dist/php/controllerDescobrir.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
  })

    .done(function (msg) {
      let obj = JSON.parse(msg);
      console.log(obj.msg)
      $("#quantidadeMarcacoesModalidades").text(obj.contagem);

      if(obj.msg == "<div class='text-center mt-3 mb-3'><span class='fs-6 fw-bold'>Sem resultados!</span><p>De momento não existem marcações abertas que se apliquem a este contexto. Verifica mais tarde!</p></div>") {
        $("#cardCarousel2").html(obj.msg);
      } else {
        $("#marcacaoModalidades").html(obj.msg)
      }
    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}
getMarcacoesAbertasModalidades();

function getMarcacoesAbertasLocalidade() {

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

    .done(function (msg) {
      let obj = JSON.parse(msg);
      $("#quantidadeMarcacoesLocalidade").text(obj.contagem);
      $("#localidadeUser").text(obj.localidadeUser);

      if(obj.msg == "<div class='text-center mt-3 mb-3'><span class='fs-6 fw-bold'>Sem resultados!</span><p>De momento não existem marcações abertas que se apliquem a este contexto. Verifica mais tarde!</p></div>") {
        $("#cardCarousel3").html(obj.msg);
      } else {
        $("#marcacaoLocalidade").html(obj.msg)
      }
      
    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}
getMarcacoesAbertasLocalidade();



$(function () {
  $(".owl-carousel").each(function() {
    $(this).owlCarousel({
      loop: false,
      margin: 40,
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
});
