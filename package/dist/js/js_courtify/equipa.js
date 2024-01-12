function getEquipasUser(){
    let dados = new FormData();
    dados.append("op", 1);
  
    $.ajax({
      url: "../../dist/php/controllerEquipa.php",
      method: "POST",
      data: dados,
      dataType: "html",
      cache: false,
      contentType: false,
      processData: false,
    })
  
      .done(function (msg) {
        $("#equipasUser").html(msg);
      })
  
      .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
      });
}

function getEquipasLocalidadeUser(){
  let dados = new FormData();
  dados.append("op", 2);

  $.ajax({
    url: "../../dist/php/controllerEquipa.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false,
  })

    .done(function (msg) {
      let obj = JSON.parse(msg)
      $("#equipasLocalidade").html(obj.msg);
      $("#localidadeUserEquipa").html(obj.localidade)
    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });


}

$(function () {
  getEquipasUser();
  getEquipasLocalidadeUser();
});