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

        if (elemento.horaAbertura && elemento.horaFecho != null) {
            $(aberturaId).val(elemento.horaAbertura);
            $(fechoId).val(elemento.horaFecho);
        } else {
            $(aberturaId).prop("disabled", true);
            $(fechoId).prop("disabled", true);
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
            fecho: fechoInputs.eq(index).val()
        });
    });

    checkboxes.on('change', function () {
        const index = checkboxes.index(this);

        if ($(this).prop('checked')) {
            aberturaInputs.eq(index).prop('disabled', true).val(null);
            fechoInputs.eq(index).prop('disabled', true).val(null);
        } else {
            aberturaInputs.eq(index).prop('disabled', false);
            fechoInputs.eq(index).prop('disabled', false);

            aberturaInputs.eq(index).val(valoresIniciais[index].abertura);
            fechoInputs.eq(index).val(valoresIniciais[index].fecho);
        }
    });
}






$(function () {
    getInfoDefinicoesClube();
    getNomeClube();
    getHorariosDefinicoesClube();
    setTimeout(function () {eventListenerDiaFechado();}, 1000);
});