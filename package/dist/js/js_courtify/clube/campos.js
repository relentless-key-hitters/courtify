function getCamposClube(){

    let dados = new FormData();
    dados.append("op", 11);

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
        if($.fn.DataTable.isDataTable('#tabela')){
            $('#tabela').DataTable().destroy()
        }
        $("#tableCampos").html(msg)
        $('#tabela').DataTable();
    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    })

}

function getCamposManutencao(){
    let dados = new FormData();
    dados.append("op", 14);

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
        if($.fn.DataTable.isDataTable('#tabela1')){
            $('#tabela1').DataTable().destroy()
        }
        $("#tableCampos2").html(msg)
        $('#tabela1').DataTable();
    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    })
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

$(function() {
    getCamposManutencao()
    getCamposClube()
    $('#tabela').DataTable();
    $('#tabela1').DataTable();
    getNomeClube();
});