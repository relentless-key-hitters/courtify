
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
    processData: false,
  })

    .done(function (msg) {
      $("#marcacaoModalidades").html(msg)
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
    processData: false,
  })

    .done(function (msg) {
      let obj = JSON.parse(msg);
      $("#localidadeUser").text(obj.localidadeUser);
      $("#marcacaoLocalidade").html(obj.msg)
      
    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}
getMarcacoesAbertasLocalidade();

$(function () {
  
});
