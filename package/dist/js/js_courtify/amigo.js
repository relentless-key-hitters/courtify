function getAmigos() {

    let urlParams = new URLSearchParams(window.location.search);
    let userId = urlParams.get('id');

    let dados = new FormData();
    dados.append("op", 1);
    dados.append("userId", userId);
  
    $.ajax({
      url: "../../dist/php/controllerAmigo.php",
      method: "POST",
      data: dados,
      dataType: "html",
      cache: false,
      contentType: false,
      processData: false
    })

    .done(function (msg) {
      let obj = JSON.parse(msg);
      $("#contagemAmigos").html(obj.contagem);
      $("#amigosUtilizador").html(obj.msg);
    })
  
    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}

function procurarAmigos() {

  let urlParams = new URLSearchParams(window.location.search);
  let userId = urlParams.get('id');

  let dados = new FormData();
  dados.append("op", 2);
  dados.append("userId", userId);
  dados.append("stringPesquisa", $("#pesquisaAmigos").val());

  $.ajax({
    url: "../../dist/php/controllerAmigo.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
  })

  .done(function (msg) {
    console.log(msg);
    $("#amigosUtilizador").html(msg);
  })

  .fail(function (jqXHR, textStatus) {
    alert("Request failed: " + textStatus);
  });

}

$(function () {
  getAmigos();

  $("#pesquisaAmigos").keypress(function (event) {
    if (event.which === 13) { //13 é o código da tecla Enter
      procurarAmigos();
    }
  });
});