function SeleccionMenu(objeto) {
	$(".limenu").css('color','black');
	objeto.style.color='white';

	var menu= objeto.getAttribute('data-menu');

	if (menu=='citas') {
		GoToPage('citas');
	}

  if (menu=='salir') {
    AbriModalSalir();
  }

  if (menu=='miscompras') {
    GoToPage('listadocompras');
  }
  if (menu=='login') {
     localStorage.setItem('celular','');
     GoToPage('login');

  }


  if (menu=='negocios') {
    
     GoToPage('home');

  }
}

function toggleMenu() {
  var menu = document.getElementById("menu");
  if (abierto ==1) {
    menu.style.left = "0";

   $(".menu").removeClass('zimenu');
   abierto=0;
  } else {
    menu.style.left = "-100px";
    
    $(".menu").addClass('zimenu');
    abierto=1;
  }


}