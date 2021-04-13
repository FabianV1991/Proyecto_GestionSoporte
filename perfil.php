<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
{
  $user=$_SESSION['username'];
  $tipo_user=$_SESSION['tipo'];

}else{
  header("Location: index.php");
}





?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="./js/bootstrap.min.js" />
    <link rel="stylesheet" type="text/css" href="./css/lateral.css" />
    
    


  <title>Gestion Soporte</title>
</head>
<body>
  <!-- Agrego el div fixed-top para que la barra de menu quede fija =)-->
<body>
<div class="page-wrapper chiller-theme toggled">
  <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
    <i class="fas fa-bars"></i>
  </a>
  <nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
      <div class="sidebar-brand">
        <a href="#">Gestion Soporte</a>
        <div id="close-sidebar">
          <i class="fas fa-times"></i>
        </div>
      </div>


      <!-- DATOS DE KAYAKO-->

      <?php
        include("funciones.php");
        include("querys.php");
        $row=mysqli_fetch_array($sql_usuarios_kayako);
        $nombre=$row[0];
        $apellido=$row[1];
        $mail=$row[2];; 
        $rut=$row[3];;
        $id_cargo=$row[4];; 
        $id_movil=$row[5];; 
        $path_img=$row[6];;
        $id=$row[7];; 
        $movil=$row[8];; 
        $cargo=$row[9];; 
        $id=$row[10];;
      ?>




      <div class="sidebar-header">
        <div class="user-pic">
          <img class="img-responsive img-rounded" src="<?php echo $path_img; ?>"
            alt="User picture">
        </div>
        <div class="user-info">
          <span class="user-name">
            <strong><?php echo "$nombre $apellido"; ?></strong><br>
            <span>Perfil :
            <?php
              if ($tipo_user == 0)
                echo "admin";
              else
                echo "usuario";
            ?>
          </span>


          </span>
          <span class="user-role"><?php echo $cargo; ?></span>
          <span class="user-status">
            <i class="fa fa-circle"></i>
            
          </span>
        </div>
      </div>


      <!-- Menu Principal  -->
      <div class="sidebar-menu">
        <ul>
          <li class="header-menu">
            <span>General</span>
          </li>
          
          <li class="sidebar-dropdown">
            <a href="usuario.php">
              <i class="fa fa-tachometer-alt"></i>
              <span>Inicio</span>
            </a>
          </li>
          <li class="sidebar-dropdown">
            <a href="turnos.php">
              <i class="fa fa-tachometer-alt"></i>
              <span>Turnos</span>
            </a>
          </li>
          <li class="sidebar-dropdown">
            <a href="credenciales.php">
              <i class="fa fa-tachometer-alt"></i>
              <span>Credenciales</span>
            </a>
          </li>
          <li class="sidebar-dropdown">
            <a href="tp.php">
              <i class="fa fa-tachometer-alt"></i>
              <span>Trabajos Programados</span>
            </a>
          </li>
          <li class="sidebar-dropdown">
            <a href="servicios.php">
              <i class="fa fa-tachometer-alt"></i>
              <span>Servicios</span>
            </a>
          </li>
          <li class="sidebar-dropdown">
            <a href="recursos.php">
              <i class="fa fa-tachometer-alt"></i>
              <span>Recursos</span>
            </a>
          </li>       
    </div>
    <div class="sidebar-footer">
      <a href="index.php">
        <i class="fa fa-power-off"> SALIR</i>
      </a>

    </div>
  </nav>


<!-- page-wrapper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    
        <!-- js para paginacion de tabla -->
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap4.min.js"></script>

<!--centrar contenido -->
<main class="page-content">
    <div class="container-fluid">
<!-- fin centrar-->
      <script>
        $(document).ready(function() {
         $('#example').DataTable({
            "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
               }
           });
         });
      </script>
