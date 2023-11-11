

function getInfoPagCampo() {

    
    let urlParams = new URLSearchParams(window.location.search);
    let campoId = urlParams.get('id');

    let dados = new FormData();
    dados.append("op", 5);
    dados.append("id", campoId);

    $.ajax({
        url: "../../dist/php/controllerCampo.php",
        method: "POST",
        data: dados,
        dataType: "json", 
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function(msg) {
        $("#modalidadesCampo").html(msg.modalidadeCampo);
        $("#descricaoCampo").html(msg.descCampo);
        $("#nomeCampo").html(msg.nomeCampo);
        $("#moradaCampo").html(msg.moradaCampo + ", " + msg.concelhoCampo + ", " + msg.distritoCampo);
        $("#fotoCampo").attr("src", msg.fotoCampo);
        $("#imagemCampo1").attr("src", msg.fotoCampo);
        $("#servicosCampo").html(msg.servicos);
        $("#horariosCampo").html(msg.horarioCampo);

        constroiMapaCampo(msg);
    })
    .fail(function(jqXHR, textStatus) {
        console.error("Request failed:", textStatus);
        console.log(jqXHR.responseText);
        alert("Request failed: " + textStatus);
    });
}

async function constroiMapaCampo(campoInfo) {
    coords = [];
    let map;

    if (typeof map !== 'undefined') {
        map.remove();
    }

    var nominatimUrl = 'https://nominatim.openstreetmap.org/search?format=json&q=' + encodeURIComponent(campoInfo.concelhoCampo) + '&limit=1';

    try {
        const response = await fetch(nominatimUrl);
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

    var campoNome = campoInfo.nomeCampo;
    var campoDesc = campoInfo.descCampo;
    var moradaCampo = campoInfo.moradaCampo;
    var idCampo = campoInfo.idCampo;
    var latCampo = campoInfo.latCampo;
    var lonCampo = campoInfo.lonCampo;

    
    var coordinates = [latCampo, lonCampo];
    coords.push([latCampo, lonCampo, idCampo]);
    var marker = L.marker(coordinates)
    .bindPopup(
    '<p><strong>' + campoNome + '</strong></p>' +
    '<p><i class="ti ti-map-pin me-1"></i>' + moradaCampo + '</p>'
    );

    var markerLayer = L.layerGroup([marker]); // Pass an array of markers
    markerLayer.addTo(map);
    map.setView(coordinates, 13);
}


$(function () {
    getInfoPagCampo()
});