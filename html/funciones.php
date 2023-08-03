<?php
    function inscripcion($link, $id_materia, $id_usuario){
        echo "<p> Materia: $id_materia </p>";

        $lleno = true;

        $consulta = mysqli_query($link, "SELECT inscritas FROM usuario WHERE id_usuario = $id_usuario FOR UPDATE");
        $row = mysqli_fetch_assoc($consulta);
        $inscritas = $row['inscritas'];

        if (evaluaReinscripcion($link, $id_materia, $id_usuario)) {
            $result = mysqli_query($link, "SELECT nombre, cupo, cupo_maximo FROM materia WHERE id_materia = $id_materia FOR UPDATE");
            $row = mysqli_fetch_assoc($result);
            $cupo = $row['cupo'];
            $cupoMaximo = $row['cupo_maximo'];
            $nombre = $row['nombre'];

            if ($cupo >= $cupoMaximo) {
                $lleno = true;
                echo " <p>RECHAZADA -- CUPO LLENO</p> ";
            } else {
                $lleno = false;
            }
        } else {
            echo " <p>RECHAZADA -- INSCRITA PREVIAMENTE</p> ";
        }
        
        if (!$lleno && $inscritas < 3){
            $inscritas++;
            $cupo++;
            mysqli_query($link, "UPDATE materia SET cupo = $cupo WHERE id_materia = $id_materia");
            mysqli_query($link, "UPDATE usuario SET inscritas = $inscritas WHERE id_usuario = $id_usuario");
            if ($cupo == $cupoMaximo) {
                mysqli_query($link, "UPDATE materia SET estado = 'cerrado' WHERE id_materia = $id_materia");
            }
            mysqli_query($link, "INSERT INTO inscripcion (id_materia, id_usuario) VALUES ($id_materia, $id_usuario)");
            echo " <p>ACEPTADA -- INSCRITA EXITOSAMENTE</p> ";
        } else {
            if ($inscritas >= 3) {
                 echo " <p>RECHAZADA -- HAZ ALCANZDO TU LIMITE DE MATERIAS</p> ";
            }
        }

        
    }

    function evaluaReinscripcion($link, $id_materia, $id_usuario){
        $query = "SELECT * FROM inscripcion WHERE id_materia = $id_materia AND id_usuario = $id_usuario";
        $result = mysqli_query($link, $query);

        if (mysqli_num_rows($result) > 0) {
            return false;
        } else {
            return true;
        }
    }
?>