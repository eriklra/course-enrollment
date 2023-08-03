<?php
   session_start();
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
               <div class="logo"><a href="index.php"><img src="images/logo2.png"></a></div>
               <div class="menu_main">
                  <ul>
                     <li class="active"><a href="salir.php">Salir</a></li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
      <!-- header section end -->
      <!-- about section start -->
      <div class="about_section layout_padding">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-6">
                  <div class="about_taital_main">
                     <h1 class="about_taital">Materias</h1>
                     <br><br>
                     <hr>
                     <?php
                        include("conexion.php");

                        $link = Conectar();
                        mysqli_select_db($link, "inscripciones");
                        $result = mysqli_query($link,"select * from materia");
                        
                           echo "<table border=1 class='table'>";
                           echo "<thead class='thead-light'><tr><th scope='col'> ID </th><th scope='col'> NOMBRE </th><th scope='col'> CUPO </th><th scope='col'> CUPO MAXIMO </th><th scope='col'> ESTADO </th></tr></thead>";
                           

                           while ($row = mysqli_fetch_array($result)) {
                                 $id = $row['id_materia'];
                                 $no = $row['nombre'];
                                 $cu = $row['cupo'];
                                 $cm = $row['cupo_maximo'];
                                 $es = $row['estado'];
                                 echo "<tr><td> $id </td><td> $no </td><td> $cu </td><td> $cm </td><td> $es </td></tr>";
                           }

                           echo "</table>";
                     ?>
                     <hr>
                     <br>
                     <h2>Inscribir</h2>
                     <form action="procesar.php" method="POST" class="form-inline">
                        <input type="text" id="nrc1" name="nrc1" class="form-control form-control-sm mr-2"><br>

                        <input type="text" id="nrc2" name="nrc2" class="form-control form-control-sm mr-2"><br>

                        <input type="text" id="nrc3" name="nrc3" class="form-control form-control-sm mr-2"><br>

                        <br>
                        <input type="submit" value="Enviar" class="btn btn-primary">
                     </form>

                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="about_taital_main">
                        <h1 class="about_taital">Inscritas</h1>
                        <br><br>
                        <hr>
                        <?php
                           $nombre = $_SESSION['k_username'];

                           $result2 = mysqli_query($link,"select id_usuario from usuario where nombre = '$nombre'");
                           if ($row = mysqli_fetch_assoc($result2)) {
                              $id_usuario = $row['id_usuario'];
                              $_SESSION['id'] = $id_usuario;
                           } else {
                              $id_usuario = null; 
                           }
                           
                           

                           $result3 = mysqli_query($link,"select id_materia from inscripcion where id_usuario = $id_usuario");
                        
                            echo "<table border=1 class='table'>";
                            echo "<thead class='thead-light'><tr><th scope='col'> ID </th><th scope='col'> NOMBRE </th><th scope='col'> CUPO </th><th scope='col'> CUPO MAXIMO </th><th scope='col'> ESTADO </th></tr></thead>";
                            
 
                            while ($row = mysqli_fetch_array($result3)) {
                                  $id = $row['id_materia'];

                                  $materias = mysqli_query($link,"select nombre,cupo,cupo_maximo,estado from materia where id_materia = $id");
                                  $rowMaterias = mysqli_fetch_array($materias);
                                  $no = $rowMaterias['nombre'];
                                  $cu = $rowMaterias['cupo'];
                                  $cm = $rowMaterias['cupo_maximo'];
                                  $es = $rowMaterias['estado'];
                                  echo "<tr><td> $id </td><td> $no </td><td> $cu </td><td> $cm </td><td> $es </td></tr>";
                            }
 
                            echo "</table>";
                            mysqli_close($link);
                        ?>
                        <hr>
                     </div>
                  </div>
               </div>
         </div>
      </div>
      <!-- about section end -->
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