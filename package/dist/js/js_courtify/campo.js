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


async function constroiMapa(campoInfo, localidadeUser) {

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

        var combinedQuery = moradaCampo + ', ' + descConcelho;
        var nominatimUrl = 'https://nominatim.openstreetmap.org/search?format=json&q=' + encodeURIComponent(combinedQuery);

        try {
            const response = await fetch(nominatimUrl);
            const data = await response.json();

            if (data.length > 0) {
                var lat = parseFloat(data[0].lat);
                var lon = parseFloat(data[0].lon);
                var coordinates = [lat, lon];

                var marker = L.marker(coordinates)
                    .bindPopup(
                        '<p><strong>' + campoNome + '</strong></p>' +
                        '<p>' + campoDesc + '</p>' +
                        '<p><i class="ti ti-map-pin me-1"></i>' + moradaCampo + '</p>'
                    );

                markers.push(marker);
            }
        } catch (error) {
            console.error('Error geocoding:', error);
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


 


$(document).ready(function () {
    getUserLocation();
    getModalidadesUtilizadorSelect();

});