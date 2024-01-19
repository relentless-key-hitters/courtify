function regEquipa() {

    let dados = new FormData();
    dados.append("op", 2);
    dados.append("nomeEq", $('#nomeEq').val());
    dados.append("modEq", $('#modEq').val());
    dados.append("descEq", $('#descEq').val());
    dados.append("rankEq", $('#rankEq').val());
    dados.append("estadoEq", $('#estadoEq').val());
    dados.append("imagemEq", $('#imagemEq').prop('files')[0]);


    $.ajax({
        url: "../../dist/php/clube/controllerEquipa.php",
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
                alerta("Equipa", obj.msg, "success");
                getListaEquipa();
            } else {
                alerta("Equipa", obj.msg, "error");
            }

        })

        .fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
}


function getListaEquipa() {

    let dados = new FormData();
    dados.append("op", 3);


    $.ajax({
        url: "../../dist/php/clube/controllerEquipa.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })

        .done(function (msg) {
            $('#listaEquipa').html(msg);
            $('#tabelaEquipa').DataTable(
                {
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-PT.json',
                    }
                }
            );

        })

        .fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
}


function getDadosEquipa(id) {


    let dados = new FormData();
    dados.append("op", 4);
    dados.append("id", id);

    $.ajax({
        url: "../../dist/php/clube/controllerEquipa.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })

        .done(function (msg) {

            let obj = JSON.parse(msg);
            console.log(obj)
            $('#idEq').val(obj.id);
            $('#nomeEq').val(obj.nome);
            /*$('#modEq').val(obj.modalidade);*/
            /*$('#descEq').val(obj.descricao);*/
            /*$('#rankEditEquipa').val(obj.ranking);*/
            /*$('#estadoEq').val(obj.estado);*/
            /*$('#imagemEq').val(obj.foto);*/

            $('#btnGuardar').attr("onclick", "guardaEditEquipa(" + id + ")")

            $('#teamEditModal').modal('show')
        })

        .fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });


}

function guardaEditEquipa(id) {

    let dados = new FormData();
    dados.append("op", 5);
    dados.append("idEq", id);
    dados.append("nomeEq", $('#nomeEditEquipa').val());
    dados.append("modEq", $('#modEditEquipa').val());
    dados.append("descEq", $('#descEditEquipa').val());
    dados.append("rankEq", $('#rankEditEquipa').val());
    dados.append("estadoEq", $('#estadoEditEquipa').val());
    dados.append("imagemEq", $('#imagemEditEquipa').prop('files')[0]);


    $.ajax({
        url: "../../dist/php/clube/controllerEquipa.php",
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
                alerta("Equipa", obj.msg, "success");
                $('#editarEquipaModal').modal('hide');
                getListaEquipa();
            } else {
                alerta("Equipa", obj.msg, "error");
            }

        })

        .fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });


}

function removerEquipa(id) {

    let dados = new FormData();
    dados.append("op", 6);
    dados.append("id", id);

    $.ajax({
        url: "../../dist/php/clube/controllerEquipa.php",
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
                alerta("Equipa", obj.msg, "success");
                getListaEquipa();
            } else {
                alerta("Equipa", obj.msg, "error");
            }

        })

        .fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });


};


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
    getListaEquipa();

});




