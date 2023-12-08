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
            console.log(obj);
            
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
            $("#iconAlterarFoto").html(obj.altFotoCapa);
            $("#botaoAdicionarAmigo").html(obj.botaoAmigo);
            $("#botaoMensagemAmigo").html(obj.botaoMensagem);
            getEstatisticas(perfilId);
        })
        
        .fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
        });

}

function getEstatisticas(id){
    let dados = new FormData();
    dados.append("op", 20);
    dados.append("id", id)

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
            console.log(msg)
            let obj = JSON.parse(msg);
            for(let i = 0; i < obj.length; i++){
                if(obj[i].modalidade == 'Basquetebol'){
                    $("#pontuacaoBasq").html(obj[i].nPontos)
                    $("#nJogosBasq").html(obj[i].nJogos)
                    $("#percVitBasq").html(obj[i].percVitorias)
                    $("#nMvpBasq").html(obj[i].nMvp)
                }else if(obj[i].modalidade  == 'Futsal'){
                    $("#pontuacaoFutsal").html(obj[i].nGolos)
                    $("#nJogosFutsal").html(obj[i].nJogos)
                    $("#percVitFutsal").html(obj[i].percVitorias)
                    $("#nMvpFutsal").html(obj[i].nMvp)
                }else if(obj[i].modalidade == "Padel"){
                    $("#pontuacaoPadel").html(obj[i].nPontos)
                    $("#nJogosPadel").html(obj[i].nJogos)
                    $("#percVitPadel").html(obj[i].percVitorias)
                    $("#nSetsGanhosPadel").html(obj[i].nSetsGanhos)
                    $("#mediaVitSetPadel").html(obj[i].mediaPontosSet)
                    $("#mediaSetsGanhosPadel").html(obj[i].percSets)
                    $("#nMvpPadel").html(obj[i].nMvp)
                }else{
                    $("#pontuacaoTenis").html(obj[i].nPontos)
                    $("#nJogosTenis").html(obj[i].nJogos)
                    $("#percVitTenis").html(obj[i].percVitorias)
                    $("#nSetsGanhosTenis").html(obj[i].nSetsGanhos)
                    $("#mediaVitSetTenis").html(obj[i].mediaPontosSet)
                    $("#mediaSetsGanhosTenis").html(obj[i].percSets)
                    $("#nMvpTenis").html(obj[i].nMvp)
                }
            }
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


