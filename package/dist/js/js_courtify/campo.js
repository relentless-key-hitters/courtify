let arrHiden =[];
let obsCampos = [];
let obsUser = [];
function getUserLocation() {
    let dados = new FormData();
    dados.append("op", 2);

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
            getModalidadesUtilizadorSelect();
            getCampos(msg, 1);
            $("#currentTimeInput").val(-1);
            

        })
        
        .fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
        });
}

function getModalidadesUtilizadorSelect() {
    let dados = new FormData();
    dados.append("op", 3);

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
            $("#pesquisaMarcacaoModalidade").html(msg);
        })
        
        .fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
        });


}

function getCampos(localidade, pagina) {
    let dados = new FormData();
    dados.append("op", 1);
    dados.append("localidade", localidade);
    dados.append("pagina", pagina);

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
            let obj = JSON.parse(msg);
            obsCampos = obj.dados;
            obsUser = obj.localidadeUser;
            $("#rowCampos").hide().html(obj.html).fadeIn('slow');

            adicionarLinksPaginacao(obj.paginasTotais, obj.paginaAtual, obj.localidadeUser);

            constroiMapa(obj.dados, obj.localidadeUser);
        })
        
        .fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
        });

}


function adicionarLinksPaginacao(paginasTotais, paginaAtual, concelho) {
    let msgHtml = "<nav aria-label='Page navigation example' class='bg-light d-flex justify-content-end'>";
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

    $("#paginacaoMarcacao").html(msgHtml);

    // Event listener para os botões da página que redirecionam para outras páginas para impedir o recarregamento da página
    $(".page-link.link").on("click", function(event) {
        event.preventDefault();
        let paginaClicada = $(this).data("page");
        getCampos(concelho, paginaClicada);
    });
}

let coords = [];
let dist = [];

async function constroiMapa(clubeInfo, localidadeUser) {
    coords = [];
    dist = [];
    if (typeof map !== 'undefined') {
        map.remove();
    }

    var nominatimUrlUser = 'https://nominatim.openstreetmap.org/search?format=json&q=' + encodeURIComponent(localidadeUser);

    try {
        const response = await fetch(nominatimUrlUser);
        const data = await response.json();

        if (data.length > 0) {
            var lat = parseFloat(data[0].lat);
            var lon = parseFloat(data[0].lon);
            var coordinates = [lat, lon];
            coords.push([lat, lon,0]);
            map = L.map('mapa').setView([coordinates[0], coordinates[1]], 13);
        }
    } catch (error) {
        console.error('Error geocoding:', error);
    }

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    var markers = [];

    var highlightedCard = null;
    async function createMarkerWithPopup(info) {
        var clubeNome = info.nomeClube;
        var clubeDesc = info.clubeDesc;
        var moradaClube = info.moradaClube;
        var descConcelho = info.descConcelho;
        var idClube = info.idClube;
        var latClube = info.latClube;
        var lonClube = info.lonClube;

        
        var coordinates = [latClube, lonClube];
        coords.push([latClube, lonClube, idClube]);
        var marker = L.marker(coordinates)
            .bindPopup(
            '<p><strong>' + clubeNome + '</strong></p>' +
            '<p><i class="ti ti-map-pin me-1"></i>' + moradaClube + '</p>'
            );
            if(arrHiden.length == 0){
                markers.push(marker);
                if($("#clube" + idClube).is(':hidden')){
                    $("#clube" + idClube).show();
                }
            }else{
                let flag1 = true;
                for(let i = 0; i < arrHiden.length; i++){
                    if(arrHiden[i] == idClube){
                        flag1 = false;
                    }
                }
                if(flag1){
                    markers.push(marker);

                }else{
                    $("#clube" + idClube).hide();
                }
            }

      
            
        marker.on('click', function () {
            
            var cardToHighlight = document.querySelector('[data-id="' + idClube + '"]');
        
            
            if (cardToHighlight) {
                if (cardToHighlight === highlightedCard) {
                    
                    cardToHighlight.classList.remove('border', 'border-1', 'border-primary', 'shadow');
                    highlightedCard = null;
                } else {
                    
                    if (highlightedCard) {
                        highlightedCard.classList.remove('border', 'border-1', 'border-primary', 'shadow');
                    }
                    cardToHighlight.classList.add('border', 'border-1', 'border-primary', 'shadow');
                    highlightedCard = cardToHighlight;
                }
            }
        });
    }

    
    for (const info of clubeInfo) {
        await createMarkerWithPopup(info);
    }

    
    var markerLayer = L.layerGroup(markers);
    markerLayer.addTo(map);
    getDistancias();
}

function pesquisarCampos() {

    let dados = new FormData();
    dados.append("op", 4);
    dados.append("stringPesquisa", $("#stringPesquisa").val());
    dados.append("modalidadePesquisa", $("#pesquisaMarcacaoModalidade").val());
    dados.append("dataPesquisa", $("#currentDateInput").val());
    dados.append("horaPesquisa", $("#currentTimeInput").val());
    obsCampos = [];
    console.log($("#currentTimeInput").val())
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
            let obj = JSON.parse(msg);
            $("#stringPesquisa").val("");
            $("#pesquisaMarcacaoModalidade").val("-1");
            
            $("#rowCampos").fadeOut("fast", function() {
                obsCampos = obj.dados
                $(this).html("");
                
                
                $(this).html(obj.html);
            
                
                $(this).fadeIn("fast");
            });
            
            constroiMapa(obj.dados, obsUser);
        })
        
        .fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
        });
}

function getDistancias(){

    let r = 6371e3;
    let a1= coords[0][0] * Math.PI / 180 ;
    for(let i = 1; i < coords.length; i++){
        let a2= coords[i][0] * Math.PI / 180 ;
        let b1 = (coords[i][0] - coords[0][0]) * Math.PI / 180;
        let b2 = (coords[i][1] - coords[0][1]) * Math.PI / 180;

        let c = Math.sin(b1/2) * Math.sin(b1/2) + Math.cos(a1) * Math.cos(a2) * Math.sin(b2/2) * Math.sin(b2/2);
        let d = 2 * Math.atan2(Math.sqrt(c), Math.sqrt(1-c));
        dist.push([d * r, coords[i][2]]);
    }
}


function aplicarFiltros(){
    arrHiden = [];
    let distancia = $("#filtroDistancia").val();
    let tipo = $("#filtroTipo").val();
    if( distancia == null && tipo == null){

    }else if(distancia != null && tipo == null){
        if (distancia == "0-1km") {
            for (let j = 0; j < dist.length; j++) {
                if (Array.isArray(dist[j]) && dist[j][0] > 1000) {
                    arrHiden.push(dist[j][1])
    
                }
            }
        } else if(distancia == "1-5km") {
            for (let j = 0; j < dist.length; j++) {
                if (Array.isArray(dist[j]) && dist[j][0] > 5000) {
                    arrHiden.push(dist[j][1])
    
                }
            }
        }else if(distancia == "5-10km") {
            for (let j = 0; j < dist.length; j++) {
                if (Array.isArray(dist[j]) && dist[j][0] > 10000) {
                    arrHiden.push(dist[j][1])
    
                }
            }
        }
        constroiMapa(obsCampos, obsUser)
    }else if(distancia == null && tipo != null){
        for(let i = 0; i < dist.length; i++){
            let flag = false;
            for(let j = 0 ; j < obsCampos[i].tiposCamposClube.length; j++){
                if(obsCampos[i].tiposCamposClube[j] == tipo){
                    flag = true;
                }
            }
            if(!flag){
                arrHiden.push(dist[i][1]);
            }
        }
        constroiMapa(obsCampos, obsUser)
    }else if(distancia != null && tipo != null){
            if (distancia == "0-1km") {
                for (let j = 0; j < dist.length; j++) {
                    let flag = false;
                    for(let k = 0 ; k < obsCampos[j].tiposCamposClube.length; k++){
                        if ((Array.isArray(dist[j]) && dist[j][0] > 1000 && tipo == obsCampos[j].tiposCamposClube[k]) || (Array.isArray(dist[j]) && dist[j][0] < 1000 && tipo != obsCampos[j].tiposCamposClube[k]) || (Array.isArray(dist[j]) && dist[j][0] > 1000 && tipo != obsCampos[j].tiposCamposClube[k])) {
                        }else{
                            flag = true;
                        }
                    }
                    if(!flag){
                        arrHiden.push(dist[j][1]);
                    }

                }
            }else if(distancia == "1-5km") {
                for (let j = 0; j < dist.length; j++) {
                    let flag = false;
                    for(let k = 0 ; k < obsCampos[j].tiposCamposClube.length; k++){
                        if ((Array.isArray(dist[j]) && dist[j][0] > 5000 && tipo == obsCampos[j].tiposCamposClube[k]) || (Array.isArray(dist[j]) && dist[j][0] < 5000 && tipo != obsCampos[j].tiposCamposClube[k]) || (Array.isArray(dist[j]) && dist[j][0] > 5000 && tipo != obsCampos[j].tiposCamposClube[k])) {
                        }else{
                            flag = true;
                        }
                    }
                    if(!flag){
                        arrHiden.push(dist[j][1]);
                    }

                }
            }else if(distancia == "5-10km") {
                for (let j = 0; j < dist.length; j++) {
                    let flag = false;
                    for(let k = 0 ; k < obsCampos[j].tiposCamposClube.length; k++){
                        if ((Array.isArray(dist[j]) && dist[j][0] > 10000 && tipo == obsCampos[j].tiposCamposClube[k]) || (Array.isArray(dist[j]) && dist[j][0] < 10000 && tipo != obsCampos[j].tiposCamposClube[k]) || (Array.isArray(dist[j]) && dist[j][0] > 10000 && tipo != obsCampos[j].tiposCamposClube[k])) {
                        }else {
                            flag = true;
                        }
                    }
                    if(!flag){
                        arrHiden.push(dist[j][1]);
                    }

                }
            }

        constroiMapa(obsCampos, obsUser)
    }
    
    for(let i = 0 ; i < obsCampos.length; i++){
        let flag = true;
        for(let j = 0; j < arrHiden.length; j++){
            if(obsCampos[i].idClube == arrHiden[j]){
                flag = false;
            }
        }
        if (!flag){
            $("#clube" + obsCampos[i].idClube).hide();
        }else{
            if($("#clube" + obsCampos[i].idClube).is(':hidden')){
                $("#clube" + obsCampos[i].idClube).show();
            }
        }
    }
}



function removerFiltros(){
    arrHiden = []
    constroiMapa(obsCampos, obsUser)
    $("#filtroDistancia").val(-1);
    $("#filtroTipo").val(-1);
}

function redirectToCampo(idClube) {
    window.location.href = 'clube.php?id=' + idClube;
}


$(document).ready(function () {
    getUserLocation();

});

