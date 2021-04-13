<?php
include("funciones.php");
$user=$_REQUEST['user'];
$pass=$_REQUEST['pass'];


$resultado=consulta_gestion("SELECT * FROM soporte.TBL_USER WHERE usuario='$user' AND contrasena=MD5('$pass')");


#Ejecuto query
#$resultado = $conexion->query($sql);
#consulto si el resultado de la query tiene datos (1 si / 0 no)
$resp = $resultado->num_rows;
$row=mysqli_fetch_array($resultado);

if ($resp == 0){
    echo "Login Incorrecto";
    echo "<script>
                alert('Contraseña Incorrecta');
                window.location= 'index.php'
    </script>";


    #header("Location: index.php");
    }else{
    echo "Login OK - perfil $row[3]";
    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $user;
    $_SESSION['ACCESO'] = "SI";
    $_SESSION['tipo'] = $row[3]; 

    header("Location: usuario.php");       

    }

?>