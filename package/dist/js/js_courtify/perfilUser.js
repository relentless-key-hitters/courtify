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
            let vit = valores[i][1];
            if(vit > 20){
                $("#quantidadePerc20B").html(20+"/20%");
            }else{
                $("#quantidadePerc20B").html(vit+"/20%");
            }
            if(vit > 50){
                $("#quantidadePerc50B").html(50+"/50%");
            }else{
                $("#quantidadePerc50B").html(vit+"/50%");
            }
            if(vit > 70){
                $("#quantidadePerc70B").html(70+"/70%");
            }else{
                $("#quantidadePerc70B").html(vit+"/70%");
            }
            $("#progressBarPerc20B").css("width",(vit/20)*100 + "%");
            $("#progressBarPerc50B").css("width", (vit/50)*100 + "%");
            $("#progressBarPerc70B").css("width", (vit/70)*100 + "%");
            let nvit = valores[i][2];
            $("#progressBarB20Vit").css("width", (nvit/20)*100 + "%");
            if(nvit > 20){
                $("#quantidadeB20Vit").html(20+"/20");
            }else{
                $("#quantidadeB20Vit").html(nvit+"/20");
            }
            $("#progressBarB50Vit").css("width", (nvit/50)*100 + "%");
            if(nvit > 50){
                $("#quantidadeB50Vit").html(50+"/50");
            }else{
                $("#quantidadeB50Vit").html(nvit+"/50");
            }
            $("#progressBarB100Vit").css("width", nvit + "%");
            if(nvit > 100){
                $("#quantidadeB100Vit").html(100+"/100");
            }else{
                $("#quantidadeB100Vit").html(nvit+"/100");
            }
            $("#progressBarB150Vit").css("width", (nvit/150)*100 + "%");
            if(nvit > 150){
                $("#quantidadeB150Vit").html(150+"/150");
            }else{
                $("#quantidadeB150Vit").html(nvit+"/150");
            }
            let nPontos = valores[i][3];
            $("#progressBarB10Pnt").css("width", (nPontos/10)*100 + "%");
            if(nPontos > 10){
                $("#quantidadeB10Pnt").html(10+"/10");
            }else{
                $("#quantidadeB10Pnt").html(nPontos+"/10");
            }
            $("#progressBarB30Pnt").css("width", (nPontos/30)*100 + "%");
            if(nPontos > 30){
                $("#quantidadeB30Pnt").html(30+"/30");
            }else{
                $("#quantidadeB30Pnt").html(nPontos+"/30");
            }
            $("#progressBarB70Pnt").css("width", (nPontos/70)*100 + "%");
            if(nPontos > 70){
                $("#quantidadeB70Pnt").html(70+"/70");
            }else{
                $("#quantidadeB70Pnt").html(nPontos+"/70");
            }
            $("#progressBarB250Pnt").css("width", (nPontos/250)*100 + "%");
            if(nPontos > 250){
                $("#quantidadeB250Pnt").html(250+"/250");
            }else{
                $("#quantidadeB250Pnt").html(nPontos+"/250");
            }
            $("#progressBarB1000Pnt").css("width", (nPontos/1000)*100 + "%");
            if(nPontos > 1000){
                $("#quantidadeB1000Pnt").html(1000+"/1000");
            }else{
                $("#quantidadeB1000Pnt").html(nPontos+"/1000");
            }
        }else if(valores[i][0] == "Futsal"){
            let vit = valores[i][1];
            console.log(vit)
            if(vit > 20){
                $("#quantidadePerc20F").html(20+"/20%");
            }else{
                $("#quantidadePerc20F").html(vit+"/20%");
            }
            if(vit > 50){
                $("#quantidadePerc50F").html(50+"/50%");
            }else{
                $("#quantidadePerc50F").html(vit+"/50%");
            }
            if(vit > 70){
                $("#quantidadePerc70F").html(70+"/70%");
            }else{
                $("#quantidadePerc70F").html(vit+"/70%");
            }
            console.log(vit*0.2)
            $("#progressBarPerc20F").css("width",(vit/20)*100 + "%");
            $("#progressBarPerc50F").css("width", (vit/50)*100 + "%");
            $("#progressBarPerc70F").css("width", (vit/70)*100 + "%");
            let nvit = valores[i][2];
            $("#progressBarF20Vit").css("width", (nvit/20)*100 + "%");
            if(nvit > 20){
                $("#quantidadeF20Vit").html(20+"/20");
            }else{
                $("#quantidadeF20Vit").html(nvit+"/20");
            }
            $("#progressBarF50Vit").css("width", (nvit/50)*100 + "%");
            if(nvit > 50){
                $("#quantidadeF50Vit").html(50+"/50");
            }else{
                $("#quantidadeF50Vit").html(nvit+"/50");
            }
            $("#progressBarF100Vit").css("width", nvit + "%");
            if(nvit > 100){
                $("#quantidadeF100Vit").html(100+"/100");
            }else{
                $("#quantidadeF100Vit").html(nvit+"/100");
            }
            $("#progressBarF150Vit").css("width", (nvit/150)*100 + "%");
            if(nvit > 150){
                $("#quantidadeF150Vit").html(150+"/150");
            }else{
                $("#quantidadeF150Vit").html(nvit+"/150");
            }
            $("#progressBarF200Vit").css("width", (nvit/200)*100 + "%");
            if(nvit > 200){
                $("#quantidadeF200Vit").html(200+"/200");
            }else{
                $("#quantidadeF200Vit").html(nvit+"/200");
            }
            let nPontos = valores[i][3];
            $("#progressBarF10Pnt").css("width", (nPontos/10)*100 + "%");
            if(nPontos > 10){
                $("#quantidadeF10Pnt").html(10+"/10");
            }else{
                $("#quantidadeF10Pnt").html(nPontos+"/10");
            }
            $("#progressBarF30Pnt").css("width", (nPontos/30)*100 + "%");
            if(nPontos > 30){
                $("#quantidadeF30Pnt").html(30+"/30");
            }else{
                $("#quantidadeF30Pnt").html(nPontos+"/30");
            }
            $("#progressBarF70Pnt").css("width", (nPontos/70)*100 + "%");
            if(nPontos > 70){
                $("#quantidadeF70Pnt").html(70+"/70");
            }else{
                $("#quantidadeF70Pnt").html(nPontos+"/70");
            }
            $("#progressBarF100Pnt").css("width", (nPontos/100)*100 + "%");
            if(nPontos > 100){
                $("#quantidadeF100Pnt").html(100+"/100");
            }else{
                $("#quantidadeF100Pnt").html(nPontos+"/100");
            }
            $("#progressBarF250Pnt").css("width", (nPontos/200)*100 + "%");
            if(nPontos > 200){
                $("#quantidadeF250Pnt").html(200+"/200");
            }else{
                $("#quantidadeF250Pnt").html(nPontos+"/200");
            }
            $("#progressBarF1000Pnt").css("width", (nPontos/1000)*100 + "%");
            if(nPontos > 1000){
                $("#quantidadeF1000Pnt").html(1000+"/1000");
            }else{
                $("#quantidadeF1000Pnt").html(nPontos+"/1000");
            }
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
            console.log(vit*0.2)
            $("#progressBarPerc20").css("width",(vit/20)*100 + "%");
            $("#progressBarPerc50").css("width", (vit/50)*100 + "%");
            $("#progressBarPerc70").css("width", (vit/70)*100 + "%");
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
            if(nvit > 200){
                $("#quantidadeP200Vit").html(200+"/200");
            }else{
                $("#quantidadeP200Vit").html(nvit+"/200");
            }
            let nPontos = valores[i][3];
            $("#progressBarP10Pnt").css("width", (nPontos/10)*100 + "%");
            if(nPontos > 10){
                $("#quantidadeP10Pnt").html(10+"/10");
            }else{
                $("#quantidadeP10Pnt").html(nPontos+"/10");
            }
            $("#progressBarP30Pnt").css("width", (nPontos/30)*100 + "%");
            if(nPontos > 30){
                $("#quantidadeP30Pnt").html(30+"/30");
            }else{
                $("#quantidadeP30Pnt").html(nPontos+"/30");
            }
            $("#progressBarP70Pnt").css("width", (nPontos/70)*100 + "%");
            if(nPontos > 70){
                $("#quantidadeP70Pnt").html(70+"/70");
            }else{
                $("#quantidadeP70Pnt").html(nPontos+"/70");
            }
            $("#progressBarP250Pnt").css("width", (nPontos/250)*100 + "%");
            if(nPontos > 250){
                $("#quantidadeP250Pnt").html(250+"/250");
            }else{
                $("#quantidadeP250Pnt").html(nPontos+"/250");
            }
            $("#progressBarP1000Pnt").css("width", (nPontos/1000)*100 + "%");
            if(nPontos > 1000){
                $("#quantidadeP1000Pnt").html(1000+"/1000");
            }else{
                $("#quantidadeP1000Pnt").html(nPontos+"/1000");
            }
        }else{
            let vit = valores[i][1];
            console.log(vit)
            if(vit > 20){
                $("#quantidadePerc20T").html(20+"/20%");
            }else{
                $("#quantidadePerc20T").html(vit+"/20%");
            }
            if(vit > 50){
                $("#quantidadePerc50T").html(50+"/50%");
            }else{
                $("#quantidadePerc50T").html(vit+"/50%");
            }
            if(vit > 70){
                $("#quantidadePerc70T").html(70+"/70%");
            }else{
                $("#quantidadePerc70T").html(vit+"/70%");
            }
            console.log(vit*0.2)
            $("#progressBarPerc20T").css("width",(vit/20)*100 + "%");
            $("#progressBarPerc50T").css("width", (vit/50)*100 + "%");
            $("#progressBarPerc70T").css("width", (vit/70)*100 + "%");
            let nvit = valores[i][2];
            $("#progressBarT20Vit").css("width", (nvit/20)*100 + "%");
            if(nvit > 20){
                $("#quantidadeT20Vit").html(20+"/20");
            }else{
                $("#quantidadeT20Vit").html(nvit+"/20");
            }
            $("#progressBarT50Vit").css("width", (nvit/50)*100 + "%");
            if(nvit > 50){
                $("#quantidadeT50Vit").html(50+"/50");
            }else{
                $("#quantidadeT50Vit").html(nvit+"/50");
            }
            $("#progressBarT100Vit").css("width", nvit + "%");
            if(nvit > 100){
                $("#quantidadeT100Vit").html(100+"/100");
            }else{
                $("#quantidadeT100Vit").html(nvit+"/100");
            }
            $("#progressBarT150Vit").css("width", (nvit/150)*100 + "%");
            if(nvit > 150){
                $("#quantidadeT150Vit").html(150+"/150");
            }else{
                $("#quantidadeT150Vit").html(nvit+"/150");
            }
            $("#progressBarT200Vit").css("width", (nvit/200)*100 + "%");
            if(nvit > 200){
                $("#quantidadeT200Vit").html(200+"/200");
            }else{
                $("#quantidadeT200Vit").html(nvit+"/200");
            }
            let nPontos = valores[i][3];
            $("#progressBarT10Pnt").css("width", (nPontos/10)*100 + "%");
            if(nPontos > 10){
                $("#quantidadeT10Pnt").html(10+"/10");
            }else{
                $("#quantidadeT10Pnt").html(nPontos+"/10");
            }
            $("#progressBarT30Pnt").css("width", (nPontos/30)*100 + "%");
            if(nPontos > 30){
                $("#quantidadeT30Pnt").html(30+"/30");
            }else{
                $("#quantidadeT30Pnt").html(nPontos+"/30");
            }
            $("#progressBarT70Pnt").css("width", (nPontos/70)*100 + "%");
            if(nPontos > 70){
                $("#quantidadeT70Pnt").html(70+"/70");
            }else{
                $("#quantidadeT70Pnt").html(nPontos+"/70");
            }
            $("#progressBarT250Pnt").css("width", (nPontos/250)*100 + "%");
            if(nPontos > 250){
                $("#quantidadeT250Pnt").html(250+"/250");
            }else{
                $("#quantidadeT250Pnt").html(nPontos+"/250");
            }
            $("#progressBarT1000Pnt").css("width", (nPontos/1000)*100 + "%");
            if(nPontos > 1000){
                $("#quantidadeT1000Pnt").html(1000+"/1000");
            }else{
                $("#quantidadeT1000Pnt").html(nPontos+"/1000");
            }
        }


    }


}

$(function() {
    getPerfilNavbar();
    getPerfil();
    getJogosRecentes();

});


