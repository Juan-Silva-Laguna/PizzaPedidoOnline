<?php
	session_start();
    if ($_SESSION['id']=='') {
        header('Location: ../index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Pizza Deliciosa</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nothing+You+Could+Do" rel="stylesheet">

    <link rel="stylesheet" href="../../css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="../../css/animate.css">
    
    <link rel="stylesheet" href="../../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../../css/magnific-popup.css">

    <link rel="stylesheet" href="../../css/aos.css">

    <link rel="stylesheet" href="../../css/ionicons.min.css">

    <link rel="stylesheet" href="../../css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="../../css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="../../css/flaticon.css">
    <link rel="stylesheet" href="../../css/icomoon.css">
    <link rel="stylesheet" href="../../css/style.css">
  </head>
  <body>
  	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
		      <a class="navbar-brand" href="pedido.php"><span class="flaticon-pizza-1 mr-1"></span>Pizza<br><small>Deliciosa</small></a>
		      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
		        <span class="oi oi-menu"></span> Menu
		      </button>
	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item"><a href="pedido.php" class="nav-link">Pedido</a></li>
	          <li class="nav-item active"><a href="menu.php" class="nav-link">Menu</a></li>
	          <li class="nav-item"><a href="#" class="nav-link" onClick="$.post('../../CONTROLADOR/usuario.controller.php', {operacion:'salir'},function (respuesta) {respuesta=='1'?window.location.href='../index.php':'';})">Salir</a></li>
	        </ul>
	      </div>
		  </div>
	  </nav>
    <!-- END nav -->
    <section class="ftco-section" style="padding-top: 20px;">
    	<div class="container">
    		<div class="row justify-content-center mb-1 pb-3">
				<div class="col-md-7 heading-section ftco-animate text-center">
					<h2 class="mb-4">Menu</h2>
					<p class="flip"><span class="deg1"></span><span class="deg2"></span><span class="deg3"></span></p>
					<p class="mt-5">Escoja la pizza de su preferencia, todas son deliciosas pizzas, esperamos atenderlo de la mejor manera.</p>
				</div>
			</div>
			<div class="form-group">
				<input type="text" class="form-control text-right" id="buscar" onkeyup="mostrar($('#buscar').val())" placeholder="Buscar...            ">
			</div>
    		<div class="row" id="resultadoPizzas">
    		</div>
    	</div>
    </section>
    <footer class="ftco-section ftco-services" style="padding-top: 30px;padding-bottom: 15px;">
    	<div class="container">
			<div class="row">
          		<div class="col-md-12 text-center">
					<p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						Copyright &copy;<script>document.write(new Date().getFullYear());</script> Todos los derechos reservados | Diseño hecho  <i class="icon-heart" aria-hidden="true"></i> por <a href="https://colorlib.com" target="_blank" style="color: black; font-weight: bold;">Colorlib</a>
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					</p>
          		</div>
        	</div>
    	</div>
    </footer>
  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

  <script src="../../js/jquery.min.js"></script>
  <script src="../../js/jquery-migrate-3.0.1.min.js"></script>
  <script src="../../js/bootstrap.min.js"></script>
  <script src="../../js/jquery.easing.1.3.js"></script>
  <script src="../../js/jquery.waypoints.min.js"></script>
  <script src="../../js/jquery.stellar.min.js"></script>
  <script src="../../js/owl.carousel.min.js"></script>
  <script src="../../js/jquery.magnific-popup.min.js"></script>
  <script src="../../js/aos.js"></script>
  <script src="../../js/jquery.animateNumber.min.js"></script>
  <script src="../../js/bootstrap-datepicker.js"></script>
  <script src="../../js/jquery.timepicker.min.js"></script>
  <script src="../../js/scrollax.min.js"></script>
  <script src="../../js/main.js"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

  <script>
   $(document).ready(function(){
        mostrar();  


    });

    //------------------------FUNCIOINES-----------------
    function mostrar(letras=''){
      $.post('../../CONTROLADOR/pizza.controller.php', {operacion: 'mostrar',id:'',nombre:letras, estado:'Desactiva'}, function (respuesta) {
        let datos = JSON.parse(respuesta);
        let template = '';
        datos.forEach(dato => {
          template += `
            <div class="col-md-3 text-center">
              <div class="menu-wrap">
                <a href="#" class="menu-img img mb-4" style="background-image: url(../fotosPizza/${dato.pizImagen});"></a>
                <div class="text">
                  <h3><a href="#">${dato.pizNombre}</a></h3>
                  <p>${dato.pizIngredientes}</p>
                  <p class="price"><span>$ ${dato.pizValor}</span></p>
                  <p><a href="#" class="btn btn-white btn-outline-white" onClick="agregar(${dato.idPizza}, '${dato.pizNombre}')">Agregar</a></p>
                </div>
              </div>
            </div>
          `;
        });
        $('#resultadoPizzas').html(template);              
      })          
    }

    function agregar(idPizza, nombrePizza) {
      let cantidad = prompt('Cuantas '+nombrePizza+' vas a pedir?');
      const datos = {
        idPizza: idPizza,
        cantidad: cantidad,
        operacion: 'agregar'
      };
      console.log(datos);
      $.post('../../CONTROLADOR/pedido.controller.php', datos, function (respuesta) {
        if (respuesta=='1') {
          alert('Se agrego la pizza!!');
        }
      })
              
    }
    
  </script>
    
  </body>
</html>