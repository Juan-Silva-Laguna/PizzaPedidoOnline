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
		      <a class="navbar-brand" href="pedidos.php"><span class="flaticon-pizza-1 mr-1"></span>Pizza<br><small>Deliciosa</small></a>
		      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
		        <span class="oi oi-menu"></span> Menu
		      </button>
	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item active"><a href="pedidos.php" class="nav-link">Pedidos</a></li>
	          <li class="nav-item "><a href="pizzas.php" class="nav-link">Pizzas</a></li>
			  <li class="nav-item"><a href="#" class="nav-link" onClick="$.post('../../CONTROLADOR/usuario.controller.php', {operacion:'salir'},function (respuesta) {respuesta=='1'?window.location.href='../index.php':'';})">Salir</a></li>
	        </ul>
	      </div>
		  </div>
	  </nav>
    <!-- END nav -->
    <section class="ftco-section" style="padding-top: 20px;">
    	<div class="container">
    		<div class="row justify-content-center mb-5 pb-3">
				<div class="col-md-7 heading-section ftco-animate text-center">
					<h2 class="mb-4">Pedidos</h2>
					<p class="flip"><span class="deg1"></span><span class="deg2"></span><span class="deg3"></span></p><br>
				</div>
					<div class="col-md-6">
						<h5>
							<label for="">Tipo de estado:</label>
								Pendientes
								<input type="radio" name='tipoEstado' value="Pendiente" checked>
								En Proceso
								<input type="radio" name='tipoEstado' value="En proceso">
						</h5>					
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<input type="text" class="form-control text-rigth" id="buscar" onkeyup="mostrar($('input:radio[name=tipoEstado]:checked').val(),$('#buscar').val())" placeholder="Buscar por Nombre de Cliente...         ">
						</div>				
					</div>
				<div class="table-responsive" id="resultado">
				</div>
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
  <script src="../../js/popper.min.js"></script>
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
  <script src="../../js/google-map.js"></script>
  <script src="../../js/main.js"></script>
  <script>
    $(document).ready(function(){
        mostrar('Pendiente');

		$("input[name=tipoEstado]").click(function () { 
			if ($('input:radio[name=tipoEstado]:checked').val()=="Pendiente") {
				mostrar('Pendiente');
				$('#buscar').val('');
			}else{
				mostrar('En Proceso');
				$('#buscar').val('');
			}            
		});
    });

    //------------------------FUNCIOINES-----------------
    function mostrar(estado, letras=''){
		console.log(estado);
		console.log(letras);
      $.post('../../CONTROLADOR/pedido.controller.php', {operacion: 'mostrarClientesPedidos', nombre:letras, estado:estado}, function (respuesta) {
		  console.log(respuesta);
        let datos = JSON.parse(respuesta);
        let template = '';
		let total = 0;
		if (datos.length>=1) {
			template = `
				<table class="table table-striped">
				  <thead>
					<tr>
						<th>Cliente</th>
						<th>Correo</th>
						<th>Numero Celular</th>
						<th>Hora de Pedido</th>
						<th>Dirección</th>
						<th>Estado</th>
						<th>Ver Pedido</th>
					</tr>
				  </thead>
				  <tbody>
			`;
			datos.forEach(dato => {
			template += `
					<tr>
						<td>${dato.cliNombre}</td>
						<td>${dato.cliCorreo}</td>
						<td>${dato.cliTelefono}</td>
						<td>${dato.pedFechaHora}</td>
						<td>${dato.pedDireccion}</td>
						<td>${dato.pedEstado}</td>
						<td><a href="detalles.php?idCliente=${dato.idCliente}&nombre=${dato.cliNombre}&correo=${dato.cliCorreo}&celular=${dato.cliTelefono}&fechaHora=${dato.pedFechaHora}&estado=${dato.pedEstado}&direccion=${dato.pedDireccion}" class="btn btn-warning">Ver</button></td>
					</tr>
				`;
				total += Number(dato.subtotal);
			});
			template += `
					</tbody>
				</table>
				
			`;
        	$('#resultado').html(template);	
						
		}else{
			$('#resultado').html(`<br><br><p class="mt-5 text-center">${letras==''? `Al parecer ninguno de tus clientes  ${estado=='Pendiente'?'han realizado pedidos :(': 'tiene un pedido en proceso :('}`: 'No se han encontrado resultados'} </p><br><br>`);
		}
                   
      })          
    }

  </script>
  </body>
</html>