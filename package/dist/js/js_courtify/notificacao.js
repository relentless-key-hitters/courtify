let idVot;
let modalidade;
function getNotificacao(){

    let dados = new FormData();
    dados.append("op", 14);

    $.ajax({
        url: "../../dist/php/controllerUser.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
        })

        .done(function(msg) {
            $("#notifVotacao").html(msg)
        })
        
        .fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
        });

}

function getModalVot(id){
    let dados = new FormData();
    dados.append("op", 15);
    dados.append("id", id);
    idVot = id;
    $.ajax({
        url: "../../dist/php/controllerUser.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
        })

        .done(function(msg) {
            let obj = JSON.parse(msg);
            $("#corpoModal").html(obj.msg);
            $('#scroll-long-inner-modal').modal('show')
            if(obj.modalidade == 'Basquetebol' || obj.modalidade == 'Futsal'){
                $("#guardarVotacao").attr("onclick", "guardarVotacaoBF("+id+")");
            }
            modalidade =  obj.modalidade;
        })
        
        .fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
        });

}

function getSets(nSets){
    numSets = nSets;
    let msg ="";
    for(let i = 0; i < nSets; i++){
        msg+= "<h6 class='mt-4 text-center fw-semibold border-top border-2 border-light pt-3 fs-9'>Set &nbsp"+(i+1)+"</h6><div class='d-flex justify-content-between align-items-center' style='margin: 50px;'><div class='d-flex flex-column input-group-lg text-center'><h6 class='fs-5'>A tua equipa</h6><input type='number' class='form-control rounded' id='resultadoEqSet"+(i+1)+"'></input></div><div class='d-flex flex-column input-group-lg text-center'><h6 class='fs-5'>A equipa adversária</h6><input type='number' class='form-control rounded' id='resultadoAdvSet"+(i+1)+"'></input></div></div>";
    }
    $("#guardarVotacao").attr("onclick", "guardarVotacaoPT("+idVot+", "+nSets+")");   
    $("#campoResultadoSets").html(msg)

}

function guardarVotacaoBF(id){
    let dados = new FormData();
    dados.append("op", 17);
    dados.append("id", id);
    dados.append("modalidade", modalidade);
    dados.append("resEquipa", $("#resultadoEquipa").val());
    dados.append("resAdver", $("#resultadoAdvers").val());
    dados.append("numPontos", $("#numPontos").val());
    $.ajax({
        url: "../../dist/php/controllerUser.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
        })

        .done(function(msg) {
            alerta2("Votação",msg,"success");
            getNotificacao();
        })
        
        .fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
        });
}

function guardarVotacaoPT(id, nSets){
    let dados = new FormData();
    let arrRes = [];
    dados.append('op', 18);
    dados.append('id', id);
    dados.append("modalidade", modalidade);
    for(let i = 0; i < nSets; i++){
        arrRes.push([ $("#resultadoEqSet"+(i+1)).val(), $("resultadoAdvSet"+(i+1)).val()]);
    }
    dados.append('resultados', JSON.stringify(arrRes));  
    $.ajax({
        url: "../../dist/php/controllerUser.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
        })

        .done(function(msg) {
            alerta2("Votação",msg,"success");
            getNotificacao();
        })
        
        .fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
        });
}

function getNotificacaoConviteMarcacao() {

    let dados = new FormData();
    dados.append("op", 21);

    $.ajax({
        url: "../../dist/php/controllerUser.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
        })

        .done(function(msg) {
            $("#notifVotacao").html(msg)
        })
        
        .fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
        });
}

function getModalConviteMarcacao(id){
    let dados = new FormData();
    dados.append("op", 22);
    dados.append("id", id);
    idVot = id;
    $.ajax({
        url: "../../dist/php/controllerUser.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
        })

        .done(function(msg) {
            let obj = JSON.parse(msg);
            $("#corpoModal1").html(obj.msg);
            $('#scroll-long-inner-modal1').modal('show')
            $("#aceitar").attr("onclick", "aceitarConvite("+id+")");
            $("#rejeitar").attr("onclick", "rejeitarConvite("+id+")");
            modalidade =  obj.modalidade;
        })
        
        .fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
        });

}

function aceitarConvite(idMarcacao){
    let dados = new FormData();
    dados.append("op", 23);
    dados.append("idMarcacao", idMarcacao);

    $.ajax({
        url: "../../dist/php/controllerUser.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
        })

        .done(function(msg) {
            let obj = JSON.parse(msg);
            alerta2(obj.titulo, obj.msg, obj.icon);
            setTimeout(function(){ 
                location.reload();
            }, 3000);
        })
        
        .fail(function( jqXHR, textStatus ) {
            alert( "Request failed: " + textStatus );
        });
}

function rejeitarConvite(idMarcacao){

    let dados = new FormData();
    dados.append("op", 24);
    dados.append("idMarcacao", idMarcacao);

    $.ajax({
        url: "../../dist/php/controllerUser.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
        })

        .done(function(msg) {
            let obj = JSON.parse(msg);
            alerta2(obj.titulo, obj.msg, obj.icon);
            setTimeout(function(){ 
                location.reload();
            }, 3000);
        })
        
        .fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
        });
}

function notificacaoPedidoAmizade() {
    let dados = new FormData();
    dados.append("op", 26);

    $.ajax({
        url: "../../dist/php/controllerUser.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
        })

        .done(function(msg) {
            $("#notifVotacao").html(msg)
        })
        
        .fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
        });
    
}

function aceitarPedido(id){
    let dados = new FormData();
    dados.append("op", 27);
    dados.append("id", id);

    $.ajax({
        url: "../../dist/php/controllerUser.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
        })

        .done(function(msg) {
            let obj = JSON.parse(msg);
            alerta2(obj.titulo, obj.msg, obj.icon);
            setTimeout(function(){ 
                location.reload();
            }, 3000);
        })
        
        .fail(function( jqXHR, textStatus ) {
            alert( "Request failed: " + textStatus );
        });
}

function rejeitarPedido(id){
    let dados = new FormData();
    dados.append("op", 28);
    dados.append("id", id);

    $.ajax({
        url: "../../dist/php/controllerUser.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
        })

        .done(function(msg) {
            let obj = JSON.parse(msg);
            alerta2(obj.titulo, obj.msg, obj.icon);
            setTimeout(function(){ 
                location.reload();
            }, 3000);
        })
        
        .fail(function( jqXHR, textStatus ) {
            alert( "Request failed: " + textStatus );
        });
}

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
    getNotificacao()
    getNotificacaoConviteMarcacao()
    notificacaoPedidoAmizade();
});