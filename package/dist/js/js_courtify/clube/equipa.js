function regEquipa() {

    let dados = new FormData();
    dados.append("op", 1);
    dados.append("nomeEq", $('#nomeNovaEquipa').val());
    dados.append("modEq", $('#modalidadeNovaEquipa').val());
    dados.append("descEq", $('#descricaoNovaEquipa').val());
    dados.append("imagemEq", $('#fotoNovaEquipa').prop('files')[0]);


    $.ajax({
        url: "../../dist/php/clube/controllerEquipa.php",
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
            setTimeout(function () { location.reload(); }, 3000);
            
        })

        .fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
}


function getListaEquipa() {

    let dados = new FormData();
    dados.append("op", 2);


    $.ajax({
        url: "../../dist/php/clube/controllerEquipa.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })

        .done(function (msg) {
            $('#listaEquipa').html(msg);
            $('#tabelaEquipa').DataTable(
                {
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-PT.json',
                    }
                }
            );

        })

        .fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
}


function getDadosEquipa(id) {

    let dados = new FormData();
    dados.append("op", 3);
    dados.append("id", id);

    $.ajax({
        url: "../../dist/php/clube/controllerEquipa.php",
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
            $("#imgEquipa").attr("src", "../../dist/" + obj.row.foto);
            $('#nomeEquipaEdit').val(obj.row.nome);
            $("#modalidadeEquipaEdit").html(obj.msg);
            $('#descricaoEquipaEdit').val(obj.row.descricao);
            $('#btnGuardar').attr("onclick", "guardaEditEquipa(" + id + ")")
            $('#teamEditModal').modal('show')
        })

        .fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });


}

function guardaEditEquipa(id) {

    let dados = new FormData();
    dados.append("op", 4);
    dados.append("idEq", id);
    dados.append("nomeEq", $("#nomeEquipaEdit").val());
    dados.append("modEq", $("#modalidadeEquipaEdit").val());
    dados.append("descEq", $("#descricaoEquipaEdit").val());
    var ficheiro = $('#fotoEquipaEdit').prop('files');
    if (ficheiro.length > 0) {
        dados.append("imagemEq", files[0]);
    }


    $.ajax({
        url: "../../dist/php/clube/controllerEquipa.php",
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
            setTimeout(function () { location.reload(); }, 3000);
        })

        .fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });


}

function removerEquipa(id) {

    let dados = new FormData();
    dados.append("op", 5);
    dados.append("id", id);

    $.ajax({
        url: "../../dist/php/clube/controllerEquipa.php",
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
            setTimeout(function () { location.reload(); }, 3000);

        })

        .fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });


};


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

function previewImagemNovaEquipa() {
    
    let input = document.getElementById("fotoNovaEquipa");
    let image = document.getElementById("imgNovaEquipa");
  
    let file = input.files[0];
  
    if (file) {
      let reader = new FileReader();
  
      reader.onload = function (e) {
        image.src = e.target.result;
        $("#imgNovaEquipa").removeClass("d-none");
      };
  
      reader.readAsDataURL(file);
    }
}

function previewImagemEquipa() {
    
    let input = document.getElementById("fotoEquipaEdit");
    let image = document.getElementById("imgEquipa");
  
    let file = input.files[0];
  
    if (file) {
      let reader = new FileReader();
  
      reader.onload = function (e) {
        image.src = e.target.result;
        
      };
  
      reader.readAsDataURL(file);
    }
}

function limparInput() {
    $("#fotoEquipaEdit").val("");
    $("#fotoNovaEquipa").val("");
    $("#imgNovaEquipa").attr("src", "");
}

function alerta2(titulo, msg, icon) {
    Swal.fire({
        position: 'center',
        icon: icon,
        title: titulo,
        text: msg,
        showConfirmButton: false,
        timer: 3000
    })
}


$(function () {
    getListaEquipa();
    getNomeClube();

});




