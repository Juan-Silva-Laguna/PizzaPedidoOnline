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
	          <li class="nav-item"><a href="pedidos.php" class="nav-link">Pedidos</a></li>
	          <li class="nav-item active "><a href="pizzas.php" class="nav-link">Pizzas</a></li>
			      <li class="nav-item"><a href="#" class="nav-link" onClick="$.post('../../CONTROLADOR/usuario.controller.php', {operacion:'salir'},function (respuesta) {respuesta=='1'?window.location.href='../index.php':'';})">Salir</a></li>
	        </ul>
	      </div>
		  </div>
	  </nav>
    <!-- END nav -->
    <section class="ftco-section contact-section" style="padding-top: 20px;padding-bottom: 0px;">
      <div class="row justify-content-center mb-2 pb-3" style="margin-right: 0px;">
        <div class="col-md-4 heading-section ftco-animate text-center">
          <h2 class="mb-4">Pizzas</h2>
          <p class="flip"><span class="deg1"></span><span class="deg2"></span><span class="deg3"></span></p>
        </div>
      </div>
    </section>

    <section class="ftco-section contact-section" style="padding-top: 20px;padding-bottom: 0px;">
      <div class="row justify-content-center mb-5 pb-3" style="margin-right: 0px;">
        <div class="col-md-4 heading-section ftco-animate text-center" style="padding-left: 30px;">
            <input type="hidden" id="id">
            <div class="form-group">
              <input type="text" class="form-control text-center" id="nombre" placeholder="Nombre de nueva pizza">
            </div>
            <br>
            <div class="form-group">
              <textarea  id="ingredientes" cols="5" rows="3" class="form-control text-center" placeholder="Ingredientes de la nueva pizza"></textarea>
            </div>
            <br>
            <div class="form-group">
              <input type="number" class="form-control text-center" id="valor" placeholder="Valor de nueva pizza">
            </div>
            <br>
            <div class="row">
              <div class="col-md-6">
                <label for="imagen" style="    background: #fac564;border: 1px solid #fac564;color: #000;cursor: pointer;padding: 11px 30px !important;text-align: center;">Elegir Foto:</label>
                <input type="file" name="imagen" id="imagen" max="1" accept=".jpg,.jpeg,.png" style="opacity: 0;position: absolute;">
              </div>
              <div class="col-md-6">
                <div class="menu-wrap">
                  <a href="#" class="menu-img img mb-4" id="foto"></a>
                </div>
              </div>
            </div>
            <div class="form-group">
              <input type="submit" value="Crear Pizza" id="btnFormu" class="btn btn-primary py-3 px-5">
            </div>
        </div>
        <div class="col-md-8">
          <div class="form-group">
            <input type="text" class="form-control text-right" id="buscar" onkeyup="mostrar($('#buscar').val())" placeholder="Buscar...            ">
          </div>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Pizza</th>
                  <th>Ingrediente</th>
                  <th>Valor</th>
                  <th>Imagen</th>
                  <th>Estado</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody id="resultado"></tbody>
            </table>
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
    let nombreImgNueva ="";
    let nombreImgAntigua ="";
   $(document).ready(function(){
        mostrar();       
        $(document).on('change', '#imagen', function (e) {
            e.preventDefault();
            let inputFileImage = document.getElementById(e.target.id);
            
            let file = inputFileImage.files[0];
            if (nombreImgNueva=="") {
              nombreImgNueva = file.name;
            }else{
              nombreImgAntigua = nombreImgNueva;
            }
            
            let data = new FormData();
            data.append('archivo',file);
            data.append('nueva',nombreImgNueva);
            data.append('antigua',nombreImgAntigua);
            console.log(data);
            $.ajax({
                url:"../../CONTROLADOR/subirImagen.php",
                type:'POST',
                contentType:false,
                data:data,
                processData:false,
                cache:false
            })
            .done(function(respuesta){
              console.log(respuesta);
                switch (respuesta) {
                case "0":
                    alert('Error: Por favor cambie el nombre del archivo para subirlo');
                    $("#archivo").val('');
                break;
                case "1":
                    alert('Ocurrió algún error al subir el fichero. Intente de nuevo');
                    $("#archivo").val('');
                    break;   
                default:
                    nombreImgNueva = file.name;
                    $('#foto').attr("style", "background-image: url('../fotosPizza/"+nombreImgNueva);
                    break;
                }    
            });
        });

        $(document).on('click','#btnFormu', function (e) {       
          const datos = {
              id: $('#id').val(),
              nombre: $('#nombre').val(),
              ingredientes: $('#ingredientes').val(),
              valor: $('#valor').val(),
              foto: nombreImgNueva,
              operacion: $('#btnFormu').val()
          };
          console.log(datos);
          $.post('../../CONTROLADOR/pizza.controller.php', datos, function (respuesta) {
              limpiar();
              mostrar();
          })
          
                
          e.preventDefault();
        });
    });

    //------------------------FUNCIOINES-----------------

    function activar(id) {
      $.post('../../CONTROLADOR/pizza.controller.php', {id: id, operacion: 'activar'}, function (respuesta) {
          mostrar();
      })
    }

    function desactivar(id) {
      $.post('../../CONTROLADOR/pizza.controller.php', {id: id, operacion: 'desactivar'}, function (respuesta) {
          mostrar();
      })
    }

    function mostrar(letras=''){
      console.log(letras);
      $.post('../../CONTROLADOR/pizza.controller.php', {operacion: 'mostrar',id:'',nombre:letras, estado:''}, function (respuesta) {
        console.log(respuesta);
          let datos = JSON.parse(respuesta);
          let template = '';
          datos.forEach(dato => {
            template += `
              <tr>
                <td>${dato.pizNombre}</td>
                <td>${dato.pizIngredientes}</td>
                <td>$ ${dato.pizValor}</td>
                <td><a href="../fotosPizza/${dato.pizImagen}">${dato.pizImagen}</a></td>
                <td><p style="${dato.pizEstado=='Activa'?'color: green;':'color: red;'}">${dato.pizEstado}</p></td>
                <td>${dato.pizEstado=='Activa'?`<button class="btn btn-danger" onClick="desactivar(${dato.idPizza});"><i class="fa fa-toggle-off" aria-hidden="true"></i></button>`:`<button class="btn btn-success" onClick="activar(${dato.idPizza});"><i class="fa fa-toggle-on" aria-hidden="true"></i></button>`} <button class="btn btn-warning" onClick="llenar(${dato.idPizza},'${dato.pizNombre}','${dato.pizIngredientes}',${dato.pizValor},'${dato.pizImagen}');"><i class="fa fa-edit" aria-hidden="true"></i></button></td>
              </tr>
            `;
          });
          $('#resultado').html(template);              
      })          
    }

    function limpiar() {
      $('#id').val('');
      $('#nombre').val('');
      $('#ingredientes').val('');
      $('#valor').val('');
      $('#imagen').val('');
      nombreImgNueva = "";
      nombreImgAntigua = "";
      $('#foto').attr("style", "");
      $('#btnFormu').val('Crear Pizza');      
    }
  
    function llenar(id,nombre,ingredientes,valor,imagen) {
      $('#id').val(id);
      $('#nombre').val(nombre);
      $('#ingredientes').val(ingredientes);
      $('#valor').val(valor);
      nombreImgNueva = imagen;
      nombreImgAntigua = imagen;
      console.log(imagen);
      $('#foto').attr("style", "background-image: url('../fotosPizza/"+imagen);
      $('#btnFormu').val('Editar Pizza');      
    }
  
  </script>

  </body>
</html>