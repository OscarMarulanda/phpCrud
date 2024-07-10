<?php
    $id = $_GET['id'];
    include("conexion.php");
    $sql= "delete from alumnos where id='".$id."'";
    $resultado = mysqli_query($conexion, $sql);

    if($resultado){
        echo "<script language='JavaScript'>
                        alert('Los datos se borraron correctamente');
                        location.assign('index.php');
                        </script>";
    }else{
        echo "<script language='JavaScript'>
                        alert('Los datos NO se borraron');
                        location.assign('index.php');
                        </script>";
    }

    mysqli_close($conexion);
?>