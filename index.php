
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificador de palabras</title>
    <script type="text/javascript">
        function confirmar(){
            return confirm('¿Estás seguro? se borrarán los datos');
        }
    </script>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<?php
    include("conexion.php");
    $sql = "select * from alumnos";
    $resultado = mysqli_query($conexion, $sql)
?>


    <h1>Modificador de palabras</h1>
    <a href="agregar.php">Nueva entrada</a>
    <br>
    <br>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nombre</th>
                <th>No. Control</th>
                <th>Palabra Modificada</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                while($filas = mysqli_fetch_assoc($resultado)){
            
            ?>
            <tr>
                <td> <?php echo $filas['id'] ?></td>
                <td><?php echo $filas['nombre'] ?></td>
                <td><?php echo $filas['nocontrol'] ?></td>
                <td><?php echo $filas['modificado'] ?></td>
                <td>
<?php echo "<a href='editar.php?id=".$filas['id']."'>EDITAR</a>"; ?>
                    -
<?php echo "<a href='eliminar.php?id=".$filas['id']."' onclick='return confirmar()'>ELIMINAR</a>"; ?>
                </td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <?php
        mysqli_close($conexion);
    ?>
</body>
</html>