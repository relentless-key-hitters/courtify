arrayCalendario = [];

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      locale: 'pt', 
      headerToolbar: {
        left: '', 
        center: 'title',
        right: 'today prev,next'
      },
      buttonText: {
        today: 'Este Mês'
      }
    });

    
    getMarcacoesNaoConcluidas();

    function getMarcacoesNaoConcluidas() {
      let dados = new FormData();
      dados.append("op", 16);

      $.ajax({
        url: "../../dist/php/controllerUser.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false,
      })
        .done(function (msg) {
          let obj = JSON.parse(msg);
          $("#proximosJogosCalendario").html(obj.msg);
          arrayCalendario = obj.arrayCalendario;
          console.log(arrayCalendario);

          
          populateCalendar();
        })
        .fail(function (jqXHR, textStatus) {
          alert("Request failed: " + textStatus);
        });
    }

    function populateCalendar() {
        for (let i = 0; i < arrayCalendario.length; i++) {
            let hourStart = arrayCalendario[i][0];
            let hourEnd = arrayCalendario[i][1]; 
            let date = arrayCalendario[i][2];
            let nomeClube = arrayCalendario[i][3];
    

            let fullHourStart = hourStart.padStart(8, '0');
            let fullHourEnd = hourEnd.padStart(8, '0');
    
            let event = {
                title: nomeClube,
                start: date + 'T' + fullHourStart,
                end: date + 'T' + fullHourEnd,
                color: 'text-primary' 
            };
    

            calendar.addEvent(event);
        }

        calendar.render();
    }
});


  

$(function () {

});
