function getGruposUser() {
  let dados = new FormData();
  dados.append("op", 2);

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
    $("#gruposUser").html(msg);
  })

  .fail(function (jqXHR, textStatus) {
    alert("Request failed: " + textStatus);
  })
}

function getMarcacoesAbertasGrupos() {
  let dados = new FormData();
  dados.append("op", 1);

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
    $("#quantidadeMarcacoesGrupos").text(obj.contagem);

    if (
      obj.msg ==
      "<div class='text-center mt-3 mb-3'><span class='fs-6 fw-bold'>Sem resultados!</span><p>De momento não existem marcações abertas que se apliquem a este contexto. Verifica mais tarde!</p></div>"
    ) {
      $("#cardCarousel4").html(obj.msg);
    } else {
      $("#marcacaoGrupos").html(obj.msg);
    }

    setTimeout(function () {
      $(".owl-carousel").each(function () {
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
    }, 1000);
  })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}
getMarcacoesAbertasGrupos();

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
    $("#atletasGrupo").html(obj.msg);
    $("#totalMembros").html(obj.total);

    adicionarLinksPaginacaoAtletasGrupo(obj.paginasTotais, obj.paginaAtual);
  })

  .fail(function (jqXHR, textStatus) {
    alert("Request failed: " + textStatus);
  });
}

function adicionarLinksPaginacaoAtletasGrupo(paginasTotais, paginaAtual) {
  let msgHtml = "<nav aria-label='Page navigation example' class='d-flex justify-content-end'>";
  msgHtml += "<ul class='pagination bg-light me-3'>";


  msgHtml += "<li class='page-item " + (paginaAtual === 1 ? "disabled" : "") + "'>";
  msgHtml += "<a class='fs-1 page-link link' href='#' data-page='" + (paginaAtual - 1) + "'><i class='fas fa-angle-left'></i></a>";
  msgHtml += "</li>";


  const maximoBotoesPagina = 3;

  // Calcular as páginas iniciaius e finais a mostrar consoant a restrição
  let paginaInicio = Math.max(1, paginaAtual - Math.floor(maximoBotoesPagina / 2));
  let paginaFim = Math.min(paginasTotais, paginaInicio + maximoBotoesPagina - 1);
  
  // Ajustar a página inicial se esta ultrapassar o intervalo válido
  paginaInicio = Math.max(1, paginaFim - maximoBotoesPagina + 1);
  
  // Botões da página
  for (let i = paginaInicio; i <= paginaFim; i++) {
      msgHtml += "<li class='page-item " + (i === paginaAtual ? "active" : "") + "'>";
      msgHtml += "<a class='fs-1 page-link link' href='#' data-page='" + i + "'>" + i + "</a>";
      msgHtml += "</li>";
  }


  msgHtml += "<li class='page-item " + (paginaAtual === paginasTotais ? "disabled" : "") + "'>";
  msgHtml += "<a class='fs-1 page-link link' href='#' data-page='" + (paginaAtual + 1) + "'><i class='fas fa-angle-right'></i></a>";
  msgHtml += "</li>";

  msgHtml += "</ul></nav>";

  $("#paginacaoAtletasGrupo").html(msgHtml);

  // Event listener para os botões da página que redirecionam para outras páginas para impedir o recarregamento da página
  $(".page-link.link").on("click", function(event) {
      event.preventDefault();
      let paginaClicada = $(this).data("page");
      getAtletasGrupo(paginaClicada);
  });
}

$(function () {
  getGruposUser();
  getAtletasGrupo(1);

});
