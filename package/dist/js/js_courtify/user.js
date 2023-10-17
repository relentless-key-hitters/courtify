function registaUser(){

    var password = $("#passUser").val();
    var hashedPassword = CryptoJS.MD5(password).toString();

    limparCampos();

    if(verifPP($("#passUser").val(),$("#passCUser").val()) && verifNIF($("#nifUser").val()) && verifEmail($("#emailUser").val()) && verifCodPostal($("#codPUser").val()) && verifEmpty($("#nomeUser").val()) && verifEmpty($("#nifUser").val()) && verifEmpty($("#emailUser").val()) && verifEmpty($("#passUser").val())){
        
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
        dados.append("local", $("#concelhoUser").val());
        dados.append("email", $("#emailUser").val());
        dados.append("pass", hashedPassword);
        
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
                alerta("Utilizador", resp.msg, resp.icon)
                if( resp.icon == "success"){
                    setTimeout(function(){ 
                        window.location.href = "../../html/main/authentication-login2.html";
                    }, 2000);
                }
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
        }if(!verifNIF($("#nifUser").val())){
            $("#nifUser").addClass("is-invalid");
            $("#feedbackNif").show();
        }
    } 

}

function getDistritos(){

    let dados = new FormData();
    dados.append("op", 2);
    
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
            $("#distritoUser").html(msg)
        })
        
        .fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
        });

}

function getConcelhos(dis){

    let dados = new FormData();
    dados.append("op", 3);
    dados.append("distrito", dis)
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
            $("#concelhoUser").html(msg)
        })
        
        .fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
        });
}

function login(){

    let dados = new FormData();
    dados.append("op", 4);
    dados.append("email", $("#emailLogin").val());
    dados.append("pass", $("#passLogin").val());
    
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
            alerta(obj.title, obj.msg, obj.icon); 
            if(obj.flag){
                setTimeout(function(){ 
                    window.location.href = "../../html/horizontal/index.html";
                }, 2000);
            }
        })
        
        .fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
        });

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

function verifNIF(nif){
    let flag = true;
    if(nif.length != 9){
        flag = false;
    }
    return (flag);
}

function alerta(titulo,msg,icon){
    Swal.fire({
        position: 'center',
        icon: icon,
        title: titulo,
        text: msg,
        showConfirmButton: true,
        confirmButtonColor: '#45702d',
      })
}


$(function() {
    getDistritos()
    $("#feedbackNome").hide();
    $("#feedbackTel").hide();
    $("#feedbackNif").hide();
    $("#feedbackCP").hide();
    $("#feedbackEmail").hide();
    $("#feedbackPPEmpty").hide();
    $("#feedbackPPDif").hide();
});