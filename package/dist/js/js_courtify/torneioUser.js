function getTorneiosAbertosUser() {
  let dados = new FormData();
  dados.append("op", 1);

  $.ajax({
    url: "../../dist/php/controllerTorneioUser.php",
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

      let torneiosFutsal = obj.arrayTorneioFutsal;
      let torneiosBasquetebol = obj.arrayTorneioBasquetebol;
      let torneiosPadel = obj.arrayTorneioPadel;
      let torneiosTenis = obj.arrayTorneioTenis;

      if (torneiosFutsal.length > 0) {
        msg = "";
        nivel = "";

        let contIntermediario = 0;
        let contAvancado = 0;
        let contPrincipiante = 0;

        torneiosFutsal.forEach((el) => {
          nivel = el.nivelTorneio;

          if (nivel == "Intermediário") {
            contIntermediario++;
          } else if (nivel == "Avançado") {
            contAvancado++;
          } else {
            contPrincipiante++;
          }

          const dateParts = el.dataTorneio.split("-");
          const dataFormatada = `${dateParts[2]}/${dateParts[1]}`;

          const parteTempo = el.horaTorneio.split(":");
          const dataForm = `${parteTempo[0]}h:${parteTempo[1]}m`;

          const precoAtletaFormatado = el.precoAtletaTorneio.replace(".", ",");

          const finaldataFormatada = `${dataFormatada} ${dataForm}`;

          let generoTorneio = el.generoTorneio;
          generoTorneio = generoTorneio.charAt(0).toUpperCase() + generoTorneio.slice(1);

          msg += `<li class="list-group-item">
                                        <div class="card hover-img shadow position-relative">
                                        <div class="p-3 d-flex flex-column align-items-center justify-content-between mt-1">
                                            <img class="card-img-top img-fluid object-fit-cover" style="max-height: 330px;" src="${el.fotoTorneio}">
                                            <span class="fs-7 ms-2 ms-md-0 pt-1">${el.descricaoTorneio}</span>
                                            <div class="">
                                                <a href="./clube.php?id=${el.idClube}"><span class="fs-4"><i class="ti ti-building me-1"></i>${el.nomeClube}</span></a>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <span class="fs-2">Preço: <span class="fw-bolder fs-3">${precoAtletaFormatado}€</span></span>
                                                <span class="ms-2 badge text-dark fs-2 rounded-4 lh-sm py-1 px-2 fw-semibold me-2 fs-3" style="background-color: #f0f0f0">
                                                    <i class="ti ti-clock-hour-3 me-1"></i>${dataFormatada} (${dataForm})
                                                </span>
                                                <span class="fs-2">Género: <span class="fw-bolder fs-3">${generoTorneio}</span></span>
                                            </div>

                                            <span class="badge rounded-pill text-bg-danger position-absolute top-0 end-0 mt-2 me-2">
                                            <i class="ti ti-ball-football me-1"></i>
                                            <small>${el.modalidadeTorneio}</small>
                                            </span>
                                            
                                            <span class="fs-2 mt-3">Nº Inscrições: <span class="fw-bolder fs-4">${el.contagemAtletasTorneio}/${el.numEntradasTorneio}</span></span>

                                            <div class="mt-2 fs-3">
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalInscreverTorneio" onclick="getModalInscricaoTorneio(${el.idTorneio})">Inscrever</button>
                                            </div>
                                        </div>
                                        </div>
                                    </li>`;
        });

        $("#bodyTorneiosFutsalResultados").removeClass("d-none");

        if (contIntermediario > 0) {
          $("#torneiosFutsalIntermediario").html(msg);
        } else {
          $("#torneiosFutsalIntermediario").html(
            "<h5 class='mt-5'>Sem resultados!</h5>\n" +
            "<span>De momento não há torneios disponiveís para te juntares neste nível de dificuldade. Verifica mais tarde.</span>"
          );
        }

        if (contAvancado > 0) {
          $("#torneiosFutsalAvancado").html(msg);
        } else {
          $("#torneiosFutsalAvancado").html(
            "<h5 class='mt-5'>Sem resultados!</h5>\n" +
            "<span>De momento não há torneios disponiveís para te juntares neste nível de dificuldade. Verifica mais tarde.</span>"
          );
        }

        if (contPrincipiante > 0) {
          $("#torneiosFutsalPrincipiante").html(msg);
        } else {
          $("#torneiosFutsalPrincipiante").html(
            "<h5 class='mt-5'>Sem resultados!</h5>\n" +
            "<span>De momento não há torneios disponiveís para te juntares neste nível de dificuldade. Verifica mais tarde.</span>"
          );
        }
      } else {
        $("#bodyTorneiosFutsalSemResultados").removeClass("d-none");
      }

      if (torneiosBasquetebol.length > 0) {
        msg = "";
        nivel = "";

        let contIntermediario = 0;
        let contAvancado = 0;
        let contPrincipiante = 0;

        torneiosBasquetebol.forEach((el) => {
          nivel = el.nivelTorneio;

          if (nivel == "Intermediário") {
            contIntermediario++;
          } else if (nivel == "Avançado") {
            contAvancado++;
          } else {
            contPrincipiante++;
          }

          const dateParts = el.dataTorneio.split("-");
          const dataFormatada = `${dateParts[2]}/${dateParts[1]}`;

          const parteTempo = el.horaTorneio.split(":");
          const dataForm = `${parteTempo[0]}h:${parteTempo[1]}m`;

          const precoAtletaFormatado = el.precoAtletaTorneio.replace(".", ",");

          const finaldataFormatada = `${dataFormatada} ${dataForm}`;

          let generoTorneio = el.generoTorneio;
          generoTorneio = generoTorneio.charAt(0).toUpperCase() + generoTorneio.slice(1);

          msg += `<li class="list-group-item">
                                        <div class="card hover-img shadow position-relative">
                                        <div class="p-3 d-flex flex-column align-items-center justify-content-between mt-1">
                                            <img class="card-img-top img-fluid object-fit-cover" style="max-height: 330px;" src="${el.fotoTorneio}">
                                            <span class="fs-7 ms-2 ms-md-0 pt-1">${el.descricaoTorneio}</span>
                                            <div class="">
                                                <a href="./clube.php?id=${el.idClube}"><span class="fs-4"><i class="ti ti-building me-1"></i>${el.nomeClube}</span></a>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <span class="fs-2">Preço: <span class="fw-bolder fs-3">${precoAtletaFormatado}€</span></span>
                                                <span class="ms-2 badge text-dark fs-2 rounded-4 lh-sm py-1 px-2 fw-semibold me-2 fs-3" style="background-color: #f0f0f0">
                                                    <i class="ti ti-clock-hour-3 me-1"></i>${dataFormatada} (${dataForm})
                                                </span>
                                                <span class="fs-2">Género: <span class="fw-bolder fs-3">${generoTorneio}</span></span>
                                            </div>

                                            <span class="badge rounded-pill text-bg-danger position-absolute top-0 end-0 mt-2 me-2">
                                            <i class="ti ti-ball-football me-1"></i>
                                            <small>${el.modalidadeTorneio}</small>
                                            </span>
                                            
                                            <span class="fs-2 mt-3">Nº Inscrições: <span class="fw-bolder fs-4">0/${el.numEntradasTorneio}</span></span>

                                            <div class="mt-2 fs-3">
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalInscreverTorneio" onclick="getModalInscricaoTorneio(${el.idTorneio})">Inscrever</button>
                                            </div>
                                        </div>
                                        </div>
                                    </li>`;
          });

        $("#bodyTorneiosBasquetebolResultados").removeClass("d-none");

        if (contIntermediario > 0) {
            $("#torneiosBasquetebolIntermediario").html(msg);
        } else {
        $("#torneiosBasquetebolIntermediario").html(
            "<h5 class='mt-5'>Sem resultados!</h5>\n" +
            "<span>De momento não há torneios disponiveís para te juntares neste nível de dificuldade. Verifica mais tarde.</span>"
        );
        }

        if (contAvancado > 0) {
            $("#torneiosBasquetebolAvancado").html(msg);
        } else {
        $("#torneiosBasquetebolAvancado").html(
            "<h5 class='mt-5'>Sem resultados!</h5>\n" +
            "<span>De momento não há torneios disponiveís para te juntares neste nível de dificuldade. Verifica mais tarde.</span>"
        );
        }

        if (contPrincipiante > 0) {
            $("#torneiosBasquetebolPrincipiante").html(msg);
        } else {
        $("#torneiosBasquetebolPrincipiante").html(
            "<h5 class='mt-5'>Sem resultados!</h5>\n" +
            "<span>De momento não há torneios disponiveís para te juntares neste nível de dificuldade. Verifica mais tarde.</span>"
        );
        }
        
      } else {
        $("#bodyTorneiosBasquetebolSemResultados").removeClass("d-none");
      }

      if (torneiosPadel.length > 0) {
        msg = "";
        nivel = "";

        let contIntermediario = 0;
        let contAvancado = 0;
        let contPrincipiante = 0;

        torneiosPadel.forEach((el) => {
          nivel = el.nivelTorneio;

          if (nivel == "Intermediário") {
            contIntermediario++;
          } else if (nivel == "Avançado") {
            contAvancado++;
          } else {
            contPrincipiante++;
          }

          const dateParts = el.dataTorneio.split("-");
          const dataFormatada = `${dateParts[2]}/${dateParts[1]}`;

          const parteTempo = el.horaTorneio.split(":");
          const dataForm = `${parteTempo[0]}h:${parteTempo[1]}m`;

          const precoAtletaFormatado = el.precoAtletaTorneio.replace(".", ",");

          const finaldataFormatada = `${dataFormatada} ${dataForm}`;

          let generoTorneio = el.generoTorneio;
          generoTorneio = generoTorneio.charAt(0).toUpperCase() + generoTorneio.slice(1);

          msg += `<li class="list-group-item">
                                        <div class="card hover-img shadow position-relative">
                                        <div class="p-3 d-flex flex-column align-items-center justify-content-between mt-1">
                                            <img class="card-img-top img-fluid object-fit-cover" style="max-height: 330px;" src="${el.fotoTorneio}">
                                            <span class="fs-7 ms-2 ms-md-0 pt-1">${el.descricaoTorneio}</span>
                                            <div class="">
                                                <a href="./clube.php?id=${el.idClube}"><span class="fs-4"><i class="ti ti-building me-1"></i>${el.nomeClube}</span></a>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <span class="fs-2">Preço: <span class="fw-bolder fs-3">${precoAtletaFormatado}€</span></span>
                                                <span class="ms-2 badge text-dark fs-2 rounded-4 lh-sm py-1 px-2 fw-semibold me-2 fs-3" style="background-color: #f0f0f0">
                                                    <i class="ti ti-clock-hour-3 me-1"></i>${dataFormatada} (${dataForm})
                                                </span>
                                                <span class="fs-2">Género: <span class="fw-bolder fs-3">${generoTorneio}</span></span>
                                            </div>

                                            <span class="badge rounded-pill text-bg-danger position-absolute top-0 end-0 mt-2 me-2">
                                            <i class="ti ti-ball-football me-1"></i>
                                            <small>${el.modalidadeTorneio}</small>
                                            </span>
                                            
                                            <span class="fs-2 mt-3">Nº Inscrições: <span class="fw-bolder fs-4">0/${el.numEntradasTorneio}</span></span>

                                            <div class="mt-2 fs-3">
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalInscreverTorneio" onclick="getModalInscricaoTorneio(${el.idTorneio})">Inscrever</button>
                                            </div>
                                        </div>
                                        </div>
                                    </li>`;
          });

        $("#bodyTorneiosPadelResultados").removeClass("d-none");

        if (contIntermediario > 0) {
            $("#torneiosPadelIntermediario").html(msg);
        } else {
        $("#torneiosPadelIntermediario").html(
            "<h5 class='mt-5'>Sem resultados!</h5>\n" +
            "<span>De momento não há torneios disponiveís para te juntares neste nível de dificuldade. Verifica mais tarde.</span>"
        );
        }

        if (contAvancado > 0) {
            $("#torneiosPadelAvancado").html(msg);
        } else {
        $("#torneiosPadelAvancado").html(
            "<h5 class='mt-5'>Sem resultados!</h5>\n" +
            "<span>De momento não há torneios disponiveís para te juntares neste nível de dificuldade. Verifica mais tarde.</span>"
        );
        }

        if (contPrincipiante > 0) {
            $("#torneiosPadelPrincipiante").html(msg);
        } else {
        $("#torneiosPadelPrincipiante").html(
            "<h5 class='mt-5'>Sem resultados!</h5>\n" +
            "<span>De momento não há torneios disponiveís para te juntares neste nível de dificuldade. Verifica mais tarde.</span>"
        );
        }
      } else {
        $("#bodyTorneiosPadelSemResultados").removeClass("d-none");
      }

      if (torneiosTenis.length > 0) {
        msg = "";
        nivel = "";

        let contIntermediario = 0;
        let contAvancado = 0;
        let contPrincipiante = 0;

        torneiosTenis.forEach((el) => {
          nivel = el.nivelTorneio;
          if (nivel == "Intermediário") {
            contIntermediario++;
          } else if (nivel == "Avançado") {
            contAvancado++;
          } else {
            contPrincipiante++;
          }

          const dateParts = el.dataTorneio.split("-");
          const dataFormatada = `${dateParts[2]}/${dateParts[1]}`;

          const parteTempo = el.horaTorneio.split(":");
          const dataForm = `${parteTempo[0]}h:${parteTempo[1]}m`;

          const precoAtletaFormatado = el.precoAtletaTorneio.replace(".", ",");

          const finaldataFormatada = `${dataFormatada} ${dataForm}`;

          let generoTorneio = el.generoTorneio;
          generoTorneio = generoTorneio.charAt(0).toUpperCase() + generoTorneio.slice(1);

          msg += `<li class="list-group-item">
                                        <div class="card hover-img shadow position-relative">
                                        <div class="p-3 d-flex flex-column align-items-center justify-content-between mt-1">
                                            <img class="card-img-top img-fluid object-fit-cover" style="max-height: 330px;" src="${el.fotoTorneio}">
                                            <span class="fs-7 ms-2 ms-md-0 pt-1">${el.descricaoTorneio}</span>
                                            <div class="">
                                                <a href="./clube.php?id=${el.idClube}"><span class="fs-4"><i class="ti ti-building me-1"></i>${el.nomeClube}</span></a>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <span class="fs-2">Preço: <span class="fw-bolder fs-3">${precoAtletaFormatado}€</span></span>
                                                <span class="ms-2 badge text-dark fs-2 rounded-4 lh-sm py-1 px-2 fw-semibold me-2 fs-3" style="background-color: #f0f0f0">
                                                    <i class="ti ti-clock-hour-3 me-1"></i>${dataFormatada} (${dataForm})
                                                </span>
                                                <span class="fs-2">Género: <span class="fw-bolder fs-3">${generoTorneio}</span></span>
                                            </div>

                                            <span class="badge rounded-pill text-bg-danger position-absolute top-0 end-0 mt-2 me-2">
                                            <i class="ti ti-ball-football me-1"></i>
                                            <small>${el.modalidadeTorneio}</small>
                                            </span>
                                            
                                            <span class="fs-2 mt-3">Nº Inscrições: <span class="fw-bolder fs-4">0/${el.numEntradasTorneio}</span></span>

                                            <div class="mt-2 fs-3">
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalInscreverTorneio" onclick="getModalInscricaoTorneio(${el.idTorneio})">Inscrever</button>
                                            </div>
                                        </div>
                                        </div>
                                    </li>`;
          });

        $("#bodyTorneiosTenisResultados").removeClass("d-none");

        if (contIntermediario > 0) {
            $("#torneiosTenisIntermediario").html(msg);
        } else {
        $("#torneiosTenisIntermediario").html(
            "<h5 class='mt-5'>Sem resultados!</h5>\n" +
            "<span>De momento não há torneios disponiveís para te juntares neste nível de dificuldade. Verifica mais tarde.</span>"
        );
        }

        if (contAvancado > 0) {
            $("#torneiosTenisAvancado").html(msg);
        } else {
        $("#torneiosTenisAvancado").html(
            "<h5 class='mt-5'>Sem resultados!</h5>\n" +
            "<span>De momento não há torneios disponiveís para te juntares neste nível de dificuldade. Verifica mais tarde.</span>"
        );
        }

        if (contPrincipiante > 0) {
            $("#torneiosTenisPrincipiante").html(msg);
        } else {
        $("#torneiosTenisPrincipiante").html(
            "<h5 class='mt-5'>Sem resultados!</h5>\n" +
            "<span>De momento não há torneios disponiveís para te juntares neste nível de dificuldade. Verifica mais tarde.</span>"
        );

        }
      } else {
        $("#bodyTorneiosTenisSemResultados").removeClass("d-none");
      }
    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}

function getModalInscricaoTorneio(idTorneio) {
    $("#modalInscreverTorneio").html(`<div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content" >
                                        <div class="modal-header d-flex align-items-center">
                                            <div class='d-flex'>
                                                <img src="../../dist/images/logos/favicon.ico" alt="" height="40" width="40" class="mt-2 ms-2">
                                                <h4 class="mb-0 mt-2 ms-2 fs-7 p-1">Inscrição Torneio</h4>
                                            </div>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                        <span class="fs-5">Estás prestes a a juntar-te a este Torneio.<br></span>
                                        <span class="fs-3">Caso o faças, poderás sempre cancelar antes de o mesmo começar.</span>
                                        <h5 class='mt-3'>Juntar?</h5>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary text-white font-medium waves-effect text-start" data-bs-dismiss="modal" onclick="juntarTorneio(${idTorneio})">
                                            Sim
                                            </button>
                                            <button type="button" class="btn btn-light text-primary font-medium waves-effect text-start" data-bs-dismiss="modal">
                                            Fechar
                                            </button>
                                        </div>
                                        </div>
                                    </div>`);
}

function juntarTorneio(idTorneio) {
    
    let dados = new FormData();
    dados.append("op", 2);
    dados.append("idTorneio", idTorneio);

    $.ajax({
        url: "../../dist/php/controllerTorneioUser.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })

    .done(function (msg) {
        let obj = JSON.parse(msg);
        alerta2(obj.title, obj.msg, obj.icon);
        setTimeout(function () {
            window.location.href = "./hub-torneios.php";
        }, 3000);
    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    })
}



$(function () {
  getTorneiosAbertosUser();
});
