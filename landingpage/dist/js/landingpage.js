let isDropdownOpen2 = false;

function toggleDropdown() {
  const dropdownContent = document.getElementById('dropdownContent');
  const icon = document.getElementById('icon');

  if (!isDropdownOpen2) {
    icon.style.animation = 'rotatePlus2 0.3s forwards';
  } else {
    icon.style.animation = 'rotatePlusReverse2 0.3s forwards';
  }

  dropdownContent.classList.toggle('hidden');
  isDropdownOpen2 = !isDropdownOpen2;
}

  let isDropdownOpen = false;

  function toggleDropdown1() {
    const dropdownContent = document.getElementById('dropdownContent1');
    const icon = document.getElementById('icon1');
  
    if (!isDropdownOpen) {
      icon.style.animation = 'rotatePlus 0.3s forwards';
    } else {
      icon.style.animation = 'rotatePlusReverse 0.3s forwards';
    }
  
    dropdownContent.classList.toggle('hidden');
    isDropdownOpen = !isDropdownOpen;
  }

  let isDropdownOpen3 = false;

  function toggleDropdown2() {
    const dropdownContent = document.getElementById('dropdownContent2');
    const icon = document.getElementById('icon2');
  
    if (!isDropdownOpen3) {
      icon.style.animation = 'rotatePlus3 0.3s forwards';
    } else {
      icon.style.animation = 'rotatePlusReverse3 0.3s forwards';
    }
  
    dropdownContent.classList.toggle('hidden');
    isDropdownOpen3 = !isDropdownOpen3;
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