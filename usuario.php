<?php
include("perfil.php");


?>
<div >

        <table class="table table-hover">
            <tr>
                <td align="center">
                    <div class="card mb-3" style="max-width: 30rem;">
                        <h3 class="card-header"><?php echo "$nombre $apellido"; ?></h3><br> 
                        <img style="height: 30; width: 35%; display: block;" src="<?php echo $path_img; ?>" alt="">                            
                        <div class="card-body">
                          <h5 class="card-title"><?php echo $cargo; ?></h5>
                        </div>
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item">RUT: <?php echo $rut; ?></li>
                          <li class="list-group-item">FONO: <?php echo $movil; ?></li>
                          <li class="list-group-item">MAIL: <?php echo $mail; ?></li>
                        </ul>
                        <div class="card-footer text-muted">
                           Usuario: <?php echo "$user"; ?>
                        </div>
                    </div>
                </td>
                <td valign="top">

                    <div class="card border-secondary mb-3" style="max-width: 50rem;">
                        <?php 
                        #se consulta los ticket a kayako con nombre y apellido
                        $user_ticket="$nombre $apellido";
                            $tickets=ticket_cant_kayako($user_ticket);
                        ?>

                      <div class="card-header">Kayako</div>
                      <div class="card-body">
                        <h4 class="card-title">Estado de Ticket</h4>
                        
                            En progreso <?php echo "$tickets[progreso]"?>
                            <div class="progress">
                              <div class="progress-bar" role="progressbar" style="width: <?php echo ticket_kayako_porcentaje($tickets["progreso"],$tickets["total"]); ?>;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                            Panificado <?php echo "$tickets[planificado]"?>
                            <div class="progress">
                              <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo ticket_kayako_porcentaje($tickets["planificado"],$tickets["total"]); ?>;" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                            En Espera <?php echo "$tickets[espera]"?>
                            <div class="progress">
                              <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo ticket_kayako_porcentaje($tickets["espera"],$tickets["total"]); ?>;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                            Abiertos <?php echo "$tickets[abierto]"?>
                            <div class="progress">
                              <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo ticket_kayako_porcentaje($tickets["abierto"],$tickets["total"]); ?>;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                        </p>
                      </div>
                    </div>

                 <div class="card border-warning mb-3" style="max-width: 50rem;">
                      <div class="card-header">Kayako</div>
                      <div class="card-body">
                        <h4 class="card-title">Mis Ticket Sin Servicio</h4>
                        <p class="card-text"> 

                <span class="line"></span>
                    </h5>
                        <dl>
                          <?php
                          $resp =$user_ticket;
                          $consulta_tickets = getSinServicio($resp);
                          if (mysqli_num_rows($consulta_tickets) == 0 )  {
                          ?>
                            <dt>No registra Tickes sin servicio </dt>
                          <?php
                          }else{
                           ?>
                            <table class="table table-bordered table-condensed table-hover table-striped" >
                             <thead>
                               <tr>
                                <th>Ticket ID</th>
                                 <th>Titulo</th>
                                  <th>Fecha</th>
                                  <th>Estado</th>
                                  <th>Tipo</th>
                               </tr>
                             </thead>
                             <tbody>
                              <?php
                               while ($row = mysqli_fetch_array($consulta_tickets)) {
                                 $id =           $row[0];
                                 $ticket =       $row[1];
                                 $titulo =       $row[2];
                                 $fecha =        $row[3];
                                 $status =       $row[4];
                                 $tipo =         $row[5];
                                 $departamento = $row[6];
                                 $usuario =      $row[7];
                              ?>
                              <tr>
                                <td><a href="http://help.allware.cl/staff/index.php?/Tickets/Ticket/View/<?php echo $id;?>" class="btn btn-info btn-sm btn-block" target="_blank"><?php echo $ticket; ?></a></td>
                                <td><?php echo $titulo; ?></td>
                                <td><?php echo $fecha; ?></td>
                                <td><?php echo $status; ?></td>
                                <td><?php echo $tipo; ?></td>
                              </tr>
                              <?php
                               }
                               ?>
                            </tbody>
                          </table>
                        <?php } ?>
                                              

                        </p>
                       </div>
                   </div>
                <!-- Tickets -->
                    
                </td>
            </tr>
        </table>
   
</div>
