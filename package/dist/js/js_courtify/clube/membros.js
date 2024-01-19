function getMembros(){

    let dados = new FormData();
    dados.append("op", 21);
    
    $.ajax({
        url: "../../dist/php/controllerClube.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
        })
        
        .done(function(msg) {
            if($.fn.DataTable.isDataTable('#tabelaMembros')){
                $('#tabelaMembros').DataTable().destroy()
            }
            $("#tableMembros").html(msg)
            $('#tabelaMembros').DataTable( {
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-PT.json',
                }
            });
        })
        
        .fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
        });

}

function removerMembroEquipa(idMembro, idEquipa, nomeEquipa){
    $("#corpoModalRemoverMembro").html("Tem a certeza que pretende remover este membro da equipa <span class='fw-bolder'>"+nomeEquipa+"</span>?")
    $("#botaoGuardar").attr("onclick", "guardaRemoverMembro("+idMembro+", "+idEquipa+")");
    $("#modalRemoverMembro").modal("show");
}

function guardaRemoverMembro(idMembro, idEquipa){
    let dados = new FormData();
    dados.append("op", 22);
    dados.append("idMembro", idMembro)
    dados.append("idEquipa", idEquipa)
    
    $.ajax({
        url: "../../dist/php/controllerClube.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
        })
        
        .done(function(msg) {
            let obj = JSON.parse(msg);
            alerta2(obj.title, obj.msg, obj.icon);
            setTimeout(function () { location.reload() }, 3000);
        })
        
        .fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
        });



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


$(function () {
    getMembros();
    getNomeClube();

});