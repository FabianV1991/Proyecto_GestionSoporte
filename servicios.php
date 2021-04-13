<?php
include("perfil.php");

if(isset($_POST['submit']))
{ 

  $plat = $_POST['plat'];
  $area = $_POST['area'];
  
  $criti = $_POST['criti'];
  $modelo = $_POST['modelo'];
  $nota = $_POST['nota'];
  $fechat = $_POST['fechat'];

  #echo "insertando datos $plat - $area - $area - $criti - $modelo - $nota - $fechat";
  #echo "<br>";
  #echo "insert into tbl_servicios (plataforma,area,contraparte,criticidad,modelo,nota,fecha_tope) values ('$plat','$area','$area','$criti','$modelo','$nota','$fechat');";
  $inser_plataforma = "insert into tbl_servicios (plataforma,area,contraparte,criticidad,modelo,nota,fecha_tope) values ('$plat','$area','$area','$criti','$modelo','$nota','$fechat');";
  consulta_gestion($inser_plataforma);


}

if(isset($_POST['submit2']))
{ 
  $id = $_POST['id'];
  $area = $_POST['area'];
  $criti = $_POST['criti'];
  $modelo = $_POST['modelo'];
  $nota = $_POST['nota'];
  $fechat = $_POST['fechat'];

  #echo "insertando datos $id - $area - $area - $criti - $modelo - $nota - $fechat";
  #echo "<br>";
  #echo "update tbl_servicios set area='$area', contraparte='$area', criticidad='$criti', modelo='$modelo', nota='$nota', fecha_tope='$fechat' where id =$id;";
  $modifica_servicio = "update tbl_servicios set area='$area', contraparte='$area', criticidad='$criti', modelo='$modelo', nota='$nota', fecha_tope='$fechat' where id =$id;";
  consulta_gestion($modifica_servicio);
}


if(isset($_POST['submit3']))
{
  $id = $_POST['id'];

  #echo "$id ";
  #echo "<br>";
  #echo "delete from tbl_credenciales where id='$id';";
  $elimina_credencial = "delete from tbl_servicios where id='$id';";
  consulta_gestion($elimina_credencial);
}

?>


<meta charset="UTF-8">

<center>
  <h2>Servicios Contratado</h2>
  <br><br>
  <?php
if ($tipo_user == 0)
  
      echo '<button type="button" class="btn btn-info" id="myBtn">Agregar Servicio</button>
      <button type="button" class="btn btn-info" id="myBtn2">Modificar Servicio</button>
      <button type="button" class="btn btn-info" id="myBtn3">Eliminar Servicio</button>
      <br><br>
      ';?>
      
</center>


<div class="row d-flex justify-content-center">
  <div class="col-xs-6 text-center">
    <br><br>
        <!--el id example se utiliza para paginar la tabla -->
    <table class="table table-hover" id="example">
      <thead>
        <tr role="row" class="thead-dark" >
          <th scope="col" >Plataforma</th>
          <th scope="col" >Area</th>
          <th scope="col" >Contraparte</th>
          <th scope="col" >Criticidad</th>
          <th scope="col" >Modelo soporte</th>
          <th scope="col" >Nota</th>
          <th scope="col" >Fecha Tope</th>
        </tr>
      </thead>
      <?php
      $sql=consulta_gestion($consulta_servicios);
      while ($row=mysqli_fetch_array($sql)){
              $plataforma = utf8_encode($row[1]);
              $area = $row[2];
              $conrtraparte = $row[3];
              $criticidad =  $row[4];
              $modelo = $row[5];
              $nota = $row[6];
              $fecha = $row[7];

              echo "<tr class=\"warning\" id = '$row[0]' > \n";
              echo "<td>$plataforma </td> \n";
              echo "<td>$area </td> \n";
              echo "<td>$conrtraparte </td> \n";
              echo "<td>$criticidad </td> \n";
              echo "<td>$modelo</td> \n";
              echo "<td>$nota </td> \n";
              echo "<td>$fecha</td> \n";
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
    <legend>Agregar Nueva Plataforma</legend>

    <div class="form-group">
      <label>Plataforma</label>
      <input type="Text" class="form-control" id="plat" name="plat">
    </div>

    <div class="form-group">
      <label>Area</label>
      <select class="form-control" id="area" name="area">
        <option></option>
        <option value='1'>VAS</option>
        <option value='2'>PP</option>
        <option value='3'>Plataformas</option>
      </select>
    </div>

    

    <div class="form-group">
      <label>Criticidad</label>
      <select class="form-control" id="criti" name="criti">
        <option></option>
        <option value='1'>Baja</option>
        <option value='2'>Media</option>
        <option value='3'>Alta</option>
      </select>
    </div>

    <div class="form-group">
      <label>Modelo Soporte</label>
      <select class="form-control" id="modelo" name="modelo">
        <option></option>
        <option value='1'>Eliminado</option>
        <option value='2'>5X8</option>
        <option value='3'>7X24</option>
        <option value='4'>OnDemand</option>
      </select>
    </div>

    <div class="form-group">
      <label>Nota</label>
      <input type="textarea" class="form-control" id="nota" name="nota">
    </div>

    <div class="form-group">
      <label>Fecha Tope (AAAA-MM-DD)</label>
      <input type="text" class="form-control" id="fechat" name="fechat">
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

 <!-- Fin Modal -->


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
           <legend>Modificar Servicio</legend>  
           <div class="form-group">
             <label>Servidor</label>
             <select class="form-control" id="id" name="id" >
               <option></option>
               <?php
                 $sql=consulta_gestion($consulta_servicios_list);
                  while ($row=mysqli_fetch_array($sql)){
                   echo "<option value='$row[0]' > $row[1]</option>";
                  }
               ?>
             </select>
           </div>

           <div class="form-group">
             <label>Area</label>
             <select class="form-control" id="area" name="area">
               <option></option>
               <option value='1'>VAS</option>
               <option value='2'>PP</option>
               <option value='3'>Plataformas</option>
             </select>
           </div>

           

           <div class="form-group">
             <label>Criticidad</label>
             <select class="form-control" id="criti" name="criti">
               <option></option>
               <option value='1'>Baja</option>
               <option value='2'>Media</option>
               <option value='3'>Alta</option>
             </select>
           </div>

           <div class="form-group">
             <label>Modelo Soporte</label>
             <select class="form-control" id="modelo" name="modelo">
               <option></option>
               <option value='1'>Eliminado</option>
               <option value='2'>5X8</option>
               <option value='3'>7X24</option>
               <option value='4'>OnDemand</option>
             </select>
           </div>
           <div class="form-group">
             <label>Nota</label>
             <input type="textarea" class="form-control" id="nota" name="nota">
           </div>

           <div class="form-group">
             <label>Fecha Tope (AAAA-MM-DD)</label>
             <input type="text" class="form-control" id="fechat" name="fechat">
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
                 $sql=consulta_gestion($consulta_servicios_list);
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


