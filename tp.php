<?php
include("perfil.php");

if(isset($_POST['submit']))
{
 
$comentario = $_POST['name'];
$numero_tp = $_POST['tp'];
 
$comentario_final ="[$user] : $comentario";

$inserta_comentario_tp="insert into tbl_coment_psg values ($numero_tp,'$comentario_final')";
consulta_gestion($inserta_comentario_tp);
}



?>
<!-- para refrescar la pagina 180 seg = 3 minutos-->
  <meta http-equiv="Refresh" content="180;url=http://localhost/PROYECTO/tp.php">
  
  <div class="col-xs-6 text-center">
    <br>  
    <h2>ESTADOS DE TRABAJOS PROGRAMADOS ASIGNADOS</h2>
    <br><br>

    <span class="badge badge-secondary">POSPUESTO</span>
    <span class="badge badge-success">EJECUTADO</span>
    <span class="badge badge-danger">REVERSADO</span>
    <span class="badge badge-warning">EN EJECUCION</span>
    <span class="badge badge-info">PLANIFICADO</span>
    <br><br><br>

      <!--el id example se utiliza para paginar la tabla -->
      <table class="table table-hover" id="">
        <thead>
          <tr class="thead-dark">
            <th scope="col">TP</th>
            <th scope="col">RPN</th>
            <th scope="col">Fecha</th>
            <th scope="col">ROL</th>
            <th scope="col">Titulo</th>
            <th scope="col">Plataforma</th>
            <th scope="col">Comentario</th>
          </tr>
        </thead>
                <?php
                $result_psg=consulta_tp($query_tp);
                  while ($row=mysqli_fetch_array($result_psg))
                  {
                    $tp=$row[0];
                    $fecha=$row[1];
                    $hora=$row[2];
                    $exec=$row[3];
                    $titulo=utf8_encode($row[4]);
                    $servicio=$row[5];
                    $asignado=strtoupper($row[6]);
                    $rol=$row[7];
                    $estado=$row[8];
                    $rpn=$row[9];
                    echo "<tr class=\"table-active\" id = '$row[0]' >";
                    if ($estado == "EJECUTADO"){
                      $boton='<button type="button" class="btn btn-success">' . $row[0] . '</button>';
                    }elseif($estado == 'EN EJECUCION'){
                      $boton='<button type="button" class="btn btn-warning">' . $row[0] . '</button>';
                    }elseif($estado == 'PLANIFICADO'){
                      $boton='<button type="button" class="btn btn-info">' . $row[0] . '</button>';
                    }elseif($estado == 'REVERSADO'){
                      $boton='<button type="button" class="btn btn-danger">' . $row[0] . '</button>';
                    }elseif($estado == 'POSPUESTO'){
                      $boton='<button type="button" class="btn btn-secondary">' . $row[0] . '</button>';
                    }
  
  
  
                    echo "<td><a href='http://172.29.64.101/tp/ver_planned.php?id=$tp' target='_blank'>$boton</td>"; #NUMERO DE TP
                    echo "<td>$rpn </td>"; #RPM
                    echo "<td>$fecha <br> $hora </td>"; #Fecha de ejecucion
                    echo "<td>$rol </td>"; #ROL
                    echo "<td align='left'    >$titulo </td>"; #TITULO
                    echo "<td>$servicio </td>"; #SERVICIO
                    echo "<td>";
                    $sql=consulta_gestion("select * from tbl_coment_psg where numero_tp=$tp");
                    $resp = $sql->num_rows;
                    if ($resp == 0){
                      echo "<button type='button' class='btn' data-toggle='modal' data-target='#myModal'>Agregar comentarios</button></td>"; #Comentario
                    }else{
                      while ($row=mysqli_fetch_array($sql))
                      {
                        $comentario_tp=$row[1];
                        echo '<div class="card border-secondary mb-3" style="max-width: 20rem;">
                                <div class="card-body">
                                  <p class="card-text">' . $comentario_tp. '</p>
                                </div>
                              </div>';
                      }
                    }

                    echo '<div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <b
                                    <h4 class="modal-title">TP  '.$tp .'</h4>
                                </div>
                              <div class="modal-body">
                                
                                <!--ENVIO COMENTARIO PARA AGREGARLO a LA BD -->

                                <form method="post" action=' . $_SERVER["PHP_SELF"] . ' >                              
                                  <div class="form-group">
                                    <label>Agregar Comentarios</label>
                                    <textarea class="form-control" id="comentario" rows="3" name="name"></textarea>
                                    <input type="hidden" name="tp" value="'.$tp.'"/>
                                  </div>
                                  <button type="submit" class="btn btn-primary" value=submit name="submit" >Guardar</button>
                                </form>

                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                              
                            </div>
                          </div>
                          
                        </div>';

                  }   
                
                ?>
      </table>
    </div>


