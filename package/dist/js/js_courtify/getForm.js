function getForm(id){
    if(id == 2){
        if($("#modalidade2").is(":checked")){
            $("#formPadel").hide()
            $("#formFutsal").show()
    
        }else{
            $("#formFutsal").hide()
        }
    }else if(id == 3){
        if($("#modalidade3").is(":checked")){
            $("#formFutsal").hide()
            $("#formPadel").show()
    
        }else{
            $("#formPadel").hide()
        }
    }

}


function getFormEmpty(){
    $("#formFutsal").hide()
    $("#formPadel").hide()
}

$( document ).ready(function() {
    getFormEmpty()
});