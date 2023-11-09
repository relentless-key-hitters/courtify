let arrHiden =[];
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
            getCampos(msg);
            

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

function getCampos(localidade){

    let dados = new FormData();
    dados.append("op", 1);
    dados.append("localidade", localidade);

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
            
            $("#rowCampos").html(obj.html);
            constroiMapa(obj.dados, obj.localidadeUser);
        })
        
        .fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
        });

}

let coords = [];
let dist = [];

async function constroiMapa(campoInfo, localidadeUser) {
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
        var campoNome = info.campoNome;
        var campoDesc = info.campoDesc;
        var moradaCampo = info.moradaCampo;
        var descConcelho = info.descConcelho;
        var idCampo = info.idCampo;
        var latCampo = info.latCampo;
        var lonCampo = info.lonCampo;

        
        var coordinates = [latCampo, lonCampo];
        coords.push([latCampo, lonCampo, idCampo]);
        var marker = L.marker(coordinates)
            .bindPopup(
            '<p><strong>' + campoNome + '</strong></p>' +
            '<p>' + campoDesc + '</p>' +
            '<p><i class="ti ti-map-pin me-1"></i>' + moradaCampo + '</p>'
            );
            if(arrHiden.length == 0){
                markers.push(marker);
            }else{
                for(let i = 0; i < arrHiden.length; i++){
                    if(arrHiden[i] != idCampo){
                        markers.push(marker);
                    }else{
                        $("#campo" + idCampo).hide();
                        
                    }
                }
            }

      
            
        marker.on('click', function () {
            
            var cardToHighlight = document.querySelector('[data-id="' + idCampo + '"]');
        
            
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

    
    for (const info of campoInfo) {
        await createMarkerWithPopup(info);
    }

    
    var markerLayer = L.layerGroup(markers);
    markerLayer.addTo(map);
    getDistancias();
    console.log(coords);
}

function pesquisarCampos() {

    let dados = new FormData();
    dados.append("op", 4);
    dados.append("stringPesquisa", $("#stringPesquisa").val());
    dados.append("modalidadePesquisa", $("#pesquisaMarcacaoModalidade").val());
    dados.append("dataPesquisa", $("#currentDateInput").val());
    dados.append("horaPesquisa", $("#currentTimeInput").val());

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
                
                $(this).html("");
                
                
                $(this).html(obj.html);
            
                
                $(this).fadeIn("fast");
            });
            
            constroiMapa(obj.dados, obj.localidadeUser);
            

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
    console.log(dist)
}


function aplicarFiltros(){
    arrHiden = [];
    let distancia = $("#filtroDistancia").val();

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
    getUserLocation()
}


$(document).ready(function () {
    getUserLocation();

});

