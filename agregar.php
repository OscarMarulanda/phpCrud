<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AGREGAR</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <?php
        if(isset($_POST['enviar'])){
            $nombre1 = $_POST['nombre'];
            $nocontrol = $_POST['nocontrol'];

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
            
            
            include("conexion.php");
            $sql = "insert into alumnos(nombre, nocontrol, modificado) values('".$nombre1."', '".$nocontrol."', '".$nombre."')";

            $resultado = mysqli_query($conexion,$sql);

            if($resultado){
                echo "<script language='JavaScript'>
                        alert('Los datos fueron ingresados correctamenntte a la BD');
                        location.assign('index.php');
                        </script>";
            }else{
                echo "<script language='JavaScript'>
                        alert('Los datos no ingresaron a la BD');
                        location.assign('index.php');
                        </script>";
            }
            mysqli_close($conexion);
        }else{

    ?>
    <h1>Agregar nuevo alumno</h1>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre"><br>
        <label for="nocontrol">No. Control</label>
        <input type="number" name="nocontrol" id="nocontrol"><br>
        <input type="submit" name="enviar" value="AGREGAR">
        <a href="index.php">Regresar</a>
    </form>
    <?php
        }
    ?>
</body>
</html>