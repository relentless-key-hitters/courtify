var container = document.getElementById('visualization');

// Create a DataSet (allows two-way data-binding)
var items = new vis.DataSet([
  { id: 1, content: 'item 1', start: '2014-04-14T10:00:00', end: '2014-04-14T11:00:00', group: 1 },
  { id: 2, content: 'item 1', start: '2014-04-14T10:00:00', end: '2014-04-14T11:00:00', group: 2 },
  { id: 3, content: 'item 1', start: '2014-04-14T10:00:00', end: '2014-04-14T11:00:00', group: 3 },
  { id: 4, content: 'item 1', start: '2014-04-14T10:00:00', end: '2014-04-14T11:00:00', group: 4 },
]);

// Create a DataSet for groups
var groups = new vis.DataSet([
  { id: 1, content: 'Padel 1' },
  { id: 2, content: 'Padel 2' },
  { id: 3, content: 'Padel 3' },
  { id: 4, content: 'Ténis 1' },
  { id: 5, content: 'Ténis 2' },
  { id: 6, content: 'Ténis 3' },
  { id: 7, content: 'Ténis 4' },

]);

// Configuration for the Timeline
var options = {
    start: '2014-04-14T00:00:00',
    end: '2014-04-14T23:59:59',
    min: '2014-04-14T00:00:00',
    max: '2014-04-14T23:59:59',
    zoomMin: 1000 * 60 * 30,       // Set the minimum zoom level to 30 minutes
    zoomMax: 1000 * 60 * 30,       // Set the maximum zoom level to 30 minutes (same as zoomMin)
    orientation: 'top',
    zoomable: false,
    margin: {
        item: 10, // minimal margin between items
        axis: 5   // minimal margin between items and the axis
      },
    stack: false,  // Ensure that items don't stack on top of each other
    showMajorLabels: true,
    showMinorLabels: true,  // Set this to true to show minor labels
    snap: function (date, scale, step) {
      // Snap to half-hour intervals
      var base = new Date(date).setMinutes(0, 0, 0);
      var interval = 30 * 60 * 1000;  // 30 minutes
      var rounded = Math.round(base / interval) * interval;
      return rounded + (rounded === base ? 0 : interval);
    },
  };

// Create a Timeline
var timeline = new vis.Timeline(container, items, groups, options);


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
        $("#modalidadesCampo").html(msg.modalidadesClube);
        $("#descricaoCampo").html(msg.descClube);
        $("#nomeCampo").html(msg.nomeClube);
        $("#moradaCampo").html(msg.moradaClube + ", " + msg.concelhoClube + ", " + msg.distritoClube);
        $("#fotoCampo").attr("src", msg.fotoClube);
        $("#imagemCampo1").attr("src", msg.fotoClube);
        $("#servicosCampo").html(msg.servicos);
        $("#horariosCampo").html(msg.horarioClube);
        $("#telefoneClube").html(msg.telefoneClube);
        $("#emailClube").html(msg.emailClube);
        $("#telemovelClube").html(msg.telemovelClube);
        $("#moradaClube1").html(msg.codigoPostalClube);

        constroiMapaCampo(msg);
    })
    .fail(function(jqXHR, textStatus) {
        console.error("Request failed:", textStatus);
        console.log(jqXHR.responseText);
        alert("Request failed: " + textStatus);
    });
}

async function constroiMapaCampo(clubeInfo) {
    coords = [];
    let map;

    if (typeof map !== 'undefined') {
        map.remove();
    }

    var nominatimUrl = 'https://nominatim.openstreetmap.org/search?format=json&q=' + encodeURIComponent(clubeInfo.concelhoClube) + '&limit=1';

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

    var clubeNome = clubeInfo.nomeClube;
    var moradaClube = clubeInfo.moradaClube;
    var idClube = clubeInfo.idClube;
    var latClube = clubeInfo.lat;
    var lonClube = clubeInfo.lon;

    
    var coordinates = [latClube, lonClube];
    coords.push([latClube, lonClube, idClube]);
    var marker = L.marker(coordinates)
    .bindPopup(
    '<p><strong>' + clubeNome + '</strong></p>' +
    '<p><i class="ti ti-map-pin me-1"></i>' + moradaClube + '</p>'
    );

    var markerLayer = L.layerGroup([marker]); // Pass an array of markers
    markerLayer.addTo(map);
    map.setView(coordinates, 13);
}


$(function () {
    getInfoPagCampo();



});