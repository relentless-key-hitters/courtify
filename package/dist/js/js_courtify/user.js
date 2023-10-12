function registaUser(){
    limparCampos();

    if(verifPP($("#passUser").val(),$("#passCUser").val()) && verifEmail($("#emailUser").val()) && verifCodPostal($("#codPUser").val()) && verifEmpty($("#nomeUser").val()) && verifEmpty($("#nifUser").val()) && verifEmpty($("#emailUser").val()) && verifEmpty($("#passUser").val())){
        
        let dados = new FormData();
        dados.append("op", 1);
        dados.append("nome", $("#nomeUser").val());
        if($("#tipoUser1").is(":checked")){
            dados.append("tipo", $("#tipoUser1").val());
        }else{
            dados.append("tipo", $("#tipoUser2").val());
        }
        dados.append("telemovel", $("#telUser").val());
        dados.append("nif", $("#nifUser").val());
        dados.append("morada", $("#moradaUser").val());
        dados.append("codP", $("#codPUser").val());
        dados.append("local", $("#localUser").val());
        dados.append("email", $("#emailUser").val());
        dados.append("pass", $("#passUser").val());
        
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
                let resp = JSON.parse(msg);
                alerta("Utilizador", "Registo efetuado com sucesso!")
                setTimeout(function(){ 
                    window.location.href = "../../html/horizontal/index.html";
                }, 2000);
            })
            
            .fail(function( jqXHR, textStatus ) {
            alert( "Request failed: " + textStatus );
            });


    }else{
        if(!verifEmpty($("#nomeUser").val())){
            $("#nomeUser").addClass("is-invalid");
            $("#feedbackNome").show();
        }
        if(!verifEmpty($("#nifUser").val())){
            $("#nifUser").addClass("is-invalid");
            $("#feedbackNif").show();
        }
        if(!verifEmpty($("#emailUser").val())){
            $("#emailUser").addClass("is-invalid");
            $("#feedbackEmail").show();
        }
        if(!verifEmpty($("#passUser").val())){
            $("#passUser").addClass("is-invalid");
            $("#feedbackPPEmpty").show();
        }
        if(!verifPP($("#passUser").val(),$("#passCUser").val())){
            $("#passCUser").addClass("is-invalid");
            $("#feedbackPPDif").show();
        }
        if(!verifEmail($("#emailUser").val())){
            $("#emailUser").addClass("is-invalid");
            $("#feedbackEmail").show();

        }if(!verifCodPostal($("#codPUser").val())){
            $("#codPUser").addClass("is-invalid");
            $("#feedbackCP").show();
        }
    } 

}

function limparCampos(){

    $("#nomeUser").removeClass("is-invalid");
    $("#nifUser").removeClass("is-invalid");
    $("#emailUser").removeClass("is-invalid");
    $("#passUser").removeClass("is-invalid");
    $("#passCUser").removeClass("is-invalid");
    $("#codPUser").removeClass("is-invalid");
    $("#feedbackNome").hide();
    $("#feedbackTel").hide();
    $("#feedbackNif").hide();
    $("#feedbackCP").hide();
    $("#feedbackEmail").hide();
    $("#feedbackPPEmpty").hide();
    $("#feedbackPPDif").hide();

}


function verifPP(pp, ppc){
    let flag = true;
    if (pp != ppc){
        flag = false;
    }
    return (flag)
}

function verifEmpty(info){

    let flag = true;
    if(info.length == 0){
        flag = false;
    }
    return (flag);
}

function verifEmail(email){
    let flag = true;
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    if (email.match(mailformat)){
    }else{
        flag = false;
    }
   return (flag);   
}

function verifCodPostal(cod){

    let flag = true;
    if(cod != ""){
        var cp = /^\d{4}-\d{3}?$/;
        if(cod.match(cp)){
        }else{
            flag = false;
        }
    }

    return (flag);
}

function alerta(titulo,msg){
    Swal.fire({
        position: 'center',
        icon: "success",
        title: titulo,
        text: msg,
        showConfirmButton: true,
        confirmButtonColor: '#45702d',
      })
}


$(function() {
    $("#feedbackNome").hide();
    $("#feedbackTel").hide();
    $("#feedbackNif").hide();
    $("#feedbackCP").hide();
    $("#feedbackEmail").hide();
    $("#feedbackPPEmpty").hide();
    $("#feedbackPPDif").hide();
});