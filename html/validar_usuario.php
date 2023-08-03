<?php session_start();
include("conexion.php");

date_default_timezone_set('America/Chicago');


$usuario=$_REQUEST['nombre']; 
$password=$_REQUEST['pass'];

$link = Conectar(); //se abre la conexion con link
mysqli_select_db($link,"inscripciones");
$resultado = mysqli_query ($link,"select contrasena,nombre,tipo,semestre from usuario where nombre='$usuario'");

   if($row = mysqli_fetch_array($resultado))
      {
        if($row["contrasena"] == $password)
           {
            $_SESSION["k_username"] = $row['nombre'];
	         $ti=$row['tipo'];
            $semestre = $row['semestre'];
	         if ($ti==1){
               header("Location: index.php");
            } else {

               /*
               // Crea una cadena de fecha y hora en formato legible
               $hora_actual = date('H:i:s');

               $hora_ingreso;
               $hora_limite;

               // Convierte la cadena de fecha y hora en un sello de tiempo Unix
               $timestamp = strtotime($hora_actual);
         

               switch ($semestre) {
                  case 1:
                     $hora_ingreso = '21:05:00';
                     $hora_limite = '21:09:59';
                     break;
                  
                  case 2:
                     $hora_ingreso = '21:10:00';
                     $hora_limite = '21:19:59';
                     break;

                  case 3:
                     $hora_ingreso = '21:20:00';
                     $hora_limite = '21:29:59';
                     break;

                  default:
                     # code...
                     break;
               }

               if (strtotime($hora_ingreso) < $timestamp && strtotime($hora_limite) > $timestamp) {
                  header("Location: about.php"); 
               } else {
                  header("Location: services.php");
               }
               */

               header("Location: inscripciones.php");

                 
            }      
            //header("Location: index.php");
           }
        //else header("Location: errorPassword.php"); 
   }
   else header("Location: services.php"); 
  
?> 