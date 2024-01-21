function getMembros(){

    let dados = new FormData();
    dados.append("op", 21);
    
    $.ajax({
        url: "../../dist/php/controllerClube.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
        })
        
        .done(function(msg) {
            if($.fn.DataTable.isDataTable('#tabelaMembros')){
                $('#tabelaMembros').DataTable().destroy()
            }
            $("#tableMembros").html(msg)
            $('#tabelaMembros').DataTable( {
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-PT.json',
                }
            });
        })
        
        .fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
        });

}

function removerMembroEquipa(idMembro, idEquipa, nomeEquipa){
    $("#corpoModalRemoverMembro").html("Tem a certeza que pretende remover este membro da equipa <span class='fw-bolder'>"+nomeEquipa+"</span>?")
    $("#botaoGuardar").attr("onclick", "guardaRemoverMembro("+idMembro+", "+idEquipa+")");
    $("#modalRemoverMembro").modal("show");
}

function guardaRemoverMembro(idMembro, idEquipa){
    let dados = new FormData();
    dados.append("op", 22);
    dados.append("idMembro", idMembro)
    dados.append("idEquipa", idEquipa)
    
    $.ajax({
        url: "../../dist/php/controllerClube.php",
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
            setTimeout(function () { location.reload() }, 3000);
        })
        
        .fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
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

function getMembrosAdicionar() {
    let dados = new FormData();
    dados.append("op", 27);

    $("#search").val("");

    $.ajax({
        url: "../../dist/php/controllerClube.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
        })

    .done(function(msg) {
        $("#pesquisaAtletasNavbar").html(msg);

    })

    .fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
    });
}

function getEquipasSelectAdicionarMembro(idUser) {
    return new Promise((resolver, rejeitar) => {
        let dados = new FormData();
        dados.append("op", 28);
        dados.append("idUser", idUser);

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
            resolver(msg);
        })
        .fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
            rejeitar(textStatus);
        });
    });
}

function adicionarMembroEquipa(idUser) {

    getEquipasSelectAdicionarMembro(idUser).then(msg => {
        
        let obj = JSON.parse(msg);
        console.log(obj);
        
        if(obj.flag == true){
            $("#corpoAdicionarMembroModal").html("<div class='mb-3'>Por favor seleccione a Equipa que pretende associar este Membro:</div><select class='form-select mb-3' id='selectAdicionarMembros'>" + obj.msg + "</select><div class='mt-2 text-center'><button type='button' class='btn btn-primary' id='botaoAdicionarMembroEquipa' onclick='guardaAdicionarMembros("+idUser+")')'>Adicionar</button></div>");
            $("#exampleModal").modal("hide");
            $("#modalAdicionarMembroEquipa").modal("show");
        } else {
            $("#corpoAdicionarMembroModal").html("<div class='text-center'><p>"+obj.msg+"</p></div>");
            $("#guardaAdicionarMembros").addClass("d-none");
            $("#exampleModal").modal("hide");
            $("#modalAdicionarMembroEquipa").modal("show");
        }
    }).catch(error => {
        console.error("Erro:", error);
    });
}


function guardaAdicionarMembros(idUser) {

    let dados = new FormData();
    dados.append("op", 29);
    dados.append("idUser", idUser);
    dados.append("idEquipa", $("#selectAdicionarMembros").val());

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
        let obj = JSON.parse(msg);
        alerta2(obj.title, obj.msg, obj.icon);
        setTimeout(function () { location.reload() }, 3000);
    })
    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });

}

$(function () {
    getMembros();
    getNomeClube();

    $('#search').on('keyup', function() {
        var termoPesquisa = $(this).val().toLowerCase();
        var cont = 0;

        $('#pesquisaAtletasNavbar li').each(function() {
            var textoItem = $(this).text().toLowerCase();
            if (textoItem.includes(termoPesquisa)) {
                $(this).show();
                cont++;
            } else {
                $(this).hide();
            }
        });

        
        if (cont === 0) {
            $("#pesquisaAtletasNavbar").html("<div id='noResultsPesquisa' class='text-center mt-5'>" +
                "<h4>Sem resultados!</h4>" +
                "<p>Oops! A tua pesquisa não obteve resultados. Tenta novamente.</p>" +
                "<button type='button' class='btn btn-primary btn-sm' onclick='getMembrosAdicionar()'>Redefinir</button>" +
                "</div>");
        } else {
            
            $("#noResultsPesquisa").remove();
        }

        if (termoPesquisa === '') {
            
            getMembrosAdicionar();
        }
    });
});