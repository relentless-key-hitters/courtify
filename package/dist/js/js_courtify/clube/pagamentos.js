function getMarcacoesPagamentos(){
    let dados = new FormData();
    dados.append("op", 25);

    $.ajax({
        url: "../../dist/php/controllerClube.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })

    .done(function (msg) {
        if($.fn.DataTable.isDataTable('#tabelaReservas')){
            $('#tabelaReservas').DataTable().destroy()
        }
        $("#corpoTablePagamentos").html(msg)
        $('#tabelaReservas').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-PT.json',
            },
            order: [[2, 'desc']]
        });
    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    })
}


function getModalPagamento(idMarcacao){
    $("#botaoGuardar").attr("onclick", "validarPagamento("+idMarcacao+")");
    $("#modalValidarPagamento").modal("show");

}

function getNomeClube() {
    let dados = new FormData();
    dados.append("op", 4);

    $.ajax({
        url: "../../dist/php/controllerClube.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })

    .done(function (msg) {
        $("#nomeClube").html("<i class='ti ti-building me-2'></i>" + msg)
    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    })

}

function validarPagamento(idMarcacao){
    let dados = new FormData();
    dados.append("op", 26);
    dados.append("idMarcacao", idMarcacao)

    $.ajax({
        url: "../../dist/php/controllerClube.php",
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
        setTimeout(function () { location.reload() }, 3000);
    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    })

}

function alerta2(titulo,msg,icon){
    Swal.fire({
        position: 'center',
        icon: icon,
        title: titulo,
        text: msg,
        showConfirmButton: false,
        confirmButtonColor: '#45702d',
        timer: 3000
      })
}

$(function() {
    getNomeClube();
    getMarcacoesPagamentos();
});