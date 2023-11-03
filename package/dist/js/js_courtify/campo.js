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
            let obj = JSON.parse(msg);
            $("#rowCampos").html(obj.html);

            constroiMapa(obj.dados);
            

        })
        
        .fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
        });

}


async function constroiMapa(campoInfo) {
    var map = L.map('rightContainer').setView([38.5663, -7.8942], 13);

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
            
            if (highlightedCard) {
                highlightedCard.classList.remove('border', 'border-2', 'border-primary', 'shadow');
                highlightedCard.style.transition = 'none'; 
            }

            
            var dataId = info.idCampo; 
            var cardToHighlight = document.querySelector('[data-id="' + dataId + '"]');

            
            if (cardToHighlight) {
                cardToHighlight.style.transition = '';
                cardToHighlight.classList.add('border', 'border-2', 'border-primary', 'shadow');
                highlightedCard = cardToHighlight; 
            }
        });
    }

    
    for (const info of campoInfo) {
        await createMarkerWithPopup(info);
    }

    
    var markerLayer = L.layerGroup(markers);
    markerLayer.addTo(map);
}


$(document).ready(function () {
    getCampos();
});