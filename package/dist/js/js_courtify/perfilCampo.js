var container = document.getElementById('visualization');

// Create a DataSet (allows two-way data-binding)
var items = new vis.DataSet([
  { id: 1, content: '', start: '2014-04-14T09:00:00', end: '2014-04-14T10:00:00', group: 1 },
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
    orientation: 'top',
    zoomable: false,
    editable: false,
    selectable: false,
    timeAxis: {
     scale: 'hour',
     step: 1,
    },
    start: '2014-04-14T06:00:00', // Set a default start time
    end: '2014-04-14T18:00:00',
   };
   

// Create a Timeline
var timeline = new vis.Timeline(container, items, groups, options);

timeline.on('doubleClick', function (properties) {
    // Prevent the default double-click action of the library
    properties.event.preventDefault();
  
    // Check if the double-click was on an empty space
    if (properties.what === 'background') {
      // Get the clicked time
      var clickedTime = properties.time;
  
      // Subtract 6 hours from both start and end times
      var adjustedStartTime = new Date(clickedTime);
      adjustedStartTime.setUTCHours(adjustedStartTime.getUTCHours() - 6);
  
      var adjustedEndTime = new Date(adjustedStartTime);
      adjustedEndTime.setUTCHours(adjustedEndTime.getUTCHours() + 1);
  
      // Check if there is already an item in the clicked time and group
      var existingItems = items.get({
        filter: function (item) {
          return (
            item.group === properties.group &&
            item.start <= adjustedEndTime &&
            item.end >= adjustedStartTime
          );
        },
      });
  
      // If no existing items, create a new item with adjusted times
      if (existingItems.length === 0) {
        var newItem = { content: '', start: adjustedStartTime, end: adjustedEndTime, group: properties.group };
        items.add(newItem);
      }
    }
  });

  
  
  




   


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