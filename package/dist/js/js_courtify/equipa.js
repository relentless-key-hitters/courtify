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



function regEquipa() {

let dados = new FormData();
dados.append("op", 2);
dados.append("nomeEquipa", $('#nomeEquipa').val());
dados.append("imgEquipa",$('#imgEquipa').prop('files')[0]);
dados.append("nmrEquipa", $('#nmrEquipa').val());
dados.append("nivelEquipa", $('#nivelEquipa').val());
dados.append("obsEquipa", $('#obsEquipa').val());


$.ajax({
    url: "../../dist/php/controllerEquipa.php",
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

if ($.fn.DataTable.isDataTable('#tabelaEquipa')) {
    $('#tabelaEquipa').DataTable().destroy();
}

let dados = new FormData();
dados.append("op", 3);


$.ajax({
    url: "../../dist/php/controllerEquipa.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
})

    .done(function (msg) {

        $('#listaEquipa').html(msg);
        $('#tabelaEquipa').DataTable();

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
    url: "../../dist/php/controllerEquipa.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
})

    .done(function (msg) {

        let obj = JSON.parse(msg);

        $('#idEditEquipa').val(obj.id);
        $('#nomeEditEquipa').val(obj.descricao);
        $('#imgEditEquipa').val(obj.data);
        $('#nmrEditEquipa').val(obj.hora);
        $('#nivelEditEquipa').val(obj.num_entradas);
        $('#obsEditEquipa').val(obj.preco);

        $('#btnGuardar').attr("onclick", "guardaEditEquipa(" + id + ")")

        $('#editarEquipaModal').modal('show')
    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });


}

function guardaEditEquipa(id) {

let dados = new FormData();
dados.append("op", 5);
dados.append("idEquipa", id);
dados.append("nomeQuipa", $('#nomeEditEquipa').val());
dados.append("imgEquipa", $('#imgEditEquipa').prop('files')[0]);
dados.append("nmrEquipa", $('#nmrEditEquipa').val());
dados.append("nivelEquipa", $('#nivelEditEquipa').val());
dados.append("obsEquipa", $('#obsEditEquipa').val());


$.ajax({
    url: "../../dist/php/controllerEquipa.php",
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
    url: "../../dist/php/controllerEquipa.php",
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

});

