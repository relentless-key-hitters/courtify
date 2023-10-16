function toggleDropdown() {
    const dropdownContent = document.getElementById('dropdownContent');
    const icon = document.getElementById('icon');
    
    dropdownContent.classList.toggle('hidden');
    
    if (dropdownContent.classList.contains('hidden')) {
      icon.classList.remove('ti-arrow-badge-down');
      icon.classList.add('ti-arrow-badge-right');
    } else {
      icon.classList.remove('ti-arrow-badge-right');
      icon.classList.add('ti-arrow-badge-down');
    }
  }

  function toggleDropdown1() {
    const dropdownContent = document.getElementById('dropdownContent1');
    const icon = document.getElementById('icon1');
    
    dropdownContent.classList.toggle('hidden');
    
    if (dropdownContent.classList.contains('hidden')) {
      icon.classList.remove('ti-arrow-badge-down');
      icon.classList.add('ti-arrow-badge-right');
    } else {
      icon.classList.remove('ti-arrow-badge-right');
      icon.classList.add('ti-arrow-badge-down');
    }
  }

  function toggleDropdown2() {
    const dropdownContent = document.getElementById('dropdownContent2');
    const icon = document.getElementById('icon2');
    
    dropdownContent.classList.toggle('hidden');
    
    if (dropdownContent.classList.contains('hidden')) {
      icon.classList.remove('ti-arrow-badge-down');
      icon.classList.add('ti-arrow-badge-right');
    } else {
      icon.classList.remove('ti-arrow-badge-right');
      icon.classList.add('ti-arrow-badge-down');
    }
  }


  const btn = document.getElementById('button');

  document.getElementById('form')
  .addEventListener('submit', function(event) {
  emailjs.init('_u9LnJaExhu1GniTn')
  event.preventDefault();

  btn.value = 'A Enviar...';

  const serviceID = 'service_x4z2fgj';
  const templateID = 'template_ixpr0wr';

  emailjs.sendForm(serviceID, templateID, this)
    .then(() => {
      btn.value = 'Enviar';
      alerta("Pedido de Contato", "O seu pedido de contato foi efetuado com sucesso!", "success");
      $("#fullname").val("");
      $("#email").val("");
      $("#message").val("");

      
    }, (err) => {
      btn.value = 'Enviar';
      alert(JSON.stringify(err));
    });
  });


function alerta(titulo,msg,icon){
    Swal.fire({
        position: 'center',
        icon: icon,
        title: titulo,
        text: msg,
        showConfirmButton: false,
        confirmButtonColor: '#45702d',
        timer: 3000
      })
}