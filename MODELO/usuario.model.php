<?php
namespace modeloUsuario;
use PDO;

include_once("../ENTIDAD/usuario.entity.php");
include_once("../ENTORNO/conexion.php");
class Usuario{
      private $id;
      private $nombre;
      private $correo;
      private $celular;
      private $clave;
      private $conexion;
      private $consulta;
      private $resultado;
      private $retorno;
      public function __construct(\entidadUsuario\Usuario $usuarioE)
      {
         $this->conexion = new \Conexion();
         $this->id=$usuarioE->getId();  
         $this->nombre=$usuarioE->getNombre();  
         $this->correo=$usuarioE->getCorreo(); 
         $this->celular=$usuarioE->getCelular();
         $this->clave=$usuarioE->getClave();
      }

    public function registrar()
    {
      $password = md5($this->clave);
       $this->consulta="INSERT INTO clientes VALUES(null, '$this->nombre', '$this->correo', '$this->celular', '$password')";
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       if($this->resultado->rowCount()>=1){
            $this->retorno=1;
       }
       else{
            $this->retorno=0;
       }
       return $this->retorno;
    }

    public function ingresarCliente()
    {  
      $password = md5($this->clave);
       $this->consulta="SELECT * FROM clientes WHERE cliCorreo ='$this->correo' AND cliPassword ='$password'";
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       if($this->resultado->rowCount()>=1){            
         foreach ($this->resultado->fetchAll(PDO::FETCH_ASSOC) as $dato) {
            session_start();
            $_SESSION['id'] = $dato['idCliente'];
            $_SESSION['nombre'] = $dato['cliNombre'];
            return 2;
         }
      }
      else{
         return 'Hay un error de autenticacion por favor vuelva a intentarlo';
      }
    }

    public function ingresarAdmin()
    {  
      $password = md5($this->clave);
       $this->consulta="SELECT * FROM usuarios WHERE usuLogin ='$this->correo' AND usuPassword ='$password'";
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       if($this->resultado->rowCount()>=1){            
         foreach ($this->resultado->fetchAll(PDO::FETCH_ASSOC) as $dato) {
            session_start();
            $_SESSION['id'] = $dato['idUsuario'];
            $_SESSION['usuario'] = $dato['usuLogin'];
            return 1;
         }
      }
      else{
         return 'Hay un error de autenticacion por favor vuelva a intentarlo';
      }
      
    }

    public function salir()
    {
       $this->consulta="SELECT * FROM usuarios WHERE idusuario LIKE '%$this->id%' AND pizNombre LIKE '%$this->nombre%' AND pizEstado NOT LIKE '%$this->estado%'";
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       return $this->resultado->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>