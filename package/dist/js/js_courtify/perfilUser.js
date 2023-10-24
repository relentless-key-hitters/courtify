function getPerfil(){

    let dados = new FormData();
    dados.append("op", 10);

    $.ajax({
        url: "../../dist/php/controllerUser.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
        })
        
        .done(function(msg) {
            let obj = JSON.parse(msg);
            $("#perfil1").attr('src', obj.fotoPerfil);
            $("#perfil2").attr('src', obj.fotoPerfil);
            $("#perfil3").attr('src', obj.fotoPerfil);
            $("#perfil4").attr('src', obj.fotoPerfil);
            $("#perfil5").attr('src', obj.fotoPerfil);
            $("#perfil6").attr('src', obj.fotoPerfil);
            $("#perfil7").attr('src', obj.fotoPerfil);
            $("#nomePerfil").html(obj.nome);
            $("#email").html(obj.email);
            $("#local").html(obj.localizacao);
            $("#bio").html(obj.bio);
            $("#nomeEquipa1").html(obj.nome);
            $("#nomeEquipa2").html(obj.nome);
            $("#nomeEquipa3").html(obj.nome);
            $("#nomeEquipa4").html(obj.nome);
            $("#mod").html(obj.mod);

        })
        
        .fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
        });

}

$(function() {
    getPerfil()
});


