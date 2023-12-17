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

          
          popularCalendario();
        })
        .fail(function (jqXHR, textStatus) {
          alert("Request failed: " + textStatus);
        });
    }

    function popularCalendario() {
        for (let i = 0; i < arrayCalendario.length; i++) {
            let inicioHora = arrayCalendario[i][0];
            let fimHora = arrayCalendario[i][1]; 
            let data = arrayCalendario[i][2];
            let nomeClube = arrayCalendario[i][3];
    

            let fullHoraInicio = inicioHora.padStart(8, '0');
            let fullHoraFim = fimHora.padStart(8, '0');
    
            let event = {
                title: nomeClube,
                start: data + 'T' + fullHoraInicio,
                end: data + 'T' + fullHoraFim,
                color: 'text-primary' 
            };
    

            calendar.addEvent(event);
        }

        calendar.render();
    }
});


  

$(function () {

});
