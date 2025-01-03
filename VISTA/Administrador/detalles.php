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

    <section class="ftco-section" style="padding-top: 20px;padding-bottom: 0px;">
		<input type="hidden" id="idCliente" value="<?php echo $_GET['idCliente']?>">
		<input type="hidden" id="correo" value="<?php echo $_GET['correo']?>">
    	<div class="container">
    		<div class="row justify-content-center mb-5 pb-3">
				<div class="col-md-7 heading-section ftco-animate text-center">
					<h2 class="mb-4">Pedido de <?php echo $_GET['nombre']?> esta <?php echo $_GET['estado']?></h2>
					<p class="flip"><span class="deg1"></span><span class="deg2"></span><span class="deg3"></span></p><br>
					<p class="mt-2"><?php echo $_GET['nombre']?> realizo el siguiente pedido el <?php echo $_GET['fechaHora']?> con direccion <?php echo $_GET['direccion']?></p>
				</div>
				<div class="table-responsive" id="resultado">
								
				</div>
				<div class="form-group">
					<input type="submit" value="Regrsar" onclick="window.location.href = 'pedidos.php'" class="btn btn-secondary py-3 px-5">
					<?php if ($_GET['estado']=='Pendiente') {
						echo '<input type="submit" value="Poner Pedido en Proceso" onClick="ponerEnProceso()" class="btn btn-primary py-3 px-5">';
					}else{
						echo '<input type="submit" value="Atendido" onClick="atendido()" class="btn btn-primary py-3 px-5">';
					}
					?>
					
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
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/emailjs-com@2.3.2/dist/email.min.js"></script>
	<script>
		$(document).ready(function(){
        	mostrar();
		});
		let todo = '';
		let total = 0;
		function mostrar(){
			const datos = {
				operacion: 'mostrarMiPedido', 
				idCliente: $('#idCliente').val(), 
				estado:'Atendido'
			}
			console.log(datos);
			$.post('../../CONTROLADOR/pedido.controller.php', datos, function (respuesta) {
				let datos = JSON.parse(respuesta);
				total = 0;
				let	template = `
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
					todo += " * "+dato.pedCantidad+" "+dato.pizNombre+" por un valor de "+dato.subtotal+" las "+dato.pedCantidad+` pizzas. `;
					total += Number(dato.subtotal);
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
			})          
		}
		
		function ponerEnProceso() {
			$.post('../../CONTROLADOR/pedido.controller.php', {operacion: 'ponerEnProceso', idCliente: $('#idCliente').val()}, function (respuesta) {
				if (respuesta=='1') {
					alert('El pedido fue puesto en proceso satisfactoriamente!!');
					window.location.href = 'pedidos.php';   
				}       
			}) 
		}

		function atendido() {
			$.post('../../CONTROLADOR/pedido.controller.php', {operacion: 'atendido', idCliente: $('#idCliente').val()}, function (respuesta) {
				console.log(respuesta);
				if (respuesta=='1') {
					(function(){
						emailjs.init("user_Q2dPVfk0cq2gwaHODfEa0");
					})();
					emailjs.send("gmail" , "template_3zbextk" , {"to_email":`${$('#correo').val()}`,"from_name":`correAutomatico@pizzeria.com`,"todo":`${todo}`,"total":`${total}`})
					.then(function(){ 
						alert('Se finalizo el pedido satisfactiamente!!');
						window.location.href = 'pedidos.php'; 
					}, function(err) {
						alert('Se finalizo el pedido satisfactiamente, pero no se logro enviar correo a el cliente!!');
						window.location.href = 'pedidos.php'; 
					});		
				}       
			}) 
		}
	</script>    
  </body>
</html>