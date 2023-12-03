function getPerfil(){

    let urlParams = new URLSearchParams(window.location.search);
    let perfilId = urlParams.get('id');

    let dados = new FormData();
    dados.append("op", 10);
    dados.append("idUser", perfilId);

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
            $("#fotoCapaView").attr('src', obj.fotoCapa);
            $("#perfil3").attr('src', obj.fotoPerfil);
            $("#perfil4").attr('src', obj.fotoPerfil);
            $("#perfil5").attr('src', obj.fotoPerfil);
            $("#perfil6").attr('src', obj.fotoPerfil);
            $("#perfil7").attr('src', obj.fotoPerfil);
            $("#perfil8").attr('src', obj.fotoPerfil);
            $("#nomePerfil").html(obj.nome);
            $("#email").html(obj.email);
            $("#local").html(obj.localizacao);
            $("#bio").html(obj.bio);
            $("#nomeEquipa1").html(obj.nome);
            $("#nomeEquipa2").html(obj.nome);
            $("#nomeEquipa3").html(obj.nome);
            $("#nomeEquipa4").html(obj.nome);
            $("#nomeEquipa5").html(obj.nome);
            $("#mod").html(obj.mod);

        })
        
        .fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
        });

}

        
function altFotoCapa(){

    let dados = new FormData();
    dados.append("op", 11);
    dados.append("fotoCapa", $("#fotoCapa").prop('files')[0]);

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
            alerta2("Perfil", obj.msg, obj.icon);
            setTimeout(function(){ 
                location.reload();
            }, 2000);
        })
        
        .fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
        });

}

function getPerfilNavbar() {
    let dados = new FormData();
    dados.append("op", 19);

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
            $("#nome2").html(obj.nome);
            $("#email2").html(obj.email);
            $("#fotoPerfilEditCurrent").attr('src', obj.fotoPerfil);
        })
        
        .fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
        });
}

function alerta(titulo,msg,icon){
    Swal.fire({
        position: 'center',
        icon: icon,
        title: titulo,
        text: msg,
        showConfirmButton: true,
        confirmButtonColor: '#45702d',
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
      })
}


$(function() {
    getPerfilNavbar();
    getPerfil();

});


