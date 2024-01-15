function regTorneio() {

    let dados = new FormData();
    dados.append("op", 1);
    dados.append("trDesc", $('#trDesc').val());
    dados.append("trData", $('#trData').val());
    dados.append("trHora", $('#trHora').val());
    dados.append("trNmr", $('#trNmr').val());
    dados.append("trPreco", $('#trPreco').val());
    dados.append("trNivel", $('#trNivel').val());
    dados.append("trGen", $('#trGen').val());
    dados.append("trImagem", $('#trImagem').prop('files')[0]);
    dados.append("trObs", $('#trObs').val());


    $.ajax({
        url: "../../dist/php/controllerTorneio.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })

        .done(function (msg) {

            let obj = JSON.parse(msg);
            if (obj.flag) {
                alerta("Torneio", obj.msg, "success");
                getListaTorneio();
            } else {
                alerta("Torneio", obj.msg, "error");
            }

        })

        .fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
}

function getListaTorneio() {

    if ($.fn.DataTable.isDataTable('#tabelaTorneio')) {
        $('#tabelaTorneio').DataTable().destroy();
    }

    let dados = new FormData();
    dados.append("op", 2);


    $.ajax({
        url: "../../dist/php/controllerTorneio.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })

        .done(function (msg) {

            $('#listaTorneio').html(msg);
            $('#tabelaTorneio').DataTable();

        })

        .fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
}

function getDadosTorneio(id) {


    let dados = new FormData();
    dados.append("op", 3);
    dados.append("id", id);

    $.ajax({
        url: "../../dist/php/controllerTorneio.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })

        .done(function (msg) {

            let obj = JSON.parse(msg);

            $('#idEditTour').val(obj.id);
            $('#descEditTour').val(obj.descricao);
            $('#dataEditTour').val(obj.data);
            $('#horaEditTour').val(obj.hora);
            $('#nmrEditTour').val(obj.num_entradas);
            $('#precoEditTour').val(obj.preco);
            $('#nivelEditTour').val(obj.nivel);
            $('#genEditTour').val(obj.genero);
            $('#estadoEditTour').val(obj.estado);
            $('#imagemEditTour').attr('src', obj.foto);
            $('#obsEditTour').val(obj.obs);



            $('#btnGuardar').attr("onclick", "guardaEditTorneio(" + id + ")")

            $('#trEditModal').modal('show')
        })

        .fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });


}

function guardaEditTorneio(id) {

    let dados = new FormData();
    dados.append("op", 4);
    dados.append("trId", id);
    dados.append("trDesc", $('#descEditTour').val());
    dados.append("trData", $('#dataEditTour').val());
    dados.append("trHora", $('#horaEditTour').val());
    dados.append("trNmr", $('#nmrEditTour').val());
    dados.append("trPreco", $('#precoEditTour').val());
    dados.append("trGen", $('#genEditTour').val());
    dados.append("trNivel", $('#nivelEditTour').val());
    dados.append("trEstado", $('#estadoEditTour').val());
    dados.append("trImagem", $('#imagemEditTour').prop('files')[0]);
    dados.append("trObs", $('#obsEditTour').val());

    $.ajax({
        url: "../../dist/php/controllerTorneio.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })

        .done(function (msg) {

            let obj = JSON.parse(msg);
            if (obj.flag) {
                alerta("Torneio", obj.msg, "success");
                $('#trEditModal').modal('hide');
                getListaTorneio();
            } else {
                alerta("Torneio", obj.msg, "error");
            }

        })

        .fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });


}

function removeTorneio(id) {

    let dados = new FormData();
    dados.append("op", 5);
    dados.append("id", id);

    $.ajax({
        url: "../../dist/php/controllerTorneio.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })

        .done(function (msg) {

            let obj = JSON.parse(msg);
            if (obj.flag) {
                alerta("Torneio", obj.msg, "success");
                getListaTorneio();
            } else {
                alerta("Torneio", obj.msg, "error");
            }

        })

        .fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });

}



function alerta(titulo, msg, icon) {
    Swal.fire({
        position: 'center',
        icon: icon,
        title: titulo,
        text: msg,
        showConfirmButton: true,

    })
}


$(function () {
    getListaTorneio();
});

