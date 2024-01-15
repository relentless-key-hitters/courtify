function getInfoClubePerfil(){
    let dados = new FormData();
    dados.append("op", 1);

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
        let obj = JSON.parse(msg)
        $("#nomeClube").html(obj.nome)
        $("#nReservas").html(obj.numMarc)
        $("#nTorneios").html(obj.numTorn)
        $("#nPend").html(obj.naoPago)
        $("#nFeitos").html(obj.pago)
        $("#ganhosMesAtual").html(obj.totalGanhos + "€")
        $("#ganhosMesAnterior").html(obj.pagMesAnterior  + "€")
    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    })

}

function getMelhoresAtletas(){
    let dados = new FormData();
    dados.append("op", 2);

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
        $("#bodyMelhoresAtletas").html(msg)
        console.log(msg)
    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    })

}

function getCampoHoras(){
    let dados = new FormData();
    dados.append("op", 3);

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
        let obj = JSON.parse(msg)
        $("#nomeCampo").html(obj[1])
        $("#horasCampo").html(obj[0])
    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    })

}

$(function() {
    getInfoClubePerfil()
    getMelhoresAtletas()
    getCampoHoras()
});