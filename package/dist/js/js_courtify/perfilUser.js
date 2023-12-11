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
            $("#nomePerfil").html(obj.nome);
            $("#email").html(obj.email);
            $("#local").html(obj.localizacao);
            $("#bio").html(obj.bio);
            $("#mod").html(obj.mod);
            $("#iconAlterarFoto").html(obj.altFotoCapa);
            $("#botaoAdicionarAmigo").html(obj.botaoAmigo);
            $("#botaoMensagemAmigo").html(obj.botaoMensagem);
            getEstatisticas(perfilId);
            getValoresBadges(obj.valoresBadges);
            console.log(obj.valoresBadges)
            let mod = obj.modalidades;
            for(let i = 0; i < mod.length; i++){
                if(mod[i] == "Basquetebol"){
                    $("#badgesBasquetebol").removeClass("d-none");
                    $("#estatisticasBasquetebol").removeClass("d-none");
                }else if(mod[i] == "Futsal"){
                    $("#badgesFutsal").removeClass("d-none");
                    $("#estatisticasFutsal").removeClass("d-none");
                }else if(mod[i] == "Padel"){
                    $("#badgesPadel").removeClass("d-none");
                    $("#estatisticasPadel").removeClass("d-none");
                }else{
                    $("#badgesTenis").removeClass("d-none");
                    $("#estatisticasTenis").removeClass("d-none");
                }
            }
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

function getJogosRecentes() {
    urlParams = new URLSearchParams(window.location.search);
    let idUser = urlParams.get('id');

    let dados = new FormData();
    dados.append("op", 29);
    dados.append("idUser", idUser);

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
        $("#jogosRecentes").html(msg);
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


function getValoresBadges(valores){
    for(let i = 0; i < valores.length; i++){
        if(valores[i][0] == "Basquetebol"){
           
        }else if(valores[i][0] == "Futsal"){

        }else if(valores[i][0] == "Padel"){
            let vit = valores[i][1];
            console.log(vit)
            if(vit > 20){
                $("#quantidadePerc20").html(20+"/20%");
            }else{
                $("#quantidadePerc20").html(vit+"/20%");
            }
            if(vit > 50){
                $("#quantidadePerc50").html(50+"/50%");
            }else{
                $("#quantidadePerc50").html(vit+"/50%");
            }
            if(vit > 70){
                $("#quantidadePerc70").html(70+"/70%");
            }else{
                $("#quantidadePerc70").html(vit+"/70%");
            }
            $("#progressBarPerc20").css("width", vit + "%");
            $("#progressBarPerc50").css("width", vit + "%");
            $("#progressBarPerc70").css("width", vit + "%");
            let nvit = valores[i][2];
            $("#progressBarP20Vit").css("width", (nvit/20)*100 + "%");
            if(nvit > 20){
                $("#quantidadeP20Vit").html(20+"/20");
            }else{
                $("#quantidadeP20Vit").html(nvit+"/20");
            }
            $("#progressBarP50Vit").css("width", (nvit/50)*100 + "%");
            if(nvit > 50){
                $("#quantidadeP50Vit").html(50+"/50");
            }else{
                $("#quantidadeP50Vit").html(nvit+"/50");
            }
            $("#progressBarP100Vit").css("width", nvit + "%");
            if(nvit > 100){
                $("#quantidadeP100Vit").html(100+"/100");
            }else{
                $("#quantidadeP100Vit").html(nvit+"/100");
            }
            $("#progressBarP150Vit").css("width", (nvit/150)*100 + "%");
            if(nvit > 150){
                $("#quantidadeP150Vit").html(150+"/150");
            }else{
                $("#quantidadeP150Vit").html(nvit+"/150");
            }
            $("#progressBarP200Vit").css("width", (nvit/200)*100 + "%");
            if(nvit > 50){
                $("#quantidadeP200Vit").html(200+"/200");
            }else{
                $("#quantidadeP200Vit").html(nvit+"/200");
            }
        }else{

        }


    }


}

$(function() {
    getPerfilNavbar();
    getPerfil();
    getJogosRecentes();

});


