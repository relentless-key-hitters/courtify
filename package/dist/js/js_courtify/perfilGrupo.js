function getAtletasGrupo(pagina) {
  let urlParams = new URLSearchParams(window.location.search);
  let id = urlParams.get("id");

  let dados = new FormData();
  dados.append("op", 3);
  dados.append("idGrupo", id);
  dados.append("pagina", pagina);

  $.ajax({
    url: "../../dist/php/controllerGrupo.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false,
  })

    .done(function (msg) {
      let obj = JSON.parse(msg);
      console.log(obj);
      $("#totalMembros").html(obj.total);
      let msgSemResults = "";

      if (obj.total != 0) {
        let placeholdersCount = Math.max(12 - obj.total, 0);

        for (let i = 0; i < placeholdersCount; i++) {
          msgSemResults +=
            "<div class='col-2'>" +
            "<img src='../../dist/images/utilizadores/user_vazio.png' alt='Bloqueado'" +
            " class='rounded-circle mb-0' style='max-width: 50px;' data-toggle='tooltip' data-placement='top' title='Vazio'>" +
            "</div>";
        }

        $("#atletasGrupo").html(obj.msg + msgSemResults);
      } else {
        for (let i = 0; i < 12; i++) {
          msgSemResults +=
            "<div class='col-2'>" +
            "<img src='../../dist/images/utilizadores/user_vazio.png' alt='Bloqueado'" +
            " class='rounded-circle mb-0' style='max-width: 50px;' data-toggle='tooltip' data-placement='top' title='Vazio'>" +
            "</div>";
        }
        $("#atletasGrupo").html(msgSemResults);
      }

      adicionarLinksPaginacaoAtletasGrupo(obj.paginasTotais, obj.paginaAtual);
    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}

function adicionarLinksPaginacaoAtletasGrupo(paginasTotais, paginaAtual) {
  let msgHtml =
    "<nav aria-label='Page navigation example' class='d-flex justify-content-end'>";
  msgHtml += "<ul class='pagination bg-light me-3'>";

  msgHtml +=
    "<li class='page-item " + (paginaAtual === 1 ? "disabled" : "") + "'>";
  msgHtml +=
    "<a class='fs-1 page-link link' href='#' data-page='" +
    (paginaAtual - 1) +
    "'><i class='fas fa-angle-left'></i></a>";
  msgHtml += "</li>";

  const maximoBotoesPagina = 3;

  // Calcular as páginas iniciaius e finais a mostrar consoant a restrição
  let paginaInicio = Math.max(
    1,
    paginaAtual - Math.floor(maximoBotoesPagina / 2)
  );
  let paginaFim = Math.min(
    paginasTotais,
    paginaInicio + maximoBotoesPagina - 1
  );

  // Ajustar a página inicial se esta ultrapassar o intervalo válido
  paginaInicio = Math.max(1, paginaFim - maximoBotoesPagina + 1);

  // Botões da página
  for (let i = paginaInicio; i <= paginaFim; i++) {
    msgHtml +=
      "<li class='page-item " + (i === paginaAtual ? "active" : "") + "'>";
    msgHtml +=
      "<a class='fs-1 page-link link' href='#' data-page='" +
      i +
      "'>" +
      i +
      "</a>";
    msgHtml += "</li>";
  }

  msgHtml +=
    "<li class='page-item " +
    (paginaAtual === paginasTotais ? "disabled" : "") +
    "'>";
  msgHtml +=
    "<a class='fs-1 page-link link' href='#' data-page='" +
    (paginaAtual + 1) +
    "'><i class='fas fa-angle-right'></i></a>";
  msgHtml += "</li>";

  msgHtml += "</ul></nav>";

  $("#paginacaoAtletasGrupo").html(msgHtml);

  // Event listener para os botões da página que redirecionam para outras páginas para impedir o recarregamento da página
  $(".page-link.link").on("click", function (event) {
    event.preventDefault();
    let paginaClicada = $(this).data("page");
    getAtletasGrupo(paginaClicada);
  });
}

function getInfoGrupo() {
  let urlParams = new URLSearchParams(window.location.search);
  let id = urlParams.get("id");

  let dados = new FormData();
  dados.append("op", 4);
  dados.append("idGrupo", id);

  $.ajax({
    url: "../../dist/php/controllerGrupo.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false,
  })

    .done(function (msg) {
      $("#infoGrupo").html(msg);
    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}

function getMarcacoesConcluidasGrupo() {
  let urlParams = new URLSearchParams(window.location.search);
  let id = urlParams.get("id");

  let dados = new FormData();
  dados.append("op", 5);
  dados.append("idGrupo", id);

  $.ajax({
    url: "../../dist/php/controllerGrupo.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false,
  })

    .done(function (msg) {
      $("#marcacoesConcluidasGrupo").html(msg);
    })

    .fail(function (jqXHR, textStatus) {});
}

function getBadgesGrupo() {
  let urlParams = new URLSearchParams(window.location.search);
  let id = urlParams.get("id");

  let dados = new FormData();
  dados.append("op", 6);
  dados.append("idGrupo", id);

  $.ajax({
    url: "../../dist/php/controllerGrupo.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false,
  })

    .done(function (msg) {
      let obj = JSON.parse(msg);
      $("#badgesGrupo").html(obj.msg);
      $("#totalBadges").html(obj.total);
    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}

function getBotoesMenus() {
  let urlParams = new URLSearchParams(window.location.search);
  let id = urlParams.get("id");

  let dados = new FormData();
  dados.append("op", 7);
  dados.append("idGrupo", id);

  $.ajax({
    url: "../../dist/php/controllerGrupo.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false,
  })

    .done(function (msg) {
      let obj = JSON.parse(msg)
      console.log(obj);

      if(obj.userIsHost) {
        $("#botoesNonAdmin").hide();
        $("#botoesAdmin").show();
      } else {
        if(obj.userIsMember) {
          $("#botaoJuntarGrupo").hide();
          $("#botaoSairGrupo").show();
        } else {
          $("#botaoJuntarGrupo").show();
          $("#botaoSairGrupo").hide();
        }

        $("#botoesAdmin").hide();
      }
    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}

$(function () {
  getBotoesMenus();
  getAtletasGrupo(1);
  getInfoGrupo();
  getMarcacoesConcluidasGrupo();
  getBadgesGrupo();
});
