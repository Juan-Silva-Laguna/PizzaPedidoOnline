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
	          <li class="nav-item active"><a href="pedido.php" class="nav-link">Pedido</a></li>
	          <li class="nav-item "><a href="menu.php" class="nav-link">Menu</a></li>
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
					<h2 class="mb-4">Tu Pedido</h2>
					<p class="flip"><span class="deg1"></span><span class="deg2"></span><span class="deg3"></span></p>
					
				</div>
        	</div>
			<div class="table-responsive" id="resultado">
								
			</div>
			<div id="visible">
				<div class="row">
					<div class="col-md-6">
						<h4>
							<label for="" class="mx-4">Es un pedido a domicilio?</label>
							<input type="radio" name="tipoPedido" id="si" value="si"> SI
							<input type="radio" name="tipoPedido" id="no" value="no" class="mx-2" checked>No
						</h4>					
					</div>
					<div class="col-md-6">
						<div class="form-group">				
							<input type="text" class="form-control text-center" id="direccion" placeholder="Por favor escriba numero de mesa">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group text-center">
							<input type="submit" value="Realizar Pedido" onClick="realizar()" class="btn btn-primary py-3 px-5">
						</div>
					</div>				
				</div>
			</div>			
    	</div>
    </section>
	<div class="form-group">
		<input type="button" style="background-color: transparent; border-color: transparent;" class="py-3 px-5">
	</div>
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
        mostrar();

		$("input[name=tipoPedido]").click(function () { 
			if ($('input:radio[name=tipoPedido]:checked').val()=="si") {
				$('#direccion').attr('placeholder','Por favor escriba su dirección');
			}else if ($('input:radio[name=tipoPedido]:checked').val() == "no") {
				$('#direccion').attr('placeholder','Por favor escriba numero de mesa');
			}            
		});
    });


    //------------------------FUNCIOINES-----------------
    function mostrar(){
      $.post('../../CONTROLADOR/pedido.controller.php', {operacion: 'mostrarMiPedido', idCliente: '', estado:'Atendido'}, function (respuesta) {
        let datos = JSON.parse(respuesta);
        let template = '';
		let estado = '';
		let total = 0;
		if (datos.length>=1) {
			template = `
				<table class="table table-striped">
				  <thead>
					<tr>
					  <th>Pizza</th>
					  <th>Cantidad</th>
					  <th>Valor</th>
					  <th>Subtotal</th>
					</tr>
				  </thead>
				  <tbody>
			`;
			datos.forEach(dato => {
			template += `
					<tr>
						<td>${dato.pizNombre}</td>
						<td>${dato.pedCantidad}</td>
						<td>$${dato.pizValor}</td>
						<td>$${dato.subtotal}</td>
					</tr>
				`;
				total += Number(dato.subtotal);
				estado = dato.pedEstado;
			});
			template += `
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td><a class="navbar-brand text-left" href="#"><span class="flaticon-pizza-1 mr-1"></span>Total $ ${total}</a></td>
						</tr>
					</tbody>
				</table>
				
			`;
        	$('#resultado').html(template);	
			console.log(estado);
			if (estado != 'Inicio') {
				$('#visible').css('display','none');
			}
			else{
				$('#visible').css('display','block');
			}
						
		}else{
			$('#visible').css('display','none');	
			$('#resultado').html(`<br><br><br><p class="mt-5 text-center">Aun no has agregado ninguna pizza, dirigete a nuestro menu y agrega las pizzas de tú preferencia, tenga en cuenta que todas absolutamente todas son deliciosas.</p><br><br><br>`);
		}
                   
      })          
    }

	function realizar() {
		$.post('../../CONTROLADOR/pedido.controller.php', {operacion: 'realizarMiPedido', direccion: $('#direccion').val(),estado:'Inicio'}, function (respuesta) {
			console.log(respuesta);
			mostrar();
			let datos = JSON.parse(respuesta);                  
		}) 
	}

	
  </script>
    
  </body>
</html>