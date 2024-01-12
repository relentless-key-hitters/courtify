let percVit = [];
let percMvp = [];
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
            getBadgesRecentes(obj.badgesRecentes);
            getMelhoresBadges(obj.melhoresBadges);
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
            let modalid = JSON.stringify(mod)
            getRadar(perfilId, modalid)
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

            let obj = JSON.parse(msg);
            for(let i = 0; i < obj.length; i++){
                if(obj[i].modalidade == 'Basquetebol'){
                    $("#pontuacaoBasq").html(obj[i].nPontos)
                    $("#nJogosBasq").html(obj[i].nJogos)
                    $("#percVitBasq").html(obj[i].percVitorias)
                    $("#nMvpBasq").html(obj[i].nMvp)
                    if(obj[i].nJogos < 30){
                        $("#rankingBasq").html("N/A")
                    }else{
                        $("#rankingBasq").html(obj[i].ranking + "º")
                    }
                    percVit.push(["Basquetebol", obj[i].percVitorias])
                    percMvp.push(["Basquetebol", (obj[i].nMvp / obj[i].nJogos)*100])
                }else if(obj[i].modalidade  == 'Futsal'){
                    $("#pontuacaoFutsal").html(obj[i].nGolos)
                    $("#nJogosFutsal").html(obj[i].nJogos)
                    $("#percVitFutsal").html(obj[i].percVitorias)
                    $("#nMvpFutsal").html(obj[i].nMvp)
                    if(obj[i].nJogos < 30){
                        $("#rankingFutsal").html("N/A")
                    }else{
                        $("#rankingFutsal").html(obj[i].ranking + "º")
                    }
                    percVit.push(["Futsal", obj[i].percVitorias])
                    percMvp.push(["Futsal", (obj[i].nMvp / obj[i].nJogos)*100])
                }else if(obj[i].modalidade == "Padel"){
                    $("#pontuacaoPadel").html(obj[i].nPontos)
                    $("#nJogosPadel").html(obj[i].nJogos)
                    $("#percVitPadel").html(obj[i].percVitorias)
                    $("#nSetsGanhosPadel").html(obj[i].nSetsGanhos)
                    $("#mediaVitSetPadel").html(obj[i].mediaPontosSet)
                    $("#mediaSetsGanhosPadel").html(obj[i].percSets)
                    $("#nMvpPadel").html(obj[i].nMvp)
                    if(obj[i].nJogos < 30){
                        $("#rankingPadel").html("N/A")
                    }else{
                        $("#rankingPadel").html(obj[i].ranking + "º")
                    }
                    percVit.push(["Padel", obj[i].percVitorias])
                    percMvp.push(["Padel", (obj[i].nMvp / obj[i].nJogos)*100])
                }else{
                    $("#pontuacaoTenis").html(obj[i].nPontos)
                    $("#nJogosTenis").html(obj[i].nJogos)
                    $("#percVitTenis").html(obj[i].percVitorias)
                    $("#nSetsGanhosTenis").html(obj[i].nSetsGanhos)
                    $("#mediaVitSetTenis").html(obj[i].mediaPontosSet)
                    $("#mediaSetsGanhosTenis").html(obj[i].percSets)
                    $("#nMvpTenis").html(obj[i].nMvp)
                    if(obj[i].nJogos < 30){
                        $("#rankingTenis").html("N/A")
                    }else{
                        $("#rankingTenis").html(obj[i].ranking + "º")
                    }
                    percVit.push(["Ténis", obj[i].percVitorias])
                    percMvp.push(["Ténis", (obj[i].nMvp / obj[i].nJogos)*100])
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

function getJogosRecentes(pagina) {
    urlParams = new URLSearchParams(window.location.search);
    let idUser = urlParams.get('id');

    let dados = new FormData();
    dados.append("op", 29);
    dados.append("idUser", idUser);
    dados.append("pagina", pagina);

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
        $("#jogosRecentes").html(obj.msg);

        adicionarLinksPaginacaoJogosRecentes(obj.paginasTotais, obj.paginaAtual);
    })

    .fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus ); 
    });

}

function adicionarLinksPaginacaoJogosRecentes(paginasTotais, paginaAtual) {
    let msgHtml = "<nav aria-label='Page navigation example' class='d-flex justify-content-end'>";
    msgHtml += "<ul class='pagination bg-light me-3'>";


    msgHtml += "<li class='page-item " + (paginaAtual === 1 ? "disabled" : "") + "'>";
    msgHtml += "<a class='page-link link' href='#' data-page='" + (paginaAtual - 1) + "'>Anterior</a>";
    msgHtml += "</li>";


    const maximoBotoesPagina = 5;

    // Calcular as páginas iniciaius e finais a mostrar consoant a restrição
    let paginaInicio = Math.max(1, paginaAtual - Math.floor(maximoBotoesPagina / 2));
    let paginaFim = Math.min(paginasTotais, paginaInicio + maximoBotoesPagina - 1);
    
    // Ajustar a página inicial se esta ultrapassar o intervalo válido
    paginaInicio = Math.max(1, paginaFim - maximoBotoesPagina + 1);
    
    // Botões da página
    for (let i = paginaInicio; i <= paginaFim; i++) {
        msgHtml += "<li class='page-item " + (i === paginaAtual ? "active" : "") + "'>";
        msgHtml += "<a class='page-link link' href='#' data-page='" + i + "'>" + i + "</a>";
        msgHtml += "</li>";
    }


    msgHtml += "<li class='page-item " + (paginaAtual === paginasTotais ? "disabled" : "") + "'>";
    msgHtml += "<a class='page-link link' href='#' data-page='" + (paginaAtual + 1) + "'>Próximo</a>";
    msgHtml += "</li>";

    msgHtml += "</ul></nav>";

    $("#paginacaoJogosRecentes").html(msgHtml);

    // Event listener para os botões da página que redirecionam para outras páginas para impedir o recarregamento da página
    $(".page-link.link").on("click", function(event) {
        event.preventDefault();
        let paginaClicada = $(this).data("page");
        getJogosRecentes(paginaClicada);
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
    contagemTotal = 0;
    for(let i = 0; i < valores.length; i++){
        if(valores[i][0] == "Basquetebol"){
            let cont = 0;
            let vit = valores[i][1];

            if(vit >= 20){
                $("#quantidadePerc20B").html(20+"/20%");
                cont += 1;
            }else{
                $("#quantidadePerc20B").html(vit+"/20%");
            }
            if(vit >= 50){
                $("#quantidadePerc50B").html(50+"/50%");
                cont += 1;
            }else{
                $("#quantidadePerc50B").html(vit+"/50%");
            }
            if(vit >= 70){
                $("#quantidadePerc70B").html(70+"/70%");
                cont += 1;
            }else{
                $("#quantidadePerc70B").html(vit+"/70%");
            }

            // BASQUETEBOL PERC 20    
            opacidadeGreyScale("#imgPerc20B", (vit/20))

            $("#progressBarPerc20B").css("width",(vit/20)*100 + "%");
            gradiente("#progressBarPerc20B", (vit/20)*100);

            // BASQUETEBOL PERC 50    
            opacidadeGreyScale("#imgPerc50B", (vit/50))

            $("#progressBarPerc50B").css("width",(vit/50)*100 + "%");
            gradiente("#progressBarPerc50B", (vit/50)*100);

            // BASQUETEBOL PERC 70    
            opacidadeGreyScale("#imgPerc70B", (vit/70))

            $("#progressBarPerc70B").css("width", (vit/70)*100 + "%");
            gradiente("#progressBarPerc70B", (vit/70)*100);

            



            let nvit = valores[i][2];
            //BASQUETEBOL VIT 20
            if(nvit >= 20){
                $("#quantidadeB20Vit").html(20+"/20");
                cont += 1;
            }else{
                $("#quantidadeB20Vit").html(nvit+"/20");
            }
            $("#progressBarB20Vit").css("width", (nvit/20)*100 + "%");
            gradiente("#progressBarB20Vit", (nvit/20)*100);
            opacidadeGreyScale("#imgBVit20", (nvit/20))

            //BASQUETEBOL VIT 50
            if(nvit >= 50){
                $("#quantidadeB50Vit").html(50+"/50");
                cont += 1;
            }else{
                $("#quantidadeB50Vit").html(nvit+"/50");
            }
            $("#progressBarB50Vit").css("width", (nvit/50)*100 + "%");
            gradiente("#progressBarB50Vit", (nvit/50)*100);
            opacidadeGreyScale("#imgBVit50", (nvit/50))

            // BASQUETEBOL VIT 100
            if(nvit >= 100){
                $("#quantidadeB100Vit").html(100+"/100");
                cont += 1;
            }else{
                $("#quantidadeB100Vit").html(nvit+"/100");
            }
            $("#progressBarB100Vit").css("width", nvit + "%");~
            gradiente("#progressBarB100Vit", (nvit/100)*100);
            opacidadeGreyScale("#imgBVit100", (nvit/100))

            // BASQUETEBOL VIT 150
            if(nvit >= 150){
                $("#quantidadeB150Vit").html(150+"/150");
                cont += 1;
            }else{
                $("#quantidadeB150Vit").html(nvit+"/150");
            }
            $("#progressBarB150Vit").css("width", (nvit/150)*100 + "%");
            gradiente("#progressBarB150Vit", (nvit/150)*100);
            opacidadeGreyScale("#imgBVit150", (nvit/150))





            let nPontos = valores[i][3];
            //BASQUETEBOL PONT 10
            if(nPontos >= 10){
                $("#quantidadeB10Pnt").html(10+"/10");
                cont += 1;
            }else{
                $("#quantidadeB10Pnt").html(nPontos+"/10");
            }
            $("#progressBarB10Pnt").css("width", (nPontos/10)*100 + "%");
            gradiente("#progressBarB10Pnt", (nPontos/10)*100);
            opacidadeGreyScale("#imgB10Pnt", (nPontos/10))

            //BASQUETEBOL PONT 30
            if(nPontos >= 30){
                $("#quantidadeB30Pnt").html(30+"/30");
                cont += 1;
            }else{
                $("#quantidadeB30Pnt").html(nPontos+"/30");
            }
            $("#progressBarB30Pnt").css("width", (nPontos/30)*100 + "%");
            gradiente("#progressBarB30Pnt", (nPontos/30)*100);
            opacidadeGreyScale("#imgB30Pnt", (nPontos/30))

            // BASQUETEBOL PONT 70
            if(nPontos >= 70){
                $("#quantidadeB70Pnt").html(70+"/70");
                cont += 1;
            }else{
                $("#quantidadeB70Pnt").html(nPontos+"/70");
            }
            $("#progressBarB70Pnt").css("width", (nPontos/70)*100 + "%");
            gradiente("#progressBarB70Pnt", (nPontos/70)*100);
            opacidadeGreyScale("#imgB70Pnt", (nPontos/70))

            // BASQUETEBOL PONT 250
            if(nPontos >= 250){
                $("#quantidadeB250Pnt").html(250+"/250");
                cont += 1;
            }else{
                $("#quantidadeB250Pnt").html(nPontos+"/250");
            }
            $("#progressBarB250Pnt").css("width", (nPontos/250)*100 + "%");
            gradiente("#progressBarB250Pnt", (nPontos/250)*100);
            opacidadeGreyScale("#imgB250Pnt", (nPontos/250))

            //BASQUETEBOL PONT 1000
            if(nPontos >= 1000){
                $("#quantidadeB1000Pnt").html(1000+"/1000");
                cont += 1;
            }else{
                $("#quantidadeB1000Pnt").html(nPontos+"/1000");
            }
            $("#progressBarB1000Pnt").css("width", (nPontos/1000)*100 + "%");
            gradiente("#progressBarB1000Pnt", (nPontos/1000)*100);
            opacidadeGreyScale("#imgB1000Pnt", (nPontos/1000))


            if(cont <= 3) {
                $("#contagemBasquetebol").html(cont + " de 13");
                $("#contagemBasquetebol").css("background-color", "red");
            } else if (cont <= 6) {
                $("#contagemBasquetebol").html(cont + " de 13")
                $("#contagemBasquetebol").css("background-color", "orange");
            } else if (cont <= 9) {
                $("#contagemBasquetebol").html(cont + " de 13")
                $("#contagemBasquetebol").css("background-color", "gold");
            } else if (cont <= 13) {
                $("#contagemBasquetebol").html(cont + " de 13")
                $("#contagemBasquetebol").css("background-color", "green");
            }
            contagemTotal += cont;
        }else if(valores[i][0] == "Futsal"){
            let cont = 0;
            let vit = valores[i][1];
            if(vit >= 20){
                $("#quantidadePerc20F").html(20+"/20%");
                cont += 1;
            }else{
                $("#quantidadePerc20F").html(vit+"/20%");
            }
            if(vit >= 50){
                $("#quantidadePerc50F").html(50+"/50%");
                cont += 1;
            }else{
                $("#quantidadePerc50F").html(vit+"/50%");
            }
            if(vit >= 70){
                $("#quantidadePerc70F").html(70+"/70%");
                cont += 1;
            }else{
                $("#quantidadePerc70F").html(vit+"/70%");
            }

            // FUTSAL PERC 20    
            opacidadeGreyScale("#imgPerc20F", (vit/20))

            $("#progressBarPerc20F").css("width",(vit/20)*100 + "%");
            gradiente("#progressBarPerc20F", (vit/20)*100);

            // FUTSAL PERC 50    
            opacidadeGreyScale("#imgPerc50F", (vit/50))

            $("#progressBarPerc50F").css("width",(vit/50)*100 + "%");
            gradiente("#progressBarPerc50F", (vit/50)*100);

            // FUTSAL PERC 70    
            opacidadeGreyScale("#imgPerc70F", (vit/70))

            $("#progressBarPerc70F").css("width", (vit/70)*100 + "%");
            gradiente("#progressBarPerc70F", (vit/70)*100);


            

            let nvit = valores[i][2];
            //FUTSAL VIT 20
            if(nvit >= 20){
                $("#quantidadeF20Vit").html(20+"/20");
                cont += 1;
            }else{
                $("#quantidadeF20Vit").html(nvit+"/20");
            }
            $("#progressBarF20Vit").css("width", (nvit/20)*100 + "%");
            gradiente("#progressBarF20Vit", (nvit/20)*100);
            opacidadeGreyScale("#imgFVit20", (nvit/20))

            //FUTSAL VIT 50
            if(nvit >= 50){
                $("#quantidadeF50Vit").html(50+"/50");
                cont += 1;
            }else{
                $("#quantidadeF50Vit").html(nvit+"/50");
            }
            $("#progressBarF50Vit").css("width", (nvit/50)*100 + "%");
            gradiente("#progressBarF50Vit", (nvit/50)*100);
            opacidadeGreyScale("#imgFVit50", (nvit/50))

            //FUTSAL VIT 100
            if(nvit >= 100){
                $("#quantidadeF100Vit").html(100+"/100");
                cont += 1;
            }else{
                $("#quantidadeF100Vit").html(nvit+"/100");
            }
            $("#progressBarF100Vit").css("width", nvit + "%");~
            gradiente("#progressBarF100Vit", (nvit/100)*100);
            opacidadeGreyScale("#imgFVit100", (nvit/100))

            //FUTSAL VIT 150
            if(nvit >= 150){
                $("#quantidadeF150Vit").html(150+"/150");
                cont += 1;
            }else{
                $("#quantidadeF150Vit").html(nvit+"/150");
            }
            $("#progressBarF150Vit").css("width", (nvit/150)*100 + "%");
            gradiente("#progressBarF150Vit", (nvit/150)*100);
            opacidadeGreyScale("#imgFVit150", (nvit/150))

            //FUTSAL VIT 200
            if(nvit >= 200){
                $("#quantidadeF200Vit").html(200+"/200");
                cont += 1;
            }else{
                $("#quantidadeF200Vit").html(nvit+"/200");
            }
            $("#progressBarF200Vit").css("width", (nvit/200)*100 + "%");
            gradiente("#progressBarF200Vit", (nvit/200)*100);
            opacidadeGreyScale("#imgFVit200", (nvit/200))





            let nPontos = valores[i][3];
            //FUTSAL PONT 10
            if(nPontos >= 10){
                $("#quantidadeF10Pnt").html(10+"/10");
                cont += 1;
            }else{
                $("#quantidadeF10Pnt").html(nPontos+"/10");
            }
            $("#progressBarF10Pnt").css("width", (nPontos/10)*100 + "%");
            gradiente("#progressBarF10Pnt", (nPontos/10)*100);
            opacidadeGreyScale("#imgF10Pnt", (nPontos/10))

            //FUTSAL PONT 30
            if(nPontos >= 30){
                $("#quantidadeF30Pnt").html(30+"/30");
                cont += 1;
            }else{
                $("#quantidadeF30Pnt").html(nPontos+"/30");
            }
            $("#progressBarF30Pnt").css("width", (nPontos/30)*100 + "%");
            gradiente("#progressBarF30Pnt", (nPontos/30)*100);
            opacidadeGreyScale("#imgF30Pnt", (nPontos/30))

            // FUTSAL PONT 70
            if(nPontos >= 70){
                $("#quantidadeF70Pnt").html(70+"/70");
                cont += 1;
            }else{
                $("#quantidadeF70Pnt").html(nPontos+"/70");
            }
            $("#progressBarF70Pnt").css("width", (nPontos/70)*100 + "%");
            gradiente("#progressBarF70Pnt", (nPontos/70)*100);
            opacidadeGreyScale("#imgF70Pnt", (nPontos/70))


            // FUTSAL PONT 100
            if(nPontos >= 100){
                $("#quantidadeF100Pnt").html(100+"/100");
                cont += 1;
            }else{
                $("#quantidadeF100Pnt").html(nPontos+"/100");
            }
            $("#progressBarF100Pnt").css("width", (nPontos/100)*100 + "%");
            gradiente("#progressBarF100Pnt", (nPontos/100)*100);
            opacidadeGreyScale("#imgF100Pnt", (nPontos/100))

            //FUTSAL PONT 200
            if(nPontos >= 200){
                $("#quantidadeF250Pnt").html(200+"/200");
                cont += 1;
            }else{
                $("#quantidadef250Pnt").html(nPontos+"/200");
            }
            $("#progressBarF250Pnt").css("width", (nPontos/200)*100 + "%");
            gradiente("#progressBarF250Pnt", (nPontos/200)*100);
            opacidadeGreyScale("#imgF250Pnt", (nPontos/200))

            if(cont <= 3) {
                $("#contagemFutsal").html(cont + " de 13");
                $("#contagemFutsal").css("background-color", "red");
            } else if (cont <= 6) {
                $("#contagemFutsal").html(cont + " de 13")
                $("#contagemFutsal").css("background-color", "orange");
            } else if (cont <= 9) {
                $("#contagemFutsal").html(cont + " de 13")
                $("#contagemFutsal").css("background-color", "gold");
            } else if (cont <= 13) {
                $("#contagemFutsal").html(cont + " de 13")
                $("#contagemFutsal").css("background-color", "green");
            }
            contagemTotal += cont;

        }else if(valores[i][0] == "Padel"){
            let cont = 0;
            let vit = valores[i][1];

            if(vit >= 20){
                $("#quantidadePerc20").html(20+"/20%");
                cont += 1;
            }else{
                $("#quantidadePerc20").html(vit+"/20%");
            }
            if(vit >= 50){
                $("#quantidadePerc50").html(50+"/50%");
                cont += 1;
            }else{
                $("#quantidadePerc50").html(vit+"/50%");
            }
            if(vit >= 70){
                $("#quantidadePerc70").html(70+"/70%");
                cont += 1;
            }else{
                $("#quantidadePerc70").html(vit+"/70%");
            }

            // PADEL PERC 20    
            opacidadeGreyScale("#imgPerc20P", (vit/20))

            $("#progressBarPerc20").css("width",(vit/20)*100 + "%");
            gradiente("#progressBarPerc20", (vit/20)*100);

            // PADEL PERC 50    
            opacidadeGreyScale("#imgPerc50P", (vit/50))

            $("#progressBarPerc50").css("width",(vit/50)*100 + "%");
            gradiente("#progressBarPerc50", (vit/50)*100);

            // PADEL PERC 70    
            opacidadeGreyScale("#imgPerc70P", (vit/70))

            $("#progressBarPerc70").css("width", (vit/70)*100 + "%");
            gradiente("#progressBarPerc70", (vit/70)*100);

            



            let nvit = valores[i][2];
            //PADEL VIT 20
            if(nvit >= 20){
                $("#quantidadeP20Vit").html(20+"/20");
                cont += 1;
            }else{
                $("#quantidadeP20Vit").html(nvit+"/20");
            }
            $("#progressBarP20Vit").css("width", (nvit/20)*100 + "%");
            gradiente("#progressBarP20Vit", (nvit/20)*100);
            opacidadeGreyScale("#imgPVit20", (nvit/20))

            //PADEL VIT 50
            if(nvit >= 50){
                $("#quantidadeP50Vit").html(50+"/50");
                cont += 1;
            }else{
                $("#quantidadeP50Vit").html(nvit+"/50");
            }
            $("#progressBarP50Vit").css("width", (nvit/50)*100 + "%");
            gradiente("#progressBarP50Vit", (nvit/50)*100);
            opacidadeGreyScale("#imgPVit50", (nvit/50))
            // PADEL VIT 100
            if(nvit >= 100){
                $("#quantidadeP100Vit").html(100+"/100");
                cont += 1;
            }else{
                $("#quantidadeP100Vit").html(nvit+"/100");
            }
            $("#progressBarP100Vit").css("width", nvit + "%");~
            gradiente("#progressBarP100Vit", (nvit/100)*100);
            opacidadeGreyScale("#imgPVit100", (nvit/100))

            // PADEL VIT 150
            if(nvit >= 150){
                $("#quantidadeP150Vit").html(150+"/150");
                cont += 1;
            }else{
                $("#quantidadeP150Vit").html(nvit+"/150");
            }
            $("#progressBarP150Vit").css("width", (nvit/150)*100 + "%");
            gradiente("#progressBarP150Vit", (nvit/150)*100);
            opacidadeGreyScale("#imgPVit150", (nvit/150))

            // PADEL VIT 200
            if(nvit >= 200){
                $("#quantidadeP200Vit").html(200+"/200");
                cont += 1;
            }else{
                $("#quantidadeP200Vit").html(nvit+"/200");
            }
            $("#progressBarP200Vit").css("width", (nvit/200)*100 + "%");
            gradiente("#progressBarP200Vit", (nvit/200)*100);
            opacidadeGreyScale("#imgPVit200", (nvit/200))



            let nPontos = valores[i][3];
            //PADEL PONT 10
            if(nPontos >= 10){
                $("#quantidadeP10Pnt").html(10+"/10");
                cont += 1;
            }else{
                $("#quantidadeP10Pnt").html(nPontos+"/10");
            }
            $("#progressBarP10Pnt").css("width", (nPontos/10)*100 + "%");
            gradiente("#progressBarP10Pnt", (nPontos/10)*100);
            opacidadeGreyScale("#imgP10Pnt", (nPontos/10))
            //PADEL PONT 30
            if(nPontos >= 30){
                $("#quantidadeP30Pnt").html(30+"/30");
                cont += 1;
            }else{
                $("#quantidadeP30Pnt").html(nPontos+"/30");
            }
            $("#progressBarP30Pnt").css("width", (nPontos/30)*100 + "%");
            gradiente("#progressBarP30Pnt", (nPontos/30)*100);
            opacidadeGreyScale("#imgP30Pnt", (nPontos/30))
            // PADEL PONT 70
            if(nPontos >= 70){
                $("#quantidadeP70Pnt").html(70+"/70");
                cont += 1;
            }else{
                $("#quantidadeP70Pnt").html(nPontos+"/70");
            }
            $("#progressBarP70Pnt").css("width", (nPontos/70)*100 + "%");
            gradiente("#progressBarP70Pnt", (nPontos/70)*100);
            opacidadeGreyScale("#imgP70Pnt", (nPontos/70))
            // PADEL PONT 250
            if(nPontos >= 250){
                $("#quantidadeP250Pnt").html(250+"/250");
                cont += 1;
            }else{
                $("#quantidadeP250Pnt").html(nPontos+"/250");
            }
            $("#progressBarP250Pnt").css("width", (nPontos/250)*100 + "%");
            gradiente("#progressBarP250Pnt", (nPontos/250)*100);
            opacidadeGreyScale("#imgP250Pnt", (nPontos/250))
            //PADEL PONT 1000
            if(nPontos >= 1000){
                $("#quantidadeP1000Pnt").html(1000+"/1000");
                cont += 1;
            }else{
                $("#quantidadeP1000Pnt").html(nPontos+"/1000");
            }
            $("#progressBarP1000Pnt").css("width", (nPontos/1000)*100 + "%");
            gradiente("#progressBarP1000Pnt", (nPontos/1000)*100);
            opacidadeGreyScale("#imgP1000Pnt", (nPontos/1000))

            if(cont <= 3) {
                $("#contagemPadel").html(cont + " de 13");
                $("#contagemPadel").css("background-color", "red");
            } else if (cont <= 6) {
                $("#contagemPadel").html(cont + " de 13")
                $("#contagemPadel").css("background-color", "orange");
            } else if (cont <= 9) {
                $("#contagemPadel").html(cont + " de 13")
                $("#contagemPadel").css("background-color", "gold");
            } else if (cont <= 13) {
                $("#contagemPadel").html(cont + " de 13")
                $("#contagemPadel").css("background-color", "green");
            }

            contagemTotal += cont;

        }else{
            let cont = 0;
            let vit = valores[i][1];

            if(vit >= 20){
                cont += 1;
                $("#quantidadePerc20T").html(20+"/20%");
            }else{
                $("#quantidadePerc20T").html(vit+"/20%");
            }
            if(vit >= 50){
                $("#quantidadePerc50T").html(50+"/50%");
                cont += 1;
            }else{
                $("#quantidadePerc50T").html(vit+"/50%");
            }
            if(vit >= 70){
                $("#quantidadePerc70T").html(70+"/70%");
                cont += 1;
            }else{
                $("#quantidadePerc70T").html(vit+"/70%");
            }

            // TENIS PERC 20    
            opacidadeGreyScale("#imgPerc20T", (vit/20))

            $("#progressBarPerc20T").css("width",(vit/20)*100 + "%");
            gradiente("#progressBarPerc20T", (vit/20)*100);

            // TENIS PERC 50    
            opacidadeGreyScale("#imgPerc50T", (vit/50))

            $("#progressBarPerc50T").css("width",(vit/50)*100 + "%");
            gradiente("#progressBarPerc50T", (vit/50)*100);

            // TENIS PERC 70    
            opacidadeGreyScale("#imgPerc70T", (vit/70))

            $("#progressBarPerc70T").css("width", (vit/70)*100 + "%");
            gradiente("#progressBarPerc70T", (vit/70)*100);



            let nvit = valores[i][2];
            //TENIS VIT 20
            $("#progressBarT20Vit").css("width", (nvit/20)*100 + "%");
            if(nvit >= 20){
                $("#quantidadeT20Vit").html(20+"/20");
                cont += 1;
            }else{
                $("#quantidadeT20Vit").html(nvit+"/20");
            }
            gradiente("#progressBarT20Vit", (nvit/20)*100);
            opacidadeGreyScale("#imgTVit20", (nvit/20))

            //TENIS VIT 50
            $("#progressBarT50Vit").css("width", (nvit/50)*100 + "%");
            if(nvit >= 50){
                $("#quantidadeT50Vit").html(50+"/50");
                cont += 1;
            }else{
                $("#quantidadeT50Vit").html(nvit+"/50");
            }
            gradiente("#progressBarT50Vit", (nvit/50)*100);
            opacidadeGreyScale("#imgTVit50", (nvit/50))

            //TENIS VIT 100
            $("#progressBarT100Vit").css("width", (nvit/100)*100 + "%");
            if(nvit >= 100){
                $("#quantidadeT100Vit").html(100+"/100");
                cont += 1;
            }else{
                $("#quantidadeT100Vit").html(nvit+"/100");
            }
            gradiente("#progressBarT100Vit", (nvit/100)*100);
            opacidadeGreyScale("#imgTVit100", (nvit/100))

            //TENIS VIT 150
            $("#progressBarT150Vit").css("width", (nvit/150)*100 + "%");
            if(nvit >= 150){
                $("#quantidadeT150Vit").html(150+"/150");
                cont += 1;
            }else{
                $("#quantidadeT150Vit").html(nvit+"/150");
            }
            gradiente("#progressBarT150Vit", (nvit/150)*100);
            opacidadeGreyScale("#imgTVit150", (nvit/150))

            //TENIS VIT 200
            $("#progressBarT200Vit").css("width", (nvit/200)*100 + "%");
            if(nvit >= 200){
                $("#quantidadeT200Vit").html(200+"/200");
                cont += 1;
            }else{
                $("#quantidadeT200Vit").html(nvit+"/200");
            }
            gradiente("#progressBarT200Vit", (nvit/200)*100);
            opacidadeGreyScale("#imgTVit200", (nvit/200))


            
            let nPontos = valores[i][3];
            //TENIS PONT 10
            if(nPontos >= 10){
                $("#quantidadeT10Pnt").html(10+"/10");
                cont += 1;

            }else{
                $("#quantidadeT10Pnt").html(nPontos+"/10");
            }
            $("#progressBarT10Pnt").css("width", (nPontos/10)*100 + "%");
            gradiente("#progressBarT10Pnt", (nPontos/10)*100);
            opacidadeGreyScale("#imgT10Pnt", (nPontos/10))

            //TENIS PONT 30
            if(nPontos >= 30){
                $("#quantidadeT30Pnt").html(30+"/30");
                cont += 1;

            }else{
                $("#quantidadeT30Pnt").html(nPontos+"/30");
            }
            $("#progressBarT30Pnt").css("width", (nPontos/30)*100 + "%");
            gradiente("#progressBarT30Pnt", (nPontos/30)*100);
            opacidadeGreyScale("#imgT30Pnt", (nPontos/30))

            //TENIS PONT 70
            if(nPontos >= 70){
                $("#quantidadeT70Pnt").html(70+"/70");
                cont += 1;
            }else{
                $("#quantidadeT70Pnt").html(nPontos+"/70");
            }
            $("#progressBarT70Pnt").css("width", (nPontos/70)*100 + "%");
            gradiente("#progressBarT70Pnt", (nPontos/70)*100);
            opacidadeGreyScale("#imgT70Pnt", (nPontos/70))

            //TENIS PONT 250
            if(nPontos >= 250){
                $("#quantidadeT250Pnt").html(250+"/250");
                cont += 1;
            }else{
                $("#quantidadeT250Pnt").html(nPontos+"/250");
            }
            $("#progressBarT250Pnt").css("width", (nPontos/250)*100 + "%");
            gradiente("#progressBarT250Pnt", (nPontos/250)*100);
            opacidadeGreyScale("#imgT250Pnt", (nPontos/250))

            //TENIS PONT 1000
            if(nPontos >= 1000){
                $("#quantidadeT1000Pnt").html(1000+"/1000");
                cont += 1;
            }else{
                $("#quantidadeT1000Pnt").html(nPontos+"/1000");
            }
            $("#progressBarT1000Pnt").css("width", (nPontos/1000)*100 + "%");
            gradiente("#progressBarT1000Pnt", (nPontos/1000)*100);
            opacidadeGreyScale("#imgT1000Pnt", (nPontos/1000))

            if(cont <= 3) {
                $("#contagemTenis").html(cont + " de 13");
                $("#contagemTenis").css("background-color", "red");
            } else if (cont <= 6) {
                $("#contagemTenis").html(cont + " de 13")
                $("#contagemTenis").css("background-color", "orange");
            } else if (cont <= 9) {
                $("#contagemTenis").html(cont + " de 13")
                $("#contagemTenis").css("background-color", "gold");
            } else if (cont <= 13) {
                $("#contagemTenis").html(cont + " de 13")
                $("#contagemTenis").css("background-color", "green");
            }
            contagemTotal += cont;
        }

        $("#numeroConquistasTotais").html(contagemTotal + " de 52")


    }


}

function gradiente(id, x){
    if(x < 25){
        $(id).css("background-color", "red");
    }else if(x < 50){
        $(id).css("background-color", "orange");
    }else if(x < 75){
        $(id).css("background-color", "gold");
    }else {
        $(id).css("background-color", "green");
    }
}



function opacidadeGreyScale(imagem, val){
    if(Math.round(val*10)*0.1 < 0.2) {
        $(imagem).css("opacity",  0.2);
    } else {
        $(imagem).css("opacity",  Math.round(val*10)*0.1)
    }
    $(imagem).css("filter", "grayscale(" + (1-val) + ")");
}


function getBadgesRecentes(badges){
    let msg = "";
    let maxPlaceholders = 6;

    if(badges.length != 0) {
        for(let i = 0; i < badges.length; i++){
            let data = new Date(badges[i][2]);
            let stringData = data.toLocaleDateString('pt-PT', { day: '2-digit', month: '2-digit', year: 'numeric' });
    
            msg += "<div class='col-4'>"+
                "<img src='../../dist"+badges[i][1]+"' alt='"+badges[i][0]+"' class='rounded-2 img-fluid mb-0 hover-img' data-toggle='tooltip' data-placement='top' title='"+badges[i][0]+"'>"+
            "</div>";
        }

        
        let restantes = maxPlaceholders - badges.length;
        for (let j = 0; j < restantes; j++) {
            msg += "<div class='col-4 mb-1'>"+
                "<img src='../../dist/images/badges/badge_bloq.png' alt='Bloqueado' class='rounded-circle img-fluid mb-0' data-toggle='tooltip' data-placement='top' title='Bloqueado'>"+
            "</div>";
        }
    } else {
        
        for (let k = 0; k < maxPlaceholders; k++) {
            msg += "<div class='col-4 mb-1'>"+
                "<img src='../../dist/images/badges/badge_bloq.png' alt='Bloqueado' class='rounded-circle img-fluid mb-0' data-toggle='tooltip' data-placement='top' title='Bloqueado'>"+
            "</div>";
        }
    }

    $("#badgesRecentes").html(msg);
}


function getMelhoresBadges(badges){
    let msg = "";
    let maxPlaceholders = 4;

    if(badges.length != 0) {
        for(let i = 0; i < badges.length; i++){
            msg += "<div class='text-center'>"+
                "<img src='../../dist"+badges[i][1]+"' alt='"+badges[i][0]+"' class='img-fluid mb-2 rounded hover-img' data-toggle='tooltip' data-placement='top' title='"+badges[i][0]+"' style='max-width: 50px;'>"+
                "</div>";
        }


        let restantes = maxPlaceholders - badges.length;
        for (let j = 0; j < restantes; j++) {
            msg += "<div class='text-center'>"+
                "<img src='../../dist/images/badges/badge_bloq.png' alt='Bloqueado' class='img-fluid mb-2 rounded-circle' data-toggle='tooltip' data-placement='top' title='Bloqueado' style='max-width: 50px;'>"+
                "</div>";
        }
    } else {

        for (let k = 0; k < maxPlaceholders; k++) {
            msg += "<div class='text-center'>"+
                "<img src='../../dist/images/badges/badge_bloq.png' alt='Bloqueado' class='img-fluid mb-2 rounded-circle' data-toggle='tooltip' data-placement='top' title='Bloqueado' style='max-width: 50px;'>"+
                "</div>";
        }
    }

    $("#melhoresBadges").html(msg);
}

function getComunidades() {
    let urlParams = new URLSearchParams(window.location.search);
    let userId = urlParams.get('id');

    let dados = new FormData();
    dados.append("op", 32);
    dados.append("userId", userId);

    $.ajax({
        url: "../../dist/php/controllerUser.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })

    .done(function (msg) {
        $("#comunidadesPerfil").html(msg);
    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    })

}

function getRadar(userId, mod){

    let dados = new FormData();
    dados.append("op", 34);
    dados.append("userId", userId);
    dados.append("modalidades", mod);

    $.ajax({
        url: "../../dist/php/controllerUser.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })

    .done(function (msg) {
        let obj = JSON.parse(msg);
        console.log(obj)
        for(let i = 0 ; i < obj.length; i++){
            if(obj[i][0][0] == "Padel"){
                plotRadarPadelTenis(obj[i][0], obj[i][1], "radarPadel2",  '#044967', '#1860b8');
                plotHist(obj[i][2], percVit, "#barPadel3", "#044967", '#1860b8', "Padel");
                plotHist(obj[i][3], percMvp, "#barPadel4", "#044967", '#1860b8', "Padel");
            }else if(obj[i][0][0] == "Ténis"){
                plotRadarPadelTenis(obj[i][0], obj[i][1], "radarTenis1",  '#45702d', '#73ab54');
                plotHist(obj[i][2], percVit, "#barTenis3", "#45702d", '#73ab54', "Ténis");
                plotHist(obj[i][3], percMvp, "#barTenis4", "#45702d", '#73ab54', "Ténis");
            }else if(obj[i][0][0] == "Basquetebol"){
                plotRadarBasqFutsal(obj[i][0], obj[i][1], "radarBasket1", '#ffae1f', '#fbe47e')
                plotHist(obj[i][2], percVit, "#barBasket3", "#ffae1f", '#fbe47e', "Basquetebol");
                plotHist(obj[i][3], percMvp, "#barBasket4", "#ffae1f", '#fbe47e', "Basquetebol");
            }else{
                plotRadarBasqFutsal(obj[i][0], obj[i][1], "radarFutsal1", '#fa896b', '#ffb6a3')
                plotHist(obj[i][2], percVit, "#barFutsal3", "#fa896b", '#ffb6a3', "Futsal");
                plotHist(obj[i][3], percMvp, "#barFutsal4", "#fa896b", '#ffb6a3', "Futsal");
            }
        }
    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    })
}

function plotHist(array, val, id, color1 , color2, nome){
    let value  = "";
    for(let i = 0; i < val.length; i++){
        if(val[i][0] == nome){
            value += val[i][1];
        }
    }
    console.log(value)
    let valUser = 0;
    if(value == '100%' || value == '100'){
         valUser = 100;
    }else{
         valUser = parseFloat(value.substring(0,2));
    }
    console.log(valUser)
    let color = [];
    for(let i = 0; i< 100; i+=20){
        if(valUser > i && valUser <= i+20){
            color.push(color1);
            
        }else{
            color.push(color2);
        }
    }
       var options = {
        series: [{
        data: [array[0], array[1], array[2], array[3], array[4]],
        name: "Número de atletas",
      }],
        chart: {
        height: 350,
        type: 'bar',
        events: {
          click: function(chart, w, e) {
            // console.log(chart, w, e)
          }
        },
        toolbar: {
            show: false,
          },
        fontFamily: "Plus Jakarta Sans"
      },
      colors: color,
      plotOptions: {
        bar: {
          columnWidth: '70%',
          distributed: true,
        }
      },
      dataLabels: {
        enabled: false
      },
      legend: {
        show: false
      },
      xaxis: {
        categories: [
          '0-20',
          '20-40',
          '40-60',
          '60-80',
          '80-100',
        ],
        title: {text: "%"}
      }, 
      yaxis: {
        title: {text: "Nº Atletas"},
        labels: {
          style: {
            fontSize: '12px',
          }
        }
      },
      states: {
        hover:{
            filter:{
                type: "none"
            }
        }
      },
      fill: {
        type: "solid",
        opacity: 1.0
      }, 
      legend: {
        show: true,
        showForSingleSeries: true,
        customLegendItems: ['Tu', 'Atletas Courtify'],
        markers: {
          fillColors: [color1, color2]
        }
      }
      };

      var chart = new ApexCharts(document.querySelector(id), options);
      chart.render();
    
}


function plotRadarPadelTenis(array1, array2, nome, cor, cor2){

    var options = {
        series: [
        {
          name: 'Tu',
          data: [
            {
              x: 'Vitórias',
              y: array1[1],
              goals: [
                {
                  name: 'Atletas Courtify',
                  value: array2[1],
                  strokeHeight: 5,
                  strokeColor: cor2
                }
              ]
            },
            {
              x: 'Sets Ganhos',
              y: array1[2],
              goals: [
                {
                  name: 'Atletas Courtify',
                  value: array2[2],
                  strokeHeight: 5,
                  strokeColor: cor2
                }
              ]
            },
            {
                x: 'MVP',
                y: array1[3],
                goals: [
                  {
                    name: 'Atletas Courtify',
                    value: array2[3],
                    strokeHeight: 5,
                    strokeColor: cor2
                  }
                ]
              }
          ]
        }
      ],
        chart: {
        height: 350,
        type: 'bar',
        toolbar: {
            show: false,
          }
        ,
        fontFamily: "Plus Jakarta Sans"
      },
      plotOptions: {
        bar: {
          columnWidth: '50%'
        }
      },
      colors: [cor],
      dataLabels: {
        enabled: false
      },
      legend: {
        show: true,
        showForSingleSeries: true,
        customLegendItems: ['Tu', 'Atletas Courtify'],
        markers: {
          fillColors: [cor, cor2]
        }
      },
      states: {
        hover:{
            filter:{
                type: "none"
            }
        }
      },
      fill: {
        type: "solid",
        opacity: 1.0
      },
      xaxis: {
        title: {text: "%"},
        labels: {
          style: {
            fontSize: '12px',
          }
        }
      }
      };
    
      var chart = new ApexCharts(document.querySelector("#"+nome), options);
      chart.render();

}

function plotRadarBasqFutsal(array1, array2, nome, cor, cor2){

    var options = {
        series: [
        {
          name: 'Tu',
          data: [
            {
              x: '% Vitórias',
              y: array1[1],
              goals: [
                {
                  name: 'Atletas Courtify',
                  value: array2[1],
                  strokeHeight: 5,
                  strokeColor: cor2
                }
              ]
            },
            {
              x: '% MVP',
              y: array1[2],
              goals: [
                {
                  name: 'Atletas Courtify',
                  value: array2[2],
                  strokeHeight: 5,
                  strokeColor: cor2
                }
              ]
            }
            
          ]
        }
      ],
        chart: {
        height: 350,
        type: 'bar',
        toolbar: {
            show: false,
          }
      },
      plotOptions: {
        bar: {
          columnWidth: '50%'
        }
      },
      colors: [cor],
      dataLabels: {
        enabled: false
      },
      fill: {
        type: "solid",
        opacity: 1.0
      },
      legend: {
        show: true,
        showForSingleSeries: true,
        customLegendItems: ['Tu', 'Atletas Courtify'],
        markers: {
          fillColors: [cor, cor2]
        }
      },
      xaxis: {
        title: {text: "%"},
        labels: {
          style: {
            fontSize: '12px',
          }
        }
      }
      };
    
      var chart = new ApexCharts(document.querySelector("#"+nome), options);
      chart.render();
    


}

$(function() {
    getPerfilNavbar();
    getPerfil();
    getJogosRecentes(1);
    getComunidades();
});
