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
            $("#corpoModal").html(msg);
            $('#scroll-long-inner-modal').modal('show')
        })
        
        .fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
        });


}

function getSets(nSets){

    let msg ="";
    for(let i = 0; i < nSets; i++){
        msg+= "<h6 class='mt-4 text-center fw-semibold border-top border-2 border-light pt-3 fs-9'>Set &nbsp"+(i+1)+"</h6><div class='d-flex justify-content-between align-items-center' style='margin: 50px;'><div class='d-flex flex-column input-group-lg text-center'><h6 class='fs-5'>A tua equipa</h6><input type='number' class='form-control rounded' id='resultadoEqSet"+(i+1)+"'></input></div><div class='d-flex flex-column input-group-lg text-center'><h6 class='fs-5'>A equipa adversária</h6><input type='number' class='form-control rounded' id='resultadoAdvSet"+(i+1)+"'></input></div></div>";
    }
    $("#campoResultadoSets").html(msg)
}

$(function() {
    getNotificacao()
});