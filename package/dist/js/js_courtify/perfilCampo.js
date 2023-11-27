let idCampo;
let hora;
let idCampoMarc;
let nParticipantesMax;
var amigosEscolhidos = [];

function getInfoPagCampo() {

    
    let urlParams = new URLSearchParams(window.location.search);
    let campoId = urlParams.get('id');

    let dados = new FormData();
    dados.append("op", 5);
    dados.append("id", campoId);
    idCampo = campoId;
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
        let obj1 = msg.info_clube;
        let obj2 = msg.marcacaoClube;
        $("#modalidadesCampo").html(obj1.modalidadesClube);
        $("#descricaoCampo").html(obj1.descClube);
        $("#nomeCampo").html(obj1.nomeClube);
        $("#moradaCampo").html(obj1.moradaClube + ", " + obj1.concelhoClube + ", " + obj1.distritoClube);
        $("#fotoCampo").attr("src", obj1.fotoClube);
        $("#imagemCampo1").attr("src", obj1.fotoClube);
        $("#servicosCampo").html(obj1.servicos);
        $("#horariosCampo").html(obj1.horarioClube);
        $("#telefoneClube").html(obj1.telefoneClube);
        $("#emailClube").html(obj1.emailClube);
        $("#telemovelClube").html(obj1.telemovelClube);
        $("#moradaClube1").html(obj1.codigoPostalClube);
        $("#marcacaoCampo").html(obj2);
        constroiMapaCampo(obj1);
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


function marcarCampo(id){
    let dados = new FormData();
    dados.append("op", 6);
    dados.append("id", id);

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
            $("#bodyMarcacao").html(obj.modal);
            $("#vertical-center-modal").modal('show');
            $("#botaoGuardarMarcacao").attr('onclick',  'guardarMarcacao('+idCampoMarc+')');
            hora = obj.hora;
            idCampoMarc = obj.idCampo;
    })
    .fail(function(jqXHR, textStatus) {
        console.error("Request failed:", textStatus);
        console.log(jqXHR.responseText);
        alert("Request failed: " + textStatus);
    });  

}


function guardarMarcacao(id){

    let dados = new FormData();
    dados.append("op", 7);
    dados.append("id", id);
    dados.append("duracao", $("#selecthora").val());
    console.log( $("#selecthora").val())
    dados.append("horas", hora);
    if($("#aberta").is(":checked")){
        dados.append("tipoMarcacao", 'aberta');
    }
    if($("#fechada").is(":checked")){
        dados.append("tipoMarcacao", 'fechada');
    }

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
        alerta2("Perfil", obj.msg, obj.icon);
        setTimeout(function(){ 
            location.reload();
        }, 2000);
        getInfoPagCampo();
    })
    .fail(function(jqXHR, textStatus) {
        console.error("Request failed:", textStatus);
        console.log(jqXHR.responseText);
        alert("Request failed: " + textStatus);
    });  


}

function mostrarAmigos(nParticipantes) {
    $("#divAmigosMarcacao").removeClass("d-none");
    amigosEscolhidos.maxLength = nParticipantes; 

}

function esconderAmigos() {
    if ($("#divAmigosMarcacao").find('.selected-img').length > 0) {
        $("#divAmigosMarcacao").find('.selected-img').removeClass('selected-img');
    }

    $("#divAmigosMarcacao").addClass("d-none");
    amigosEscolhidos.length = 0;

}

function podeSelecionarAmigo() {

    return amigosEscolhidos.length < amigosEscolhidos.maxLength - 1;
}


function toggleImageSelection(imgElement) {
    if (imgElement.classList.contains('selected-img')) {
      imgElement.classList.remove('selected-img');
  

      var index = amigosEscolhidos.indexOf(imgElement);
  

      if (index !== -1) {

        amigosEscolhidos.splice(index, 1);
      }
    } else {
      if (podeSelecionarAmigo()) {
        $(imgElement).addClass('selected-img');
        amigosEscolhidos.push(imgElement);
      } else {
        alert("Limite máximo de jogadores atingido!");
      }
    }
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

$(function () {
    getInfoPagCampo();

});