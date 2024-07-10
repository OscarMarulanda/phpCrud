<?php 
    include("conexion.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDITAR</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <?php
        if(isset($_POST['enviar'])){
            //aquí entramos si se presiona el botón enviar
            $id=$_POST['id'];
            $nombre1=$_POST['nombre'];
            $nocontrol=$_POST['nocontrol'];

            $nombre1 = strtolower($nombre1);
            $nombre = "";

            for ($x = 0; $x <= strlen($nombre1)-1; $x++) {
                if(ord($nombre1[$x])==32){
                    $nombre .= " ";
                }else{
                    if((ord($nombre1[$x])+($nocontrol%26))>122){
                        $nombre .= chr(ord($nombre1[$x])+($nocontrol%26)-26);
                    }else{
                        if((ord($nombre1[$x])+($nocontrol%26))<97){
                            $nombre .= chr(ord($nombre1[$x])+($nocontrol%26)+26);
                        }else{
                            $nombre .= chr(ord($nombre1[$x])+($nocontrol%26));
                        }
                    }
                }
            }

            //update alumnos set
            $sql = "update alumnos set nombre='".$nombre1."', nocontrol='".$nocontrol."', modificado='".$nombre."' where id='".$id."'";

            $resultado = mysqli_query($conexion, $sql);

            if($resultado){
                echo "<script language='JavaScript'>
                        alert('Los datos se actualizaron correctamente');
                        location.assign('index.php');
                        </script>";
            }else{
                echo "<script language='JavaScript'>
                        alert('Los datos NO se actualizaron');
                        location.assign('index.php');
                        </script>";
            }
            mysqli_close($conexion);


        }else{
            $id=$_GET['id'];
            $sql="select * from alumnos where id='".$id."'";
            $resultado = mysqli_query($conexion,$sql);

            $fila=mysqli_fetch_assoc($resultado);
            $nombre=$fila["nombre"];
            $nocontrol=$fila["nocontrol"];
            mysqli_close($conexion);
    ?>
    <h1>Editar Alumnos</h1>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
        <label>Nombre</label>
        <input type="text" name="nombre" value="<?php echo $nombre; ?>"><br>

        <label>No. Control</label>
        <input type="text" name="nocontrol" value="<?php echo $nocontrol; ?>"><br>

        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <input type="submit" name="enviar" value="ACTUALIZAR">
        <a href="index.php">Regresar</a>
    </form>
    <?php
        };
    ?>
</body>
</html>
