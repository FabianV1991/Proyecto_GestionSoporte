<?php
include("perfil.php");




if(isset($_POST['submit']))
{
 
$id_recurso = $_POST['recurso'];
$id_turno= $_POST['turno'];
$fecha_turno= $_POST['semanita'];
$dia_turno=substr($fecha_turno,3,2);
$mes_turno=substr($fecha_turno,0,2);
$año_turno=substr($fecha_turno,6,4);

$semana_turno = date('W',  mktime(0,0,0,$mes_turno,$dia_turno,$año_turno));  


$insert_turno="insert into tbl_turno values ('$id_recurso','$id_turno','$semana_turno');";
consulta_gestion($insert_turno);
}

if(isset($_POST['submit2']))
{
  $id_recurso = $_POST['recurso'];
  $id_turno= $_POST['turno'];
  echo "update from tbl_turno set id_turno='$id_turno' where id_recurso=$id_recurso";
  $modifica_turno="update  tbl_turno set id_turno='$id_turno' where id_recurso=$id_recurso;";
  consulta_gestion($modifica_turno);

}

if(isset($_POST['submit3']))
{
  $id_recurso = $_POST['recurso'];
  $elimina_turno="delete from tbl_turno where id_recurso=$id_recurso";
  consulta_gestion($elimina_turno);


}


?>
   


<center><h2>Turnos Semana  <?php echo "$semana"?> </h2></center>
<br><br>
<table id="" class="table table-striped table-bordered" >
  <thead>
    <tr class="thead-dark">
      <th scope="col">Equipo</th>
      <th scope="col">Nombre</th>
      <th scope="col">Turno</th>
      <th scope="col">L</th>
      <th scope="col">M</th>
      <th scope="col">X</th>
      <th scope="col">J</th>
      <th scope="col">V</th>
      <th scope="col">S</th>
      <th scope="col">D</th>
    </tr>
  </thead>


 <?php
 	$sql=consulta_gestion($consulta_turno);
    while ($row=mysqli_fetch_array($sql)){
      	echo "<tr>";
      	echo "<td>$row[0] </td> \n"; # equipo
      	echo "<td>$row[1] $row[2] </td> \n"; # nombre
      	echo "<td>$row[3]</td> \n"; # turno

      	if ( $row[4] == 5 && $row[3] == "Noche")
      	{	
      		echo "<td>00:00 - 09:00</td>";
      		echo "<td>00:00 - 09:00</td>";
      		echo "<td>00:00 - 09:00</td>";
      		echo "<td>00:00 - 09:00</td>";
      		echo "<td>00:00 - 09:00</td>";
      		echo "<td>X</td>";
      		echo "<td>X</td>";
      	}
      	elseif ($row[4] == 5 && $row[3] == "Dia")
      	{
      		echo "<td>09:00 - 19:00</td>";
      		echo "<td>09:00 - 19:00</td>";
      		echo "<td>09:00 - 19:00</td>";
      		echo "<td>09:00 - 19:00</td>";
      		echo "<td>09:00 - 19:00</td>";
      		echo "<td>X</td>";
      		echo "<td>X</td>";
      	}else
      	{
      		echo "<td>19:00 - 00:00</td>";
      		echo "<td>19:00 - 00:00</td>";
      		echo "<td>19:00 - 00:00</td>";
      		echo "<td>19:00 - 00:00</td>";
      		echo "<td>19:00 - 00:00</td>";
      		echo "<td>00:00 - 23:59</td>";
      		echo "<td>00:00 - 23:59</td>";

      	}

	  } 
  ?>




</table>


<?php
if ($tipo_user == 0)
echo '<button type="button" class="btn btn-info" id="myBtn">Agregar Turno</button>
<button type="button" class="btn btn-info" id="myBtn2">Modificar Turno</button>
<button type="button" class="btn btn-info" id="myBtn3">Eliminar Turno</button>'

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
		    <legend>Agregar Turno</legend>	
		    <div class="form-group">
		      <label>Recurso</label>
		      <select class="form-control" id="recurso" name="recurso">
		      	<option></option>
		      	<?php
		      		$sql=consulta_gestion($consulta_recursos);
		      		 while ($row=mysqli_fetch_array($sql)){
		      		 	echo "<option value='$row[2]' > $row[0] $row[1]</option>";
		      		 }
		      	?>
          
		      </select>
		    </div>

		    <div>
		      <label>Turno</label>
		      <select class="form-control" id="turno" name="turno">
		      	<option value=''></option>
		      	<option value='1'>Dia</option>
       			<option value='2'>Noche</option>
      			<option value='3'>Tarde y Fin de semana</option>
		      </select>
		    </div>


			<div>
				<br><br>
				<!-- para el calendario se agrega codigo bosstrap -->
		    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
			    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
			    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
				<!-- fin boostrap calendario -->
				
				<input id="datepicker" width="276" name="semanita"/>
			    <script>
			        $('#datepicker').datepicker({
			            uiLibrary: 'bootstrap4'
			        });
			    </script>
			</div>

			<br><br>
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


<!-- Modificar Eliminar -->
  <div class="modal fade" id="myModal2" role="dialog">
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
        <legend>Agregar Turno</legend>  
        <div class="form-group">
          <label>Recurso</label>
          <select class="form-control" id="recurso" name="recurso">
            <option></option>
            <?php
              $sql=consulta_gestion($consulta_recursos);
               while ($row=mysqli_fetch_array($sql)){
                echo "<option value='$row[2]' > $row[0] $row[1]</option>";
               }
            ?>
          
          </select>
        </div>

        <div>
          <label>Turno</label>
          <select class="form-control" id="turno" name="turno">
            <option value=''></option>
            <option value='1'>Dia</option>
            <option value='2'>Noche</option>
            <option value='3'>Tarde y Fin de semana</option>
          </select>
        </div>

      <br><br>
      <?php
        echo ' <button type="submit" class="btn btn-primary" value=submit2 name="submit2" >Guardar</button>'
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
<!-- Fin modificar Eliminar -->




<!-- Modal Eliminar -->
  <div class="modal fade" id="myModal3" role="dialog">
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
        <legend>Agregar Turno</legend>  
        <div class="form-group">
          <label>Recurso</label>
          <select class="form-control" id="recurso" name="recurso">
            <option></option>
            <?php
              $sql=consulta_gestion($consulta_recursos);
               while ($row=mysqli_fetch_array($sql)){
                echo "<option value='$row[2]' > $row[0] $row[1]</option>";
               }
            ?>
          
          </select>
        </div>
      <br><br>
      <?php
        echo ' <button type="submit" class="btn btn-primary" value=submit3 name="submit3" >Guardar</button>'
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
<!-- Fin Modal Eliminar -->












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