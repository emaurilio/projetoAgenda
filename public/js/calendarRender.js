document.addEventListener('DOMContentLoaded', function() {

  const user_Id = VARS_AMBIENTE['user_id']
  
  let events = new Request('http://127.0.0.1:8000/api/events/'+user_Id,{
    method:'GET'
  });

  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    themeSystem: 'bootstrap5',
    locale: 'pt-br',
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },
    initialDate: Date.now(),
    navLinks: true, // can click day/week names to navigate views
    selectable: true,
    selectMirror: true,
    select: function(arg) {
      var title = prompt('Event Title:');
      if (title) {
        calendar.addEvent({
          title: title,
          start: arg.start,
          end: arg.end,
          allDay: arg.allDay
        })
      }
      calendar.unselect()
    },
    eventClick: function(arg) {
      if (confirm('Are you sure you want to delete this event?')) {
        arg.event.remove()
      }
    },
    editable: true,
    dayMaxEvents: true, // allow "more" link when too many events
    events: events,
    eventClick: function (info)
    {
      const visualizeModal = new bootstrap.Modal(document.getElementById("visualizeModal"));



      document.getElementById("visualize_id").innerText = info.event.id;
      document.getElementById("visualize_title").innerText = info.event.title;
      document.getElementById("visualize_start").innerText = info.event.start.toLocaleString();
      if(document.getElementById("visualize_end").innerText = info.event.end === null){
        
        document.getElementById("visualize_end").innerText = info.event.start.toLocaleString();

      } else{

        document.getElementById("visualize_start").innerText = info.event.end.toLocaleString();

      }



  

      document.getElementById("editId").value = info.event.id;
      document.getElementById("editTitle").value = info.event.title;
      document.getElementById("editStart").value = converterData(info.event.start);
      document.getElementById("editEnd").value = converterData(info.event.end);
      document.getElementById("editColor").value = info.event.backgroundColor;
      

      visualizeModal.show();
    },
    select: function(info)
    {
      const resgisterModal = new bootstrap.Modal(document.getElementById("registerModal"));

      document.getElementById("start").value = converterData(info.start);
      document.getElementById("end").value = converterData(info.start);

      resgisterModal.show();
    }

  });

  function converterData(data) {

    const dataObj = new Date(data);
    const ano = dataObj.getFullYear();
    const mes = String(dataObj.getMonth() + 1).padStart(2, '0');
    const dia = String(dataObj.getDate()).padStart(2, '0');
    const hora = String(dataObj.getHours()).padStart(2, '0');
    const minuto = String(dataObj.getMinutes()).padStart(2, '0');

    return `${ano}-${mes}-${dia} ${hora}:${minuto}`;

  }


  const btnNewEditEvent = document.getElementById("btnNewEditEvent");

  if(btnNewEditEvent){
    btnNewEditEvent.addEventListener("click", () => {

      document.getElementById("visualizeModalLabel").style.display = "none";
      document.getElementById("visualizeEvent").style.display = "none";

      document.getElementById("visualizeEditEvent").style.display = "block";
      document.getElementById("editModalLabel").style.display = "block";


    });

  }

  const btnCancelEditEvent = document.getElementById("btnCancelEditEvent");

  if(btnCancelEditEvent){
    btnCancelEditEvent.addEventListener("click", () => {

      document.getElementById("visualizeEditEvent").style.display = "none";
      document.getElementById("editModalLabel").style.display = "none";

      document.getElementById("visualizeEvent").style.display = "block";
      document.getElementById("visualizeModalLabel").style.display = "block";

    });

  }

  const btnDeleteEvent = document.getElementById('btnDeleteEvent');

  if(btnDeleteEvent){

    btnDeleteEvent.addEventListener("click", async () => {

      
     const confirmacao = window.confirm("Tem certeza que deseja apagar o evento?");

     if(confirmacao){

      let id = document.getElementById('visualize_id').textContent;

      let events = await fetch('http://127.0.0.1:8000/api/events/delete/'+id+'',{
        method:'DELETE'
        })

        var botoes = document.getElementsByTagName("button");
        for (var i = 0; i < botoes.length; i++) {
            if (botoes[i].className === "btn-close") {
                botoes[i].click();
            }
}

        if(events){

          const msgDelete = document.getElementById("msgDelete");

          msgDelete.innerHTML = `<div class="alert alert-success" style="text-align:center;"> Evento excluído com sucesso </div>`;

        }

        calendar.getEventById(id).remove();

      }

    });
  }

  calendar.render();

});
