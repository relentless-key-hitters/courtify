function getInfoClubePerfil(){
    let dados = new FormData();
    dados.append("op", 1);

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
        let obj = JSON.parse(msg)
        $("#nomeClube").html("<i class='ti ti-building me-2'></i>" + obj.nome)
        $("#nReservas").html(obj.numMarc)
        $("#nTorneios").html(obj.numTorn)
        $("#nPend").html(obj.naoPago)
        $("#nFeitos").html(obj.pago)
        $("#ganhosMesAtual").html(obj.totalGanhos + "€")
        $("#ganhosMesAnterior").html(obj.pagMesAnterior  + "€")
    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    })

}

function getMelhoresAtletas(){
    let dados = new FormData();
    dados.append("op", 2);

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
        $("#bodyMelhoresAtletas").html(msg)
        $("#tabelaMelhoresAtletas").DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-PT.json',
            }
        });
        console.log(msg)
    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    })

}

function getCampoHoras(){
    let dados = new FormData();
    dados.append("op", 3);

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
        let obj = JSON.parse(msg)
        $("#nomeCampo").html(obj[1])
        $("#horasCampo").html(obj[0])
    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    })

}

function getDadosHoje(){
    let dados = new FormData();
    dados.append("op", 5);

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

        if (obj.HorariosMaisFrequentes[0] && obj.HorariosMaisFrequentes[0][0] && obj.HorariosMaisFrequentes[0][1]) {
          $("#horario1").html(obj.HorariosMaisFrequentes[0][0] + "h - " + obj.HorariosMaisFrequentes[0][1] + "h");
        } else {
          $("#horario1").html("Sem resultados!");
        }


        if (obj.HorariosMaisFrequentes[1] && obj.HorariosMaisFrequentes[1][0] && obj.HorariosMaisFrequentes[1][1]) {
          $("#horario2").html(obj.HorariosMaisFrequentes[1][0] + "h - " + obj.HorariosMaisFrequentes[1][1] + "h");
        } else {
          $("#horario2").html("Sem resultados!");
        }


        if (obj.HorariosMaisFrequentes[2] && obj.HorariosMaisFrequentes[2][0] && obj.HorariosMaisFrequentes[2][1]) {
          $("#horario3").html(obj.HorariosMaisFrequentes[2][0] + "h - " + obj.HorariosMaisFrequentes[2][1] + "h");
        } else {
          $("#horario3").html("Sem resultados!");
        }


        $("#nMarcacoesHoje").html(obj.numMarcacoesHoje);

    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    })

}

function getGraficoMarcacao(){
    let dados = new FormData();
    dados.append("op", 8);

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
        let obj = JSON.parse(msg)
        console.log(obj)
        let meses = ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"];
        var options = {
            color: "#044967",
            series: [{
              name: "histogram",
              data: [
                { x: "Dez", y: obj[4][0] },
                { x: "Nov", y: obj[3][0] },
                { x: "Out", y: obj[2][0] },
                { x: "Set", y: obj[1][0] },
                { x: "Ago", y: obj[0][0] },
              ],
            }],
            chart: {
              height: 300,
              width: '100%',
              type: "bar",
              fontFamily: "Plus Jakarta Sans', sans-serif",
              foreColor: "#adb0bb",
              toolbar: {
                tools: {
                  download: false
                }
              }
            },
            plotOptions: {
              bar: {
                columnWidth: "95%",
                borderRadius: 5,
                borderRadiusApplication: "end",
              }
            },
            fill: {
              colors: '#044967',
              opacity: 0.3,
            },
            stroke: {
              width: 2,
              colors: ['#044967']
            },
            dataLabels: {
              enabled: false,
            },
            grid: {
              xaxis: {
                lines: {
                  show: true
                }
              },
              yaxis: {
                lines: {
                  show: true
                }
              }
            },
            xaxis: {
              type: "category",
              categories: [meses[obj[4][1]-1], meses[obj[3][1]-1], meses[obj[2][1]-1], meses[obj[1][1]-1], meses[obj[0][1]-1]],
              title: {text: "Meses", offsetY: 70},
              axisBorder: {
                color: "#000000"
              }
            },
            yaxis: {
              title: {text: "Nº marcações"},
              axisBorder: {
                show: true,
                color: "#000000"
              }
            },
            tooltip:{
              onDatasetHover: {
                highlightDataSeries: true,
              },
            }
           };
           
           var chart = new ApexCharts(document.querySelector("#grafico1"), options);
           chart.render();
    })
    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    })

}

function getGraficoGanhos(){
    let dados = new FormData();
    dados.append("op", 9);

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
        let obj = JSON.parse(msg)
        let meses = ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"];
        var options = {
            color: "#044967",
            series: [{
              name: "histogram",
              data: [
                { x: "Dez", y: obj[4][0] },
                { x: "Nov", y: obj[3][0] },
                { x: "Out", y: obj[2][0] },
                { x: "Set", y: obj[1][0] },
                { x: "Ago", y: obj[0][0] },
              ],
            }],
            chart: {
              height: 300,
              width: '100%',
              type: "bar",
              fontFamily: "Plus Jakarta Sans', sans-serif",
              foreColor: "#adb0bb",
              toolbar: {
                tools: {
                  download: false
                }
              }
            },
            plotOptions: {
              bar: {
                columnWidth: "95%",
                borderRadius: 5,
                borderRadiusApplication: "end",
              }
            },
            fill: {
              colors: '#044967',
              opacity: 0.3,
            },
            stroke: {
              width: 2,
              colors: ['#044967']
            },
            dataLabels: {
              enabled: false,
            },
            grid: {
              xaxis: {
                lines: {
                  show: true
                }
              },
              yaxis: {
                lines: {
                  show: true
                }
              }
            },
            xaxis: {
              type: "category",
              categories: [meses[obj[4][1]-1], meses[obj[3][1]-1], meses[obj[2][1]-1], meses[obj[1][1]-1], meses[obj[0][1]-1]],
              title: {text: "Meses", offsetY: 70},
              axisBorder: {
                color: "#000000"
              }
            },
            yaxis: {
              title: {text: "€"},
              axisBorder: {
                show: true,
                color: "#000000"
              }
            },
            tooltip:{
              onDatasetHover: {
                highlightDataSeries: true,
              },
            }
           };
           
           var chart = new ApexCharts(document.querySelector("#grafico2"), options);
           chart.render();
    })
    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    })
}


$(function() {
    getInfoClubePerfil()
    getMelhoresAtletas()
    getCampoHoras()
    getDadosHoje()
    getGraficoMarcacao()
    getGraficoGanhos()
});