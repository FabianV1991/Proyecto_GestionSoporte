<?php
include("perfil.php");

if(isset($_POST['submit']))
{ 

  $server = $_POST['server'];
  $host = $_POST['host'];
  $ip = $_POST['ip'];
  $user = $_POST['user'];
  $pass = $_POST['pass'];
  $area = $_POST['area'];
  #echo "insertando datos $server - $host - $ip - $user - $pass - $area";
  #echo "<br>";
  #echo "insert into tbl_credenciales (servidor,hostname,ip,usuario_ssh,pass_ssh,area) values ('$server','$host','$ip','$user','$pass','$area');";
  $insert_credencial = "insert into tbl_credenciales (servidor,hostname,ip,usuario_ssh,pass_ssh,area) values ('$server','$host','$ip','$user','$pass','$area');";
  consulta_gestion($insert_credencial);

}

if(isset($_POST['submit2']))
{
  $id = $_POST['id'];
  $user = $_POST['user'];
  $pass = $_POST['pass'];

  #echo "$id - $user - $pass";
  #echo "<br>";
  #echo "update tbl_credenciales set usuario_ssh='$user', pass_ssh='$pass' where id='$id';";
  $update_credencial = "update tbl_credenciales set usuario_ssh='$user', pass_ssh='$pass' where id='$id';";
  consulta_gestion($update_credencial);
}

if(isset($_POST['submit3']))
{
  $id = $_POST['id'];

  #echo "$id ";
  #echo "<br>";
  #echo "delete from tbl_credenciales where id='$id';";
  $elimina_credencial = "delete from tbl_credenciales where id='$id';";
  consulta_gestion($elimina_credencial);
}




?>
<center>
  <h2>Credenciales de Servicios</h2>
</center>

<div class="row d-flex justify-content-center">
	<div class="col-xs-6 text-center">

		<!--  Se utiliza clase Jumbotron para contener la tabla  -->
		
			<!--el id example se utiliza para paginar la tabla -->
       <br><br>
      <button type="button" class="btn btn-info" id="myBtn">Agregar Nuevas Credenciales</button>
      <button type="button" class="btn btn-info" id="myBtn2">Modificar Credenciales</button>
      <button type="button" class="btn btn-info" id="myBtn3">Eliminar Credenciales</button>
      <br><br>

      
			<table id="example" class="table table-striped table-bordered" >
			  <thead>
          

			    <tr class="thead-dark">
			      <th scope="col">Servidor</th>
			      <th scope="col">Hostname</th>
			      <th scope="col">IP</th>
			      <th scope="col">Usuario SSH</th>
			      <th scope="col">Contrase&ntilde;a SSH</th>
			      <th scope="col">Area</th>
			    </tr>
			  </thead>
			          <?php
			            while ($row=mysqli_fetch_array($sql_credenciales)){
			              	echo "<tr class=\"\" id = '$row[0]' > \n";
			              	echo "<td>$row[1] </td> \n"; # servidor nombre
			              	echo "<td>$row[2] </td> \n"; # Hostname
			              	echo "<td>$row[3] </td> \n"; # IP
			             	echo "<td>$row[4] </td> \n"; # usuario
	        		     	echo "<td>$row[5] </td> \n"; # contraseña
	             			echo "<td>$row[6] </td> \n"; # area
	       				  } 
			          ?>
			</table>
	</div>
</div>




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
    <legend>Agregar Nuevo Servidor</legend>

    <div class="form-group">
      <label>Nombre Servidor</label>
      <input type="Text" class="form-control" id="server" name="server">
    </div>

    <div class="form-group">
      <label>HostName</label>
      <input type="text" class="form-control" id="host" name="host">
    </div>

    <div class="form-group">
      <label>IP</label>
      <input type="text" class="form-control" id="ip" name="ip">
    </div>

    <div class="form-group">
      <label>user</label>
      <input type="text" class="form-control" id="user" name="user">
    </div>

    <div class="form-group">
      <label>password</label>
      <input type="text" class="form-control" id="pass" name="pass">
    </div>

    <div class="form-group">
      <label>Area</label>
      <select class="form-control" id="area" name="area">
        <option></option>
        <option>Prepago</option>
        <option>VAS</option>
        <option>O&M</option>
      </select>
    </div>
    <?php
        echo ' <button type="submit" class="btn btn-primary" name="submit" >Guardar</button>'
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
           <legend>Modificar Credenciales</legend>  
           <div class="form-group">
             <label>Servidor</label>
             <select class="form-control" id="id" name="id" >
               <option></option>
               <?php
                 $sql=consulta_gestion($consulta_credencial_list);
                  while ($row=mysqli_fetch_array($sql)){
                   echo "<option value='$row[0]' > $row[1]</option>";
                  }
               ?>
             </select>
           </div>

           <div>
            <label>Usuario</label>
            <input type="text" class="form-control" id="user" name="user">
           </div>

           <div>
            <label>Contraseña</label>
             <input type="text" class="form-control" id="pass" name="pass">
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
           <legend>Eliminar Credenciales</legend>  
           <div class="form-group">
             <label>Servidor</label>
             <select class="form-control" id="id" name="id" >
               <option></option>
               <?php
                 $sql=consulta_gestion($consulta_credencial_list);
                  while ($row=mysqli_fetch_array($sql)){
                   echo "<option value='$row[0]' > $row[1]</option>";
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




</body>
</html>
