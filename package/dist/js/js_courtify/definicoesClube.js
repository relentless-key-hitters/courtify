function getNomeClube() {
    let dados = new FormData();
    dados.append("op", 4);

    $.ajax({
        url: "../../dist/php/controllerClube.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })

    .done(function (msg) {
        $("#nomeClube").html("<i class='ti ti-building me-2'></i>" + msg)
    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    })

}

function getInfoDefinicoesClube() {
    let dados = new FormData();
    dados.append("op", 6);

    $.ajax({
        url: "../../dist/php/controllerClube.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })

    .done(function (msg) {
        let obj = JSON.parse(msg);
        let obj2 = JSON.parse(obj.arraySelects)
        console.log(obj)
        $("#fotoClubeEditCurrent").attr("src", obj.fotoClube);
        $("#nomeClubeEdit").val(obj.nomeClube)
        $("#distritoClubeEdit").html(obj2.msg)
        $("#concelhoClubeEdit").html(obj2.msg2)
        $("#nifClubeEdit").val(obj.nifClube)
        $("#cpClubeEdit").val(obj.codigoPostalClube)
        $("#anoFundacaoClubeEdit").val(obj.anoFundacaoClube)
        $("#telemovelClubeEdit").val(obj.telemovelClube)
        $("#telefoneClubeEdit").val(obj.telefoneClube)
        $("#moradaClubeEdit").val(obj.moradaClube)
        $("#descricaoClubeEdit").val($('<div/>').html(obj.descricaoClube).text());
        $("#emailClubeEdit").val(obj.emailClube)
    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    })
}

function getHorariosDefinicoesClube() {
    let dados = new FormData();
    dados.append("op", 7);

    $.ajax({
        url: "../../dist/php/controllerClube.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })

    .done(function (msg) {
        let obj = JSON.parse(msg);
        console.log(obj);

        const diasSemana = ['Segunda', 'Terca', 'Quarta', 'Quinta', 'Sexta', 'Sabado', 'Domingo'];

        for (let i = 0; i < obj.length; i++) {
            const elemento = obj[i];
            const aberturaId = "#abertura" + diasSemana[i];
            const fechoId = "#fecho" + diasSemana[i];

            if (elemento.horaAbertura != '00:00:00' && elemento.horaFecho != '00:00:00') {
                $(aberturaId).val(elemento.horaAbertura);
                $(fechoId).val(elemento.horaFecho);
            } else {
                $(aberturaId).val(null).prop("disabled", true);
                $(fechoId).val(null).prop("disabled", true);
            }
        }

    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    })
}

function eventListenerDiaFechado() {
    const checkboxes = $('.form-check-input');
    const aberturaInputs = $('input[id^="abertura"]');
    const fechoInputs = $('input[id^="fecho"]');

    let valoresIniciais = [];
    aberturaInputs.each(function (index) {
        valoresIniciais.push({
            abertura: $(this).val(),
            fecho: fechoInputs.eq(index).val(),
            isDisabled: $(this).is(':disabled')
        });

        // Se os inputs já tiverem desativados no carregamento da página, dar check na caixa
        if ($(this).is(':disabled')) {
            checkboxes.eq(index).prop('checked', true);
        }
    });

    checkboxes.on('change', function () {
        const index = checkboxes.index(this);

        if ($(this).prop('checked')) {
            aberturaInputs.eq(index).prop('disabled', true).val(null);
            fechoInputs.eq(index).prop('disabled', true).val(null);
        } else {
            aberturaInputs.eq(index).prop('disabled', false);
            fechoInputs.eq(index).prop('disabled', false);

            // Se os inputs não estavam originalmente desativados, repor os valores
            if (!valoresIniciais[index].isDisabled) {
                aberturaInputs.eq(index).val(valoresIniciais[index].abertura);
                fechoInputs.eq(index).val(valoresIniciais[index].fecho);
            }
        }
    });
}

//preview foto definicoes clube
$('#fotoClubeEditNova').on('change', function(event) {
    if (event.target.files && event.target.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#fotoClubeEditCurrent').attr('src', e.target.result).width(420).height(220);
        };
        reader.readAsDataURL(event.target.files[0]);
    }
});

function alterarFotoClube() {
    let dados = new FormData();
    dados.append("op", 12);
    dados.append("fotoClubeEditNova", $('#fotoClubeEditNova').prop('files')[0]);

    $.ajax({
        url: "../../dist/php/controllerClube.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })

    .done(function (msg) {
        let obj = JSON.parse(msg);
        alerta(obj.title, obj.msg, obj.icon);
        setTimeout(function () {location.reload();}, 3000);
    })

    .fail(function (jqXHR, textStatus) {
        
    })
}

async function guardarEditClube() {
    let dados = new FormData();
    dados.append("op", 13);
    dados.append("nomeClubeEdit", $('#nomeClubeEdit').val());
    dados.append("anoFundacaoClubeEdit", $('#anoFundacaoClubeEdit').val());
    dados.append("telemovelClubeEdit", $('#telemovelClubeEdit').val());
    dados.append("telefoneClubeEdit", $('#telefoneClubeEdit').val());
    dados.append("moradaClubeEdit", $('#moradaClubeEdit').val());
    dados.append("descricaoClubeEdit", $('#descricaoClubeEdit').val());
    dados.append("emailClubeEdit", $('#emailClubeEdit').val());
    dados.append("nifClubeEdit", $('#nifClubeEdit').val());
    dados.append("cpClubeEdit", $('#cpClubeEdit').val());
    dados.append("distritoClubeEdit", $('#distritoClubeEdit').val());
    dados.append("concelhoClubeEdit", $('#concelhoClubeEdit').val());

    await constroiMapa($('#moradaClubeEdit').val(), $('#cpClubeEdit').val()).then((array) => {
        dados.append("latitudeClubeEdit", array[0]);
        dados.append("longitudeClubeEdit", array[1]);
    })

    

    
    let objHorarios = {
        'segunda': {
                    'id': 1, 
                    'abertura': $('#aberturaSegunda').val() !== '' ? $('#aberturaSegunda').val() : "00:00:00", 
                    'fecho': $('#fechoSegunda').val() !== '' ? $('#fechoSegunda').val() : "00:00:00"
                },
        'terca': {
                    'id': 2, 
                    'abertura': $('#aberturaTerca').val() !== '' ? $('#aberturaTerca').val() : "00:00:00", 
                    'fecho': $('#fechoTerca').val() !== '' ? $('#fechoTerca').val() + ":00" : "00:00:00"
                },
        'quarta': {
                    'id': 3, 
                    'abertura': $('#aberturaQuarta').val() !== '' ? $('#aberturaQuarta').val() : "00:00:00", 
                    'fecho': $('#fechoQuarta').val() !== '' ? $('#fechoQuarta').val() : "00:00:00"
                },
        'quinta': {
                    'id': 4, 
                    'abertura': $('#aberturaQuinta').val() !== '' ? $('#aberturaQuinta').val() : "00:00:00", 
                    'fecho': $('#fechoQuinta').val() !== '' ? $('#fechoQuinta').val() : "00:00:00"
                },
        'sexta': {
                    'id': 5, 
                    'abertura': $('#aberturaSexta').val() !== '' ? $('#aberturaSexta').val() : "00:00:00", 
                    'fecho': $('#fechoSexta').val() !== '' ? $('#fechoSexta').val() : "00:00:00"
                },
        'sabado': {
                    'id': 6, 
                    'abertura': $('#aberturaSabado').val() !== '' ? $('#aberturaSabado').val() : "00:00:00", 
                    'fecho': $('#fechoSabado').val() !== '' ? $('#fechoSabado').val() : "00:00:00"
                },
        'domingo': {
                    'id': 7, 
                    'abertura': $('#aberturaDomingo').val() !== '' ? $('#aberturaDomingo').val() : "00:00:00", 
                    'fecho': $('#fechoDomingo').val() !== '' ? $('#fechoDomingo').val() : "00:00:00"
                }
    };

    dados.append("objHorarios", JSON.stringify(objHorarios));

    if ($("#passwordAtualClubeEdit").val() !== "" && $("#passwordNovaClubeEdit").val() !== "" && $("#passwordNovaClubeEdit2").val() !== "") {

        dados.append("passwordAtualClubeEdit", $("#passwordAtualClubeEdit").val());
        dados.append("passwordNovaClubeEdit", $("#passwordNovaClubeEdit").val());
        dados.append("passwordNovaClubeEdit2", $("#passwordNovaClubeEdit2").val());
    }

    $.ajax({
        url: "../../dist/php/controllerClube.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })

    .done(function (msg) {
        let obj = JSON.parse(msg);
        alerta(obj.title, obj.msg, obj.icon);
        //setTimeout(function () {location.reload();}, 3000);
    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    })
}

async function constroiMapa(morada, cp) {
    let array = [];
  
    let localidadeUser = "" + morada + ", " + cp + "";
    var nominatimUrlUser = 'https://nominatim.openstreetmap.org/search?format=json&q=' + encodeURIComponent(localidadeUser);
  
    try {
      const response = await fetch(nominatimUrlUser);
      const data = await response.json();
  
      if (data.length > 0) {
        array.push(parseFloat(data[0].lat));
        array.push(parseFloat(data[0].lon));
      }
      return array;
    } catch (error) {
        console.error('Error geocoding:', error);
        return array;
    }
}


function alerta(titulo,msg,icon){
    Swal.fire({
        position: 'center',
        icon: icon,
        title: titulo,
        text: msg,
        showConfirmButton: false,
        confirmButtonColor: '#45702d',
        timer: 3000
      })
}

$(function () {
    getInfoDefinicoesClube();
    getNomeClube();
    getHorariosDefinicoesClube();
    setTimeout(function () {eventListenerDiaFechado();}, 500);

    
});