getMarcacoesAbertas();
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

});
