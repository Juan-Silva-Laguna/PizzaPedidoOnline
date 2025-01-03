<?php
   //Recogemos el archivo enviado por el formulario 
   $archivo = $_FILES['archivo']['name'];  
   $antigua = $_POST['antigua']; 
   $nueva = $_POST['nueva']; 
   //Si el archivo contiene algo y es diferente de vacio
   if (isset($archivo) && $archivo != "") {
      if ($antigua!="") {
         unlink('../VISTA/fotosPizza/'.$antigua);
      }
      
      //Obtenemos algunos datos necesarios sobre el archivo
      $temp = $_FILES['archivo']['tmp_name'];
      if (file_exists('../VISTA/fotosPizza/'.$archivo)) {
            echo '0';
      } else {         
         //Si la imagen es correcta en tamaño y tipo
         //Se intenta subir al servidor
         if (move_uploaded_file($temp, '../VISTA/fotosPizza/'.$archivo)) {
            //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
            chmod('../VISTA/fotosPizza/'.$archivo, 0777);
            //Mostramos el mensaje de que se ha subido co éxito
            echo $archivo;
         }
         else {
            //si falla mostramos un mensaje de error
            echo '1';
         }
      }
      
   }

?>