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
        $("#nReservas").html(obj.numMarc)
        $("#nTorneios").html(obj.numTorn)
        $("#nPend").html(obj.naoPago)
        $("#nFeitos").html(obj.pago)
        $("#ganhosMesAtual").html(obj.totalGanhos + "€")
    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    })

}



$(function() {
    getInfoClubePerfil()
});