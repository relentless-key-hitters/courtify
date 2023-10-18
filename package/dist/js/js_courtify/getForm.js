function getFormFutsal(){
    if($("#success2-check").is(":checked")){
        $("#formPadel").hide()
        $("#formFutsal").show()

    }else{
        $("#formFutsal").hide()
    }
}

function getFormPadel(){

    if($("#success3-check").is(":checked")){
        $("#formFutsal").hide()
        $("#formPadel").show()

    }else{
        $("#formPadel").hide()
    }
}

function getFormEmpty(){
    $("#formFutsal").hide()
    $("#formPadel").hide()
}

$( document ).ready(function() {
    getFormEmpty()
});