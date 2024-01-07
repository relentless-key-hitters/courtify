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
            "</div>" +
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

function getMarcacoesConcluidasGrupo(pagina) {
  let urlParams = new URLSearchParams(window.location.search);
  let id = urlParams.get("id");

  let dados = new FormData();
  dados.append("op", 5);
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
      let obj = JSON.parse(msg)
      $("#marcacoesConcluidasGrupo").html(obj.msg);

      adicionarLinksPaginacaoMarcacoesConcluidas(obj.paginasTotais, obj.paginaAtual);
    })

    .fail(function (jqXHR, textStatus) {});
}

function adicionarLinksPaginacaoMarcacoesConcluidas(paginasTotais, paginaAtual) {
  let msgHtml =
    "<nav aria-label='Page navigation example' class='d-flex justify-content-end'>";
  msgHtml += "<ul class='pagination bg-light me-3'>";

  msgHtml +=
    "<li class='page-item " + (paginaAtual === 1 ? "disabled" : "") + "'>";
  msgHtml +=
    "<a class='fs-1 page-link link' href='#' data-page='" +
    (paginaAtual - 1) +
    "'>Anterior</a>";
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
    "'>Próximo</a>";
  msgHtml += "</li>";

  msgHtml += "</ul></nav>";

  $("#paginacaoMarcacoesConcluidas").html(msgHtml);

  // Event listener para os botões da página que redirecionam para outras páginas para impedir o recarregamento da página
  $(".page-link.link").on("click", function (event) {
    event.preventDefault();
    let paginaClicada = $(this).data("page");
    getMarcacoesConcluidasGrupo(paginaClicada);
  });
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
      let obj = JSON.parse(msg);
      console.log(obj);

      if (obj.userIsHost) {
        $("#botoesAdmin").html(
          "<div class='d-flex justify-content-between gap-2 mb-3'>" +
            "<button class='btn btn-outline-success w-75' data-bs-toggle='modal' data-bs-target='#modalEditarGrupo'>Editar<i class='ti ti-pencil ms-1'></i></button>" +
            "<button class='btn btn-outline-danger w-75' data-bs-toggle='modal' data-bs-target='#modalApagarGrupo'>Apagar<i class='ms-1 ti ti-x'></i></button>" +
            "</div>" +
            "<button class='btn btn-outline-primary w-50' data-toggle='tooltip' data-placement='top' title='Visualiza e edita os Membros do Grupo' data-bs-toggle='modal' data-bs-target='#modalEditMembrosGrupo' onclick='getMembrosGrupo()'>Membros<i class='ms-1 ti ti-pencil'></i></button>"
        );
      } else {
        if (obj.userIsMember) {
          $("#botoesNonAdmin").html(
            "<button class='btn btn-lg btn-outline-danger w-100 mb-3' id='botaoSairGrupo' data-bs-toggle='modal' data-bs-target='#modalSairGrupo'>Sair<i class='ms-1 ti ti-x'></i></button>"
          );
        } else if(obj.userIsPending) {
          $("#botoesNonAdmin").html(
            "<button disabled class='btn btn-lg btn-primary w-100 mb-3'>Pendente<i class='ms-1 ti ti-clock'></i></button>"
          );
        } else {
          $("#botoesNonAdmin").html(
            "<button class='btn btn-lg btn-primary w-100 mb-3' id='botaoJuntarGrupo' data-bs-toggle='modal' data-bs-target='#modalJuntarGrupo'>Juntar<i class='ms-1 ti ti-plus'></i></button>"
          );
        }

        $("#botoesAdmin").hide();
      }
    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}

function sairGrupo() {
  let urlParams = new URLSearchParams(window.location.search);
  let id = urlParams.get("id");

  let dados = new FormData();
  dados.append("op", 8);
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
      alerta2("Sucesso", msg, "success");
      setTimeout(function () {
        window.location.reload();
      }, 3000);
    })

    .fail(function (jqXHR, textStatus) {});
}

function juntarGrupo() {
  let urlParams = new URLSearchParams(window.location.search);
  let id = urlParams.get("id");

  let dados = new FormData();
  dados.append("op", 9);
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
      alerta2("Sucesso", msg, "success");
      setTimeout(function () {
        window.location.reload();
      }, 3000);
    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}

function previewImagem() {
  let input = document.getElementById("imgGrupoEdit");
  let image = document.getElementById("imgGrupo");

  let file = input.files[0];

  if (file) {
    let reader = new FileReader();

    reader.onload = function (e) {
      image.src = e.target.result;
    };

    reader.readAsDataURL(file);
  }
}

function getInfoEditGrupo() {
  let urlParams = new URLSearchParams(window.location.search);
  let id = urlParams.get("id");

  let dados = new FormData();
  dados.append("op", 10);
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
      $("#bodyModalEditarGrupo").html(msg);
    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}

function guardaEditGrupo() {
  let urlParams = new URLSearchParams(window.location.search);
  let id = urlParams.get("id");

  let dados = new FormData();
  dados.append("op", 11);
  dados.append("idGrupo", id);
  dados.append("nomeGrupo", $("#nomeGrupoEdit").val());
  dados.append("descricaoGrupo", $("#descricaoGrupoEdit").val());
  var fileInput = $("#imgGrupoEdit")[0]; 
  var selectedFile = fileInput.files[0];

  if (selectedFile) {
    
    dados.append("imagemGrupo", selectedFile);
  } else {
    
    var existingImageSrc = $("#imgGrupo").prop("src");
    dados.append("imagemGrupo", existingImageSrc);
  }

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
      alerta2("Sucesso", obj.msg, obj.icon);
      setTimeout(function () {
        window.location.reload();
      }, 3000);
    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}

function apagarGrupo() {
  let urlParams = new URLSearchParams(window.location.search);
  let id = urlParams.get("id");

  let dados = new FormData();
  dados.append("op", 12);
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
    alerta2(obj.title, obj.msg, obj.icon);
    setTimeout(function () {
      window.location.href = "./hub-grupos.php";
    }, 3000);
  })

  .fail(function (jqXHR, textStatus) {
    alert("Request failed: " + textStatus);
  })
}

function getMembrosGrupo() {
  let urlParams = new URLSearchParams(window.location.search);
  let id = urlParams.get("id");

  let dados = new FormData();
  dados.append("op", 13);
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
    $("#listaMembrosGrupo").html(msg);
  })

  .fail(function (jqXHR, textStatus) {
    alert("Request failed: " + textStatus);
  })
}

function removerMembroGrupo(id) {
  let urlParams = new URLSearchParams(window.location.search);
  let idGrupo = urlParams.get("id");

  let dados = new FormData();
  dados.append("op", 14);
  dados.append("idUser", id);
  dados.append("idGrupo", idGrupo);

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
    alerta2(obj.title, obj.msg, obj.icon);
    setTimeout(function () {
      window.location.reload();
    }, 3000);
    
  })

  .fail(function (jqXHR, textStatus) {
    alert("Request failed: " + textStatus);
  })
}

$("#modalEditarGrupo").on("hidden.bs.modal", function () {
  var image = document.getElementById("imgGrupo");
  image.src = "../../dist/images/backgrounds/g.png";

  document.getElementById("imgGrupoEdit").value = "";
});

function alerta2(titulo, msg, icon) {
  Swal.fire({
    position: "center",
    icon: icon,
    title: titulo,
    text: msg,
    showConfirmButton: false,
    confirmButtonColor: "#45702d",
    timer: 3000,
  });
}

function getEstatisticasGrupo(){
  let urlParams = new URLSearchParams(window.location.search);
  let id = urlParams.get("id");
  let dados = new FormData();
  dados.append("op", 16);
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
    if(obj.length == 3){
      $("#estVitorias").html("<span class='fs-5'>" + obj[0] + "%</span>");
      $("#estSets").html("<span class='fs-5'>" + obj[1] + "%</span>");
      $("#estMvp").html("<span class='fs-5'>" + obj[2] + "%</span>")
    }else{
      $("#cardSets").addClass("d-none");
      $("#estVitorias").html("<span class='fs-5'>" + obj[0] + "%</span>");
      $("#estMvp").html("<span class='fs-5'>" + obj[1] + "%</span>");
    }
    
  })

  .fail(function (jqXHR, textStatus) {
    alert("Request failed: " + textStatus);
  })
}

$(function () {
  getBotoesMenus();
  getAtletasGrupo(1);
  getInfoGrupo();
  getMarcacoesConcluidasGrupo(1);
  getBadgesGrupo();
  getInfoEditGrupo();
  getEstatisticasGrupo();
});
