function regTorneio() {

    let dados = new FormData();
    dados.append("op", 1);
    dados.append("trDesc", $('#trDesc').val());
    dados.append("trData", $('#trData').val());
    dados.append("trHora", $('#trHora').val());
    dados.append("trNmr", $('#trNmr').val());
    dados.append("trPreco", $('#trPreco').val());
    dados.append("trNivel", $('#trNivel').val());
    dados.append("trEstado", $('#trEstado').val());
    dados.append("trImagem", $('#trImagem').prop('files')[0]);


    $.ajax({
        url: "../../dist/php/controllerTorneio.php",
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
            } else {
                alerta("Torneio", obj.msg, "error");
            }

        })

        .fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
}


function alerta(titulo, msg, icon){
    Swal.fire({
        position: 'center',
        icon: icon,
        title: titulo,
        text: msg,
        showConfirmButton: true,

      })
}


$(function() {

});

