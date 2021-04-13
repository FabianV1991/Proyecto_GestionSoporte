<?php
include("perfil.php");


if(isset($_POST['submit']))
{
 
$rec_nombre = $_POST['nombre'];
$rec_ape= $_POST['ape'];
$rec_user= $_POST['user'];
$rec_mail= $_POST['mail'];
$rec_rut= $_POST['rut'];
$rec_area= $_POST['area'];
$rec_imagen= $_POST['imagen'];

$path_imagen="img/soporte/";
$imagen="$path_imagen$rec_imagen";

$query_insert_recurso="insert into tbl_recursos (img,Nombre,Apellido,user,mail,rut,equipo) values ('$imagen','$rec_nombre','$rec_ape','$rec_user','$rec_mail','$rec_rut',$rec_area)";
consulta_gestion($query_insert_recurso);

}

if(isset($_POST['submit2']))
{ 
  $id = $_POST['id'];
  $user = $_POST['user'];
  $mail = $_POST['mail'];
  $area = $_POST['area'];
;

  #echo "insertando datos $id - $user - $mail - $area";
  #echo "<br>";
  #echo "update tbl_recursos set user='$user',mail='$mail',equipo='$area' where id =$id;";
  $modifica_recurso= "update tbl_recursos set user='$user',mail='$mail',equipo='$area' where id =$id;";
  consulta_gestion($modifica_recurso);

}

if(isset($_POST['submit3']))
{
  $id = $_POST['id'];

  $elimina_recurso = "delete from tbl_recursos where id='$id';";
  consulta_gestion($elimina_recurso);
}



?>
<center><h2>Listado de recursos disponibles</h2></center>

       <i class="fa fa-shopping-cart"></i>
       <span>Total Recursos:</span>
       <span class="badge badge-pill badge-warning">
       	<?php
       		$total_recursos=consulta_gestion($sql_total_recursos);

       		while ($row=mysqli_fetch_array($total_recursos))
       		{
       		$total = $row[0];
       		}
       		echo "$total </span><br>" ;

       		$desglose_recursos=consulta_gestion($sql_total_por_area);

       		while ($row=mysqli_fetch_array($desglose_recursos))
       		{
       		$Nombre1 = $row[0];
       		$total1= $row[1];
       		
       		echo "$Nombre1: ";
       		echo "<span class='badge badge-pill badge-primary'>$total1 </span><br>";
       		}
       	?>


              

  <div class="col-xs-6 text-center">
    <br><br>
        <!--el id example se utiliza para paginar la tabla -->

    <table class="table table-striped table-bordered" id="" >
      <thead>

        <tr role="row" class="thead-dark" >
          <th scope="col" >Img</th>
          <th scope="col" >Nombre</th>
          <th scope="col" >User</th>
          <th scope="col" >Mail</th>
          <th scope="col" >Rut</th>
          <th scope="col" >Equipo</th>
        </tr>
      </thead>
      <?php

      while ($row=mysqli_fetch_array($sql_recursos)){
              $img = $row[0];
              $nombre = $row[1];
              $apellido = $row[2];
              $user =  $row[3];
              $mail = $row[4];
              $rut = $row[5];
              $equipo = $row[6];

              echo "<tr>";
              echo "<td><img class=img-responsive img-rounded src=$img width=50 height=50/> </td> \n";
              echo "<td>$nombre $apellido </td> \n";
              echo "<td>$user </td> \n";
              echo "<td>$mail </td> \n";
              echo "<td>$rut</td> \n";
              echo "<td>$equipo </td> \n";
              
            }
      ?>
    </table>




   <!-- MENU PARA ADMINISTRADOR-->  

  </div>
  <?php
if ($tipo_user == 0)
  echo '<button type="button" class="btn btn-info" id="myBtn">Agregar</button>
  <button type="button" class="btn btn-info" id="myBtn2">Modificar</button>
  <button type="button" class="btn btn-info" id="myBtn3">Eliminar</button>'
  ?>



<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
     <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>   
        </div>
        <div class="modal-body">
			<?php
    ##para que el se envie el formulario a la misma pagina actual
    echo '<form method="post" action=' . $_SERVER["PHP_SELF"] . ' > '
    ?>
			  <fieldset>
			    <legend>Agregar Nuevo Recurso</legend>
			
			    <div class="form-group">
			      <label>Nombre</label>
			      <input type="Text" class="form-control" id="nombre" name="nombre">
			    </div>
			
			    <div class="form-group">
			      <label>Apellido</label>
			      <input type="text" class="form-control" id="ape" name="ape">
			    </div>
			
			    <div class="form-group">
			      <label>Ususario</label>
			      <input type="text" class="form-control" id="user" name="user">
			    </div>
			
			    <div class="form-group">
			      <label>E-Mail</label>
			      <input type="text" class="form-control" id="mail" name="mail">
			    </div>
			
			    <div class="form-group">
			      <label>Rut</label>
			      <input type="text" class="form-control" id="rut" name="rut">
			    </div>			
			    <div class="form-group">
			      <label>Area</label>
			      <select class="form-control" id="area" name="area">
			        <option></option>
			        <option value="1">Operadores</option>
			        <option value="2">Administradores</option>
			        <option value="3">Controladores</option>
			      </select>
			    </div>
          <div class="form-group">
            <label>Imagen</label>          
          <input name="imagen" type="file" class="form-control"/>
        </div>


			    <?php
        echo ' <button type="submit" class="btn btn-primary" value=submit name="submit" >Guardar</button>'
        ?>
				</fieldset>
			</form>
		</div>
		<div class="modal-footer">
		    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	    </div>
     </div>			      
   </div>
 </div>  
</div>

<!-- fin modal-->



<!-- Modal modificar -->
  <div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
          <!-- formulario -->
          <?php
            ##para que el se envie el formulario a la misma pagina actual
            echo '<form method="post" action=' . $_SERVER["PHP_SELF"] . ' > '
          ?>
          <fieldset>
           <legend>Modificar Recurso</legend>  
           <div class="form-group">
             <label>Recursos</label>
             <select class="form-control" id="id" name="id" >
               <option></option>
               <?php
                 $sql=consulta_gestion($consulta_recursos_list);
                  while ($row=mysqli_fetch_array($sql)){
                   echo "<option value='$row[0]' > $row[1] $row[2]</option>";
                  }
               ?>
             </select>
           </div>

           <div class="form-group">
             <label>User</label>
             <input type="text" class="form-control" id="user" name="user">
           </div>

           <div class="form-group">
             <label>E-Mail</label>
             <input type="text" class="form-control" id="mail" name="mail">
           </div>

           <div class="form-group">
            <label>Area</label>
            <select class="form-control" id="area" name="area">
              <option></option>
              <option value="1">Operadores</option>
              <option value="2">Administradores</option>
              <option value="3">Controladores</option>
            </select>
          </div>

           
     
           <br><br>
    
          <?php
            echo ' <button type="submit" class="btn btn-primary" name="submit2" >Guardar</button>'
          ?>

            </fieldset>

          </form>

          <!-- fin formulario -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>

<!-- fin modale modificar -->

<!-- Modal eliminar -->
  <div class="modal fade" id="myModal3" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
          <!-- formulario -->
          <?php
            ##para que el se envie el formulario a la misma pagina actual
            echo '<form method="post" action=' . $_SERVER["PHP_SELF"] . ' > '
          ?>
          <fieldset>
           <legend>Eliminar Recurso</legend>  
           <div class="form-group">
             <label>Recursos</label>
             <select class="form-control" id="id" name="id" >
               <option></option>
               <?php
                 $sql=consulta_gestion($consulta_recursos_list);
                  while ($row=mysqli_fetch_array($sql)){
                   echo "<option value='$row[0]' > $row[1] $row[2]</option>";
                  }
               ?>
             </select>
           </div>
           <br><br>
    
          <?php
            echo ' <button type="submit" class="btn btn-primary" name="submit3" >Guardar</button>'
          ?>

            </fieldset>

          </form>

          <!-- fin formulario -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>

<!-- fin modal eliminar -->



<script>
$(document).ready(function(){
  $("#myBtn").click(function(){
    $("#myModal").modal();
  });
});
</script>

<script>
$(document).ready(function(){
  $("#myBtn2").click(function(){
    $("#myModal2").modal();
  });
});
</script>

<script>
$(document).ready(function(){
  $("#myBtn3").click(function(){
    $("#myModal3").modal();
  });
});
</script>

