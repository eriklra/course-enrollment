<?php
   session_start();
   include("conexion.php");
   include("funciones.php");
   $usuario = $_SESSION["k_username"];
   $id_usuario = $_SESSION["id"];
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Inscripciones</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="images/fevicon.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <!-- fonts -->
      <link href="https://fonts.googleapis.com/css?family=Poppins:400,700|Righteous&display=swap" rel="stylesheet">
      <!-- owl stylesheets --> 
      <link rel="stylesheet" href="css/owl.carousel.min.css">
      <link rel="stylesheet" href="css/owl.theme.default.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
   </head>
   <body>
      <!-- header section start -->
      <div class="header_section">
         <div class="header_main">
            <div class="container-fluid">
               <div class="logo"><a href="index.html"><img src="images/logo2.png"></a></div>
            </div>
         </div>
      </div>
      <!-- header section end -->
      <!-- contact section start -->
      <div class="contact_section layout_padding">
        <div class="container">
          <h1 class="contact_taital">Inscripciones</h1>
            <?php
               $materia1 = $_REQUEST['nrc1'];
               $materia2 = $_REQUEST['nrc2'];
               $materia3 = $_REQUEST['nrc3'];

               
               
            ?>



          <div class="email_text">
             <?php
               if ($materia1 == null && $materia2 == null && $materia3 == null) {
                  echo "No ha seleccionado ninguna";
               } else {
                  $link = Conectar();
                  mysqli_select_db($link, "inscripciones");

                  // Iniciar una transacción
                  mysqli_begin_transaction($link);

                  try {
                     if ($materia1) {
                        inscripcion($link, $materia1, $id_usuario);
                     }

                     if ($materia2) {
                        inscripcion($link, $materia2, $id_usuario);
                     }

                     if ($materia3) {
                        inscripcion($link, $materia3, $id_usuario);
                     }
                 
                     // Confirmar la transacción
                     mysqli_commit($link);
                 } catch (Exception $e) {
                     // Manejar errores y deshacer la transacción
                     mysqli_rollback($link);
                     echo "Error: " . $e->getMessage();
                 }

                  
               }
               

               mysqli_close($link);
             ?>
             <div class="send_btn"><a href="inscripciones.php">Continuar</a></div>
          </div>
        </div>
      </div>
      <!-- contact section end -->
      <!-- footer section start -->
      <div class="footer_section layout_padding">
         <div class="container">
            <div class="input_btn_main">
               <input type="text" class="mail_text" placeholder="Escribe tu comentario" name="Escribe tu comentario">
               <div class="subscribe_bt"><a href="#">Enviar</a></div>
            </div>
            <div class="location_main">
               <div class="call_text"><img src="images/call-icon.png"></div>
               <div class="call_text"><a href="#">222 229 5698</a></div>
               <div class="call_text"><img src="images/mail-icon.png"></div>
               <div class="call_text"><a href="#">ccs@correo.buap.mx.</a></div>
            </div>
      <!-- footer section end -->
      <!-- copyright section start -->
      <div class="copyright_section">
         <div class="container">
            <p class="copyright_text"> <a href=""></a></p>
         </div>
      </div>
      <!-- copyright section end -->
      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <script src="js/plugin.js"></script>
      <!-- sidebar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
      <!-- javascript --> 
      <script src="js/owl.carousel.js"></script>
      <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>    
   </body>
</html>