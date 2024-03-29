function getCamposClube(){

    let dados = new FormData();
    dados.append("op", 11);

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
        if($.fn.DataTable.isDataTable('#tabela')){
            $('#tabela').DataTable().destroy()
        }
        $("#tableCampos").html(msg)
        $('#tabela').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-PT.json',
            }
        });
    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    })

}

function getCamposManutencao(){
    let dados = new FormData();
    dados.append("op", 14);

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
        if($.fn.DataTable.isDataTable('#tabela1')){
            $('#tabela1').DataTable().destroy()
        }
        $("#tableCampos2").html(msg)
        $('#tabela1').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-PT.json',
            }
        });
    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    })
}

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

function editarPrecoHoraCampo(idCampo) {

    let dados = new FormData();
    dados.append("op", 16);
    dados.append("idCampo", idCampo);

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
        $("#corpoModalAlterarPreco").html(msg)
        $("#modalAlterarPreco").modal("show");
    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    })
}


function guardarEditPrecoClube(idCampo) {

    let dados = new FormData();
    dados.append("op", 17);
    dados.append("precoNovo", $("#precoCampoClubeNovo").val());
    dados.append("idCampo", idCampo);

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
        alerta2(obj.title, obj.msg, obj.icon);
        setTimeout(function () { location.reload() }, 3000);
    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    })
}

function editarDataManutencaoCampo(idCampo) {
    $("#botaoSalvarDataManut").attr("onclick", "guardarEditDataManutencaoCampo("+idCampo+")");
    $("#modalAlterarDataManutencao").modal("show");
}

function guardarEditDataManutencaoCampo($idCampo) {

    let dados = new FormData();
    dados.append("op", 18);
    dados.append("dataNovaManutencaoCampo", parseFloat($("#dataNovaManutencaoCampo").val()));
    dados.append("idCampo", $idCampo);

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
        alerta2(obj.title, obj.msg, obj.icon);
        setTimeout(function () { location.reload() }, 3000);
    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    })
}

function alterarFotoCampoClube($id){
    let dados = new FormData();
    dados.append("op", 19);
    dados.append("idCampo", $id);
    
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
        $("#fotoCampoEditCurrent").attr("src", msg);
        $("#modalAlterarFotoCampo").modal("show");
        $('#botaoGuardarFotoCampo').attr('onclick', "guardaFotoCampo("+$id+")");
    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    })
}

function guardaFotoCampo($id){
    let dados = new FormData();
    dados.append("op", 20);
    dados.append("idCampo", $id);
    dados.append("fotoCampoEditNova", $('#fotoCampoEditNova').prop('files')[0]);
    
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
        alerta2(obj.title, obj.msg, obj.icon);
        setTimeout(function () { location.reload() }, 3000);
    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    })

}


$('#fotoCampoEditNova').on('change', function(event) {
    if (event.target.files && event.target.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#fotoCampoEditCurrent').attr('src', e.target.result).width(420).height(220);
        };
        reader.readAsDataURL(event.target.files[0]);
    }
});

function alerta2(titulo,msg,icon){
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


$(function() {
    getCamposManutencao()
    getCamposClube()
    getNomeClube();

    $('body').tooltip({
        selector: '[data-toggle="tooltip"]'
      });
});