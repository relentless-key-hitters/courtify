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
        processData: false
    })

    .done(function (msg) {
        let obj = JSON.parse(msg);
        console.log(obj);
        let torneiosFutsal = obj.arrayTorneioFutsal;
        let torneiosBasquetebol = obj.arrayTorneioBasquetebol;
        let torneiosPadel = obj.arrayTorneioPadel;
        let torneiosTenis = obj.arrayTorneioTenis;

        if(torneiosFutsal.length > 0){
            msg = "";
            nivel = "";
            torneiosFutsal.forEach(el => {
                nivel = el.nivelTorneio;
                const dateParts = el.dataTorneio.split('-');
                const formattedDate = `${dateParts[1]}/${dateParts[2]}`;

                // Assuming el.horaTorneio is in "HH:MM:SS" format
                const timeParts = el.horaTorneio.split(':');
                const formattedTime = `${timeParts[0]}:${timeParts[1]}`;

                // Final formatted strings
                const finalFormattedDate = `${formattedDate} ${formattedTime}`;

                msg += `<li class="list-group-item">
                                        <div class="card hover-img shadow position-relative">
                                        <div class="p-3 d-flex flex-column align-items-center justify-content-between mt-1">
                                            <img class="card-img-top object-fit-cover" src="${el.fotoTorneio}">
                                            <span class="fs-8 ms-2 ms-md-0 pt-1">${el.descricaoTorneio}</span>

                                            <div class="d-flex align-items-center mt-2">
                                            <span class="badge text-dark fs-2 rounded-4 lh-sm py-1 px-2 fw-semibold me-2 fs-4" style="background-color: #f0f0f0">
                                                <i class="ti ti-clock-hour-3 me-1"></i>${formattedDate} (${formattedTime})
                                            </span>
                                            </div>

                                            <span class="badge rounded-pill text-bg-danger position-absolute top-0 end-0 mt-2 me-2">
                                            <i class="ti ti-ball-football me-1"></i>
                                            <small>${el.modalidadeTorneio}</small>
                                            </span>

                                            <span class="mt-3 fs-3">
                                            <td class="bg-transparent">
                                                <a href="" class="btn btn-success">Inscrever</a>
                                            </td>
                                            </span>
                                        </div>
                                        </div>
                                    </li>`;
            });

            if(nivel == "Intermediário") {
                $("#torneiosFutsalIntermediario").html(msg);
            } else if (nivel == "Avançado") {
                $("#torneiosFutsalAvancado").html(msg);
            } else {
                $("#torneiosFutsalPrincipiante").html(msg);
            }

        } else {
            msg = "";

            $("#torneiosFutsalIntermediario").html(msg);
            $("#torneiosFutsalAvancado").html(msg);
            $("#torneiosFutsalPrincipiante").html(msg);
        }


        if(torneiosBasquetebol.length > 0){
            msg = "";
            nivel = "";
            torneiosBasquetebol.forEach(el => {
                nivel = el.nivelTorneio;
                const dateParts = el.dataTorneio.split('-');
                const formattedDate = `${dateParts[1]}/${dateParts[2]}`;

                // Assuming el.horaTorneio is in "HH:MM:SS" format
                const timeParts = el.horaTorneio.split(':');
                const formattedTime = `${timeParts[0]}:${timeParts[1]}`;

                // Final formatted strings
                const finalFormattedDate = `${formattedDate} ${formattedTime}`;

                msg += `<li class="list-group-item">
                                        <div class="card hover-img shadow position-relative">
                                        <div class="p-3 d-flex flex-column align-items-center justify-content-between mt-1">
                                            <img class="card-img-top object-fit-cover" src="${el.fotoTorneio}">
                                            <span class="fs-8 ms-2 ms-md-0 pt-1">${el.descricaoTorneio}</span>

                                            <div class="d-flex align-items-center mt-2">
                                            <span class="badge text-dark fs-2 rounded-4 lh-sm py-1 px-2 fw-semibold me-2 fs-4" style="background-color: #f0f0f0">
                                                <i class="ti ti-clock-hour-3 me-1"></i>${formattedDate} (${formattedTime})
                                            </span>
                                            </div>

                                            <span class="badge rounded-pill text-bg-danger position-absolute top-0 end-0 mt-2 me-2">
                                            <i class="ti ti-ball-football me-1"></i>
                                            <small>${el.modalidadeTorneio}</small>
                                            </span>

                                            <span class="mt-3 fs-3">
                                            <td class="bg-transparent">
                                                <a href="" class="btn btn-success">Inscrever</a>
                                            </td>
                                            </span>
                                        </div>
                                        </div>
                                    </li>`;
            });

            if(nivel == "Intermediário") {
                $("#torneiosBasquetebolIntermediario").html(msg);
            } else if (nivel == "Avançado") {
                $("#torneiosBasquetebolAvancado").html(msg);
            } else {
                $("#torneiosBasquetebolPrincipiante").html(msg);
            }

        } else {
            msg = "";
            $("#torneiosBasquetebolIntermediario").html(msg);
            $("#torneiosBasquetebolAvancado").html(msg);
            $("#torneiosBasquetebolPrincipiante").html(msg);
        }


        if(torneiosPadel.length > 0){
            msg = "";
            nivel = "";
            torneiosPadel.forEach(el => {
                nivel = el.nivelTorneio;
                const dateParts = el.dataTorneio.split('-');
                const formattedDate = `${dateParts[1]}/${dateParts[2]}`;

                // Assuming el.horaTorneio is in "HH:MM:SS" format
                const timeParts = el.horaTorneio.split(':');
                const formattedTime = `${timeParts[0]}:${timeParts[1]}`;

                // Final formatted strings
                const finalFormattedDate = `${formattedDate} ${formattedTime}`;

                msg += `<li class="list-group-item">
                                        <div class="card hover-img shadow position-relative">
                                        <div class="p-3 d-flex flex-column align-items-center justify-content-between mt-1">
                                            <img class="card-img-top object-fit-cover" src="${el.fotoTorneio}">
                                            <span class="fs-8 ms-2 ms-md-0 pt-1">${el.descricaoTorneio}</span>

                                            <div class="d-flex align-items-center mt-2">
                                            <span class="badge text-dark fs-2 rounded-4 lh-sm py-1 px-2 fw-semibold me-2 fs-4" style="background-color: #f0f0f0">
                                                <i class="ti ti-clock-hour-3 me-1"></i>${formattedDate} (${formattedTime})
                                            </span>
                                            </div>

                                            <span class="badge rounded-pill text-bg-danger position-absolute top-0 end-0 mt-2 me-2">
                                            <i class="ti ti-ball-football me-1"></i>
                                            <small>${el.modalidadeTorneio}</small>
                                            </span>

                                            <span class="mt-3 fs-3">
                                            <td class="bg-transparent">
                                                <a href="" class="btn btn-success">Inscrever</a>
                                            </td>
                                            </span>
                                        </div>
                                        </div>
                                    </li>`;
            });

            if(nivel == "Intermediário") {
                $("#torneiosPadelIntermediario").html(msg);
            } else if (nivel == "Avançado") {
                $("#torneiosPadelAvancado").html(msg);
            } else {
                $("#torneiosPadelPrincipiante").html(msg);
            }
        
        } else {
            msg = "";
            $("#torneiosPadelIntermediario").html(msg);
            $("#torneiosPadelAvancado").html(msg);
            $("#torneiosPadelPrincipiante").html(msg);
        }

        
        if(torneiosTenis.length > 0){
            msg = "";
            nivel = "";
            torneiosTenis.forEach(el => {
                nivel = el.nivelTorneio;
                const dateParts = el.dataTorneio.split('-');
                const formattedDate = `${dateParts[1]}/${dateParts[2]}`;

                // Assuming el.horaTorneio is in "HH:MM:SS" format
                const timeParts = el.horaTorneio.split(':');
                const formattedTime = `${timeParts[0]}:${timeParts[1]}`;

                // Final formatted strings
                const finalFormattedDate = `${formattedDate} ${formattedTime}`;

                msg += `<li class="list-group-item">
                                        <div class="card hover-img shadow position-relative">
                                        <div class="p-3 d-flex flex-column align-items-center justify-content-between mt-1">
                                            <img class="card-img-top object-fit-cover" src="${el.fotoTorneio}">
                                            <span class="fs-8 ms-2 ms-md-0 pt-1">${el.descricaoTorneio}</span>

                                            <div class="d-flex align-items-center mt-2">
                                            <span class="badge text-dark fs-2 rounded-4 lh-sm py-1 px-2 fw-semibold me-2 fs-4" style="background-color: #f0f0f0">
                                                <i class="ti ti-clock-hour-3 me-1"></i>${formattedDate} (${formattedTime})
                                            </span>
                                            </div>

                                            <span class="badge rounded-pill text-bg-danger position-absolute top-0 end-0 mt-2 me-2">
                                            <i class="ti ti-ball-football me-1"></i>
                                            <small>${el.modalidadeTorneio}</small>
                                            </span>

                                            <span class="mt-3 fs-3">
                                            <td class="bg-transparent">
                                                <a href="" class="btn btn-success">Inscrever</a>
                                            </td>
                                            </span>
                                        </div>
                                        </div>
                                    </li>`;
            });

            if(nivel == "Intermediário") {
                $("#torneiosTenisIntermediario").html(msg);
            } else if (nivel == "Avançado") {
                $("#torneiosTenisAvancado").html(msg);
            } else {
                $("#torneiosTenisPrincipiante").html(msg);
            }
        } else {
            msg = "";
            $("#torneiosTenisIntermediario").html(msg);
            $("#torneiosTenisAvancado").html(msg);
            $("#torneiosTenisPrincipiante").html(msg);
        }


        

    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });
}

$(function () {
    getTorneiosAbertosUser()
});