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
        var idCampo = info.idCampo;

        var nominatimUrl = 'https://nominatim.openstreetmap.org/search?format=json&q=' + encodeURIComponent(moradaCampo);

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
            // Find the card with the matching data-id attribute
            var dataId = info.idCampo; // Replace 'idCampo' with the actual unique identifier
            var cardToHighlight = document.querySelector('[data-id="' + dataId + '"]');

            // If the clicked marker corresponds to the currently highlighted card, un-highlight it
            if (highlightedCard === cardToHighlight) {
                cardToHighlight.classList.remove('border', 'border-2', 'border-primary');
                highlightedCard = null;
            } else {
                // Remove the highlight from the previously highlighted card, if any
                if (highlightedCard) {
                    highlightedCard.classList.remove('border', 'border-2', 'border-primary');
                }

                // Add the 'highlighted-card' class to highlight the new card
                if (cardToHighlight) {
                    cardToHighlight.classList.add('border', 'border-2', 'border-primary');
                    highlightedCard = cardToHighlight; // Update the currently highlighted card
                }
            }
        });
    }

    // Create markers with popups for each campoInfo item
    for (const info of campoInfo) {
        await createMarkerWithPopup(info);
    }

    // Create a layer group from the markers and add it to the map
    var markerLayer = L.layerGroup(markers);
    markerLayer.addTo(map);
}


$(document).ready(function () {
    getCampos();
});