function getAmigos() {

    let urlParams = new URLSearchParams(window.location.search);
    let userId = urlParams.get('id');

    let dados = new FormData();
    dados.append("op", 1);
    dados.append("userId", userId);
  
    $.ajax({
      url: "../../dist/php/controllerAmigos.php",
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

$(function () {
  getAmigos();
});