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
        $("#nomeClube").html("<i class='ti ti-building me-2'></i>" + obj.nome)
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

function getDadosHoje(){
    let dados = new FormData();
    dados.append("op", 5);

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
        $("#horario1").html(obj.HorariosMaisFrequentes[0][0] + "h - " + obj.HorariosMaisFrequentes[0][1] + "h")
        $("#horario2").html(obj.HorariosMaisFrequentes[1][0] + "h - " + obj.HorariosMaisFrequentes[1][1] + "h")
        $("#horario3").html(obj.HorariosMaisFrequentes[2][0] + "h - " + obj.HorariosMaisFrequentes[2][1] + "h")
        $("#nMarcacoesHoje").html(obj.numMarcacoesHoje)
    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    })

}

function getGraficos(){
    let dados = new FormData();
    dados.append("op", 8);

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

    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    })

}

$(function() {
    getInfoClubePerfil()
    getMelhoresAtletas()
    getCampoHoras()
    getDadosHoje()
});