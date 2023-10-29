function getCampos(){

    let dados = new FormData();
    dados.append("op", 1);

    $.ajax({
        url: "../../dist/php/controllerCampo.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
        })

        .done(function(msg) {
            $("#rowCampos").html(msg);

        })
        
        .fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
        });

}


$(document).ready(function () {
    getCampos();
});