function redirectToCampo(campoId) {
    window.location.href = 'campo.php?id=' + campoId;
}

function getInfoPagCampo() {

    
    let urlParams = new URLSearchParams(window.location.search);
    let campoId = urlParams.get('id');

    let dados = new FormData();
    dados.append("op", 5);
    dados.append("id", campoId);

    $.ajax({
        url: "../../dist/php/controllerCampo.php",
        method: "POST",
        data: dados,
        dataType: "json", 
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function(msg) {
        $("#modalidadesCampo").html(msg.modalidadeCampo);
        $("#descricaoCampo").html(msg.descCampo);
        $("#nomeCampo").html(msg.nomeCampo);
        $("#moradaCampo").html(msg.moradaCampo + ", " + msg.concelhoCampo + ", " + msg.distritoCampo);
        $("#fotoCampo").attr("src", msg.fotoCampo);
        $("#servicosCampo").html(msg.servicos);
        $("#horariosCampo").html(msg.horarioCampo);
    })
    .fail(function(jqXHR, textStatus) {
        console.error("Request failed:", textStatus);
        console.log(jqXHR.responseText);
        alert("Request failed: " + textStatus);
    });
}



$(function () {
    getInfoPagCampo()
});