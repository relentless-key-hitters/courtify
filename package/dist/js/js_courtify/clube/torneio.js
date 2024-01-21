function regTorneio() {
    let dados = new FormData();
    dados.append("op", 1);
    dados.append("trDesc", $('#trDesc').val());
    dados.append("trData", $('#trData').val());
    dados.append("trHora", $('#trHora').val());
    dados.append("trNmr", $('#trNmr').val());
    dados.append("trPreco", $('#trPreco').val());
    dados.append("trNivel", $('#trNivel').val());
    dados.append("trGen", $('#trGen').val());
    dados.append("trImagem", $('#trImagem').prop('files')[0]);
    dados.append("trObs", $('#trObs').val());
    dados.append("trModalidade", $('#trModalidade').val());


    $.ajax({
        url: "../../dist/php/clube/controllerTorneio.php",
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
        setTimeout(function () { location.reload() }, 3000);
    })
    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });
}

function limparInput() {

    $('#trDesc').val('');
    $('#trData').val('');
    $('#trHora').val('');
    $('#trNmr').val('');
    $('#trPreco').val('');
    $('#trNivel').val('');
    $('#trGen').val('');
    $('#trObs').val('');
    $('#trImagem').val('');
    $('#trImgElem').removeAttr("src");
    $('#trImgElem').addClass("d-none");
}

function previewImagemNovoTorneio() {
    
    let input = document.getElementById("trImagem");
    let image = document.getElementById("trImgElem");
  
    let file = input.files[0];
  
    if (file) {
      let reader = new FileReader();
  
      reader.onload = function (e) {
        image.src = e.target.result;
        $("#trImgElem").removeClass("d-none");
      };
  
      reader.readAsDataURL(file);
    }
}

function previewImagemNovoTorneioEdit() {
    
    let input = document.getElementById("trImagemEdit");
    let image = document.getElementById("trImgElemEdit");
  
    let file = input.files[0];
  
    if (file) {
      let reader = new FileReader();
  
      reader.onload = function (e) {
        image.src = e.target.result;
        $("#trImgElem").removeClass("d-none");
      };
  
      reader.readAsDataURL(file);
    }
}

function getListaTorneio() {

    let dados = new FormData();
    dados.append("op", 2);


    $.ajax({
        url: "../../dist/php/clube/controllerTorneio.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })

    .done(function (msg) {

        $('#listaTorneio').html(msg);
        $("#tabelaTorneio").DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-PT.json",
            }
        })

    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });
}

function getModalidadesNovoTorneio() {

    let dados = new FormData();
    dados.append("op", 6);

    $.ajax({
        url: "../../dist/php/clube/controllerTorneio.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function (msg) {
        $("#trModalidade").html(msg);
    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });

}

function getDadosTorneio(id) {


    let dados = new FormData();
    dados.append("op", 3);
    dados.append("id", id);

    $.ajax({
        url: "../../dist/php/clube/controllerTorneio.php",
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

            $('#trDescEdit').val(obj.descricao);
            $('#trDataEdit').val(obj.data);
            $('#trHoraEdit').val(obj.hora);
            $('#trNmrEdit').val(obj.num_entradas);
            $('#trPrecoEdit').val(obj.preco);
            $('#trNivelEdit').val(obj.nivel);
            $('#trGenEdit').val(obj.genero);
            $('#trImgElemEdit').attr("src", obj.foto);
            $('#trObsEdit').val(obj.obs);
            $("#trModalidadeEdit").val(obj.idModalidade);
            $('#botaoGuardarEditTorneio').attr("onclick", "guardaEditTorneio(" + id + ")")

            $('#trEditModal').modal('show')
        })

        .fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });


}

function guardaEditTorneio(id) {

    let dados = new FormData();
    dados.append("op", 4);
    dados.append("trId", id);
    dados.append("trDescEdit", $('#trDescEdit').val());
    dados.append("trDataEdit", $('#trDataEdit').val());
    dados.append("trHoraEdit", $('#trHoraEdit').val());
    dados.append("trNmrEdit", $('#trNmrEdit').val());
    dados.append("trPrecoEdit", $('#trPrecoEdit').val());
    dados.append("trGenEdit", $('#trGenEdit').val());
    dados.append("trNivelEdit", $('#trNivelEdit').val());
    var fileInput = $('#trImagemEdit');
    if (fileInput.prop('files').length > 0) {
        dados.append("trImagemEdit", fileInput.prop('files')[0]);
    } else {
        var imageSrc = $('#trImgElemEdit').attr('src');
        dados.append("imageSrc", imageSrc);
    }
    dados.append("trObsEdit", $('#trObsEdit').val());
    dados.append("trModalidadeEdit", $('#trModalidadeEdit').val());

    $.ajax({
        url: "../../dist/php/clube/controllerTorneio.php",
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
            setTimeout(function () {
                location.reload();
            }, 3000);

        })

        .fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });


}

function removeTorneio(id) {

    let dados = new FormData();
    dados.append("op", 5);
    dados.append("id", id);

    $.ajax({
        url: "../../dist/php/clube/controllerTorneio.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })

        .done(function (msg) {

            let obj = JSON.parse(msg);
            if (obj.flag) {
                alerta("Torneio", obj.msg, "success");
                getListaTorneio();
            } else {
                alerta("Torneio", obj.msg, "error");
            }

        })

        .fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });

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



function alerta(titulo, msg, icon) {
    Swal.fire({
        position: 'center',
        icon: icon,
        title: titulo,
        text: msg,
        showConfirmButton: false,
        time: 3000
    })
}




$(function () {
    getListaTorneio();
    getNomeClube();
    getModalidadesNovoTorneio();
});

