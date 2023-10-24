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
                alerta2("Utilizador", resp.msg, resp.icon)
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
            alerta2(obj.title, obj.msg, obj.icon); 
            if(obj.flag){
                if(obj.flagFirstLogin){
                    setTimeout(function(){ 
                        window.location.href = "../../html/main/continuacao-registo.html";
                    }, 2000);
                }else{
                    setTimeout(function(){ 
                        window.location.href = "../../html/horizontal/index_editavel.html";
                    }, 2000);
                }

            }
        })
        
        .fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
        });

}

function getModalidades(){
    let dados = new FormData();
    dados.append("op", 5);
    
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
            $("#modalidades").html(msg);
        })
        
        .fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
        });

}

function getFutsalInfo(){
    let dados = new FormData();
    dados.append("op", 6);
    
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
            $("#posFutsal").html(msg);
        })
        
        .fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
        });

}

function getNivelPadel(){
    let dados = new FormData();
    dados.append("op", 7);
    
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
            $("#nivelPadel").html(msg);
        })
        
        .fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
        });

}

function contRegisto(){
    
    feedback2();

    if(verifEmpty($("#dataNascimento")) && verifGenero() && verifMembrosInf() && verifMembrosSup()) {
        let dados = new FormData();
        dados.append("op", 8);
        dados.append("dataNascimento", $("#dataNascimento").val());
        if($("#feminino").is(":checked")){
            dados.append("genero", $("#feminino").val());
        }else{
            dados.append("genero", $("#masculino").val());
        } 
        dados.append("altura", $("#altura").val());
        dados.append("peso", $("#peso").val());
        if($("#ms1").is(":checked")){
            dados.append("ms", $("#ms1").val());
        }else{
            dados.append("ms", $("#ms2").val());
        }
        if($("#mi1").is(":checked")){
            dados.append("mi", $("#mi1").val());
        }else{
            dados.append("mi", $("#mi2").val());
        }
    
        dados.append("fotoPerfil", $('#fotoPerfil').prop('files')[0]);
        
        
        dados.append("bio", $("#bio").val());
        let arr = [];
        for (let i = 1; i < 5; i++){
            if($("#modalidade"+i).is(":checked")){
                arr.push(
                    $("#modalidade"+i).val());
            }
        }
        let arrMod = JSON.stringify(arr);
        dados.append("modalidades", arrMod);
        dados.append("posFutsal", $("#posFutsal").val());
        dados.append("nivelPadel", $("#nivelPadel").val());
        dados.append("ladoPadel", $("#ladoPadel").val());
    
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
                alerta2("Utilizador", msg, "success");
                
                setTimeout(function(){ 
                    window.location.href = "../../html/horizontal/index_editavel.html";;
                }, 2000);
            })
            
            .fail(function( jqXHR, textStatus ) {
            alert( "Request failed: " + textStatus );
            });

    } else {
        if(!verifEmpty($("#dataNascimento"))) {
            $("#feedbackDataNasc").show();
            
        }
        if (!verifGenero()) {
            $("#feedbackGenero").show();
            
        }
        if (!verifMembrosInf()) {
            $("#feedbackMI").show();
            
        }    
        if (!verifMembrosSup()) {
            $("#feedbackMS").show();
            
        }

        alerta("Utilizador","Há informação obrigatória não preenchida. Por favor, verifique.","warning");
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

function alerta2(titulo,msg,icon){
    Swal.fire({
        position: 'center',
        icon: icon,
        title: titulo,
        text: msg,
        showConfirmButton: false,
        confirmButtonColor: '#45702d',
      })
}

function verifGenero() {
    let flag = false;
    if($("#feminino").is(":checked")) {
        flag = true;
    } else if ($("#masculino").is(":checked")) {
        flag =  true;
    }

    return flag;
}

function verifMembrosSup() {
    let flag = false;
    if($("#ms1").is(":checked")) {
        flag = true;
    } else if ($("#ms2").is(":checked")) {
        flag =  true;
    }

    return flag;
}

function verifMembrosInf() {
    let flag = false;
    if($("#mi1").is(":checked")) {
        flag = true;
    } else if ($("#mi2").is(":checked")) {
        flag =  true;
    }

    return flag;
}

function feedback2() {
    $("#feedbackDatasNasc").hide();
    $("#feedbackGenero").hide();
    $("#feedbackMS").hide();
    $("#feedbackMI").hide();
}

function logout(){

    let dados = new FormData();
    dados.append("op", 9);

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
            alerta2("Utilizador", msg, "success");
            setTimeout(function(){ 
                window.location.href = "../../../landingpage/index.html";;
            }, 2000);
        })
        
        .fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
        });
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
    getModalidades();
    getFutsalInfo();
    getNivelPadel();
    feedback2();
});