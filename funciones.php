<?php

function link_kayako()
{
        $conexion = mysqli_connect("192.168.40.99", "kayako_inf_gest", "pv_1572@llware", "soporte");

        if (!$conexion)
        {
                die('error al conectar: ' . mysql_error());
        }     
        return $conexion;
}

function consulta_kayako($string)
{
        $conexion = link_kayako();
        $resultado = $conexion->query($string);
        
        return $resultado;
}


function link_gestion()
{
        $conexion = mysqli_connect("localhost", "root", "12345", "soporte");

        if (!$conexion)
        {
                die('error al conectar: ' . mysql_error());
        }     
        return $conexion;
}

function consulta_gestion($string)
{
        $conexion = link_gestion();
        $resultado = $conexion->query($string);
        
        return $resultado;
}




function consulta_servicios($string)
{
        $conexion = link_kayako();
        $resultado = $conexion->query($string);
        
        return $resultado;

}

function datos_usuario($query)
{
    $datos_kayako = consulta_kayako("$query");
    return $datos_kayako;
}


#QUERYS PARA PSG 


function add_day($fecha,$oper_day)
{
    $nuevafecha = strtotime ( "$oper_day" , strtotime ( $fecha ) ) ;
    $nuevafecha = date ( 'Y-m-d' , $nuevafecha );
    return $nuevafecha;
}

function link_psg()
{
    $link_psg_conn=mysqli_connect("172.18.155.166", "allware", "4llw4r3.,123", "intradb") or die ("No se puede conectar a -- $intraserver -- <br>\n");
    if (!$link_psg_conn)
    {
            die('error al conectar: ' . mysql_error());
    }     
    return $link_psg_conn;
}

function consulta_tp($string)
{
    $conexion = link_psg();
    $resultado = $conexion->query($string);
    
    return $resultado;

}




function ticket_cant_kayako($user_name)
{
    $sql_tickets_total = consulta_kayako("SELECT COUNT(ticketid) FROM kayako.swtickets WHERE ownerstaffname = '$user_name' AND ticketstatusid != 6");
    $arr_total_ticket = mysqli_fetch_array($sql_tickets_total);
    $total_ticket = $arr_total_ticket[0];

    $sql_tickets_abierto = consulta_kayako("SELECT COUNT(ticketid) FROM kayako.swtickets WHERE ownerstaffname = '$user_name' AND ticketstatusid = 4");
    $arr_total_ticket_abierto = mysqli_fetch_array($sql_tickets_abierto);
    $total_ticket_abierto = $arr_total_ticket_abierto[0];

    $sql_tickets_espera = consulta_kayako("SELECT COUNT(ticketid) FROM kayako.swtickets WHERE ownerstaffname = '$user_name' AND ticketstatusid = 5");
    $arr_total_ticket_espera = mysqli_fetch_array($sql_tickets_espera);
    $total_ticket_espera = $arr_total_ticket_espera[0];

    $sql_tickets_planificado = consulta_kayako("SELECT COUNT(ticketid) FROM kayako.swtickets WHERE ownerstaffname = '$user_name' AND ticketstatusid = 7");
    $arr_total_ticket_planificado = mysqli_fetch_array($sql_tickets_planificado);
    $total_ticket_planificado = $arr_total_ticket_planificado[0];

    $sql_tickets_progreso = consulta_kayako("SELECT COUNT(ticketid) FROM kayako.swtickets WHERE ownerstaffname = '$user_name' AND ticketstatusid = 10");
    $arr_total_ticket_progreso = mysqli_fetch_array($sql_tickets_progreso);
    $total_ticket_progreso = $arr_total_ticket_progreso[0];


    $cantidades = array('total' =>$total_ticket ,
                                            'abierto' =>$total_ticket_abierto ,
                                            'espera' =>$total_ticket_espera ,
                                            'planificado' =>$total_ticket_planificado ,
                                            'progreso' =>$total_ticket_progreso ,
                                             );



return $cantidades;

}

function ticket_kayako_porcentaje($cantidad,$total)
{
    if ($cantidad == 0)
    {
     $porcentaje = 0;   
    }else
    {
    $porcentaje = (100*$cantidad)/$total;
}
    return $porcentaje."%";
};


function getSinServicio($resp=""){
    $hoy = new DateTime('-1 month');
    $hoy = $hoy->format('Y-m-d H:i:s');
    $hoy = strtotime($hoy);

    if(!$resp == ""){
        $con = "AND tickets.ownerstaffname LIKE  '%$resp%'";
    }else{
        $con = "";
    }

    $sql_ticket_sservicio = "SELECT
                                                        tickets.ticketid,
                                                        tickets.ticketmaskid AS 'tickets_ticketmaskid',
                                                        tickets.`subject`,
                                                        FROM_UNIXTIME( tickets.dateline ) AS 'tickets_dateline',
                                                        ticketstatus.title AS 'tickets_ticketstatusid',
                                                        tickettypes.title AS 'tickets_tickettypeid',
                                                        departments.title AS 'tickets_departmentid',
                                                        ownerstaffname
                                                    FROM
                                                        kayako.swtickets AS tickets
                                                        LEFT JOIN kayako.swusers AS users ON tickets.userid = users.userid
                                                        LEFT JOIN kayako.swdepartments AS departments ON tickets.departmentid = departments.departmentid
                                                        LEFT JOIN kayako.swticketstatus AS ticketstatus ON tickets.ticketstatusid = ticketstatus.ticketstatusid
                                                        LEFT JOIN kayako.swtickettypes AS tickettypes ON tickets.tickettypeid = tickettypes.tickettypeid
                                                        LEFT JOIN kayako.swcustomfieldvalues AS customfield17 ON customfield17.customfieldid = '17'
                                                        AND customfield17.fieldvalue != ''
                                                        AND customfield17.typeid = tickets.ticketid
                                                    WHERE
                                                        FROM_UNIXTIME( tickets.dateline ) >= FROM_UNIXTIME( $hoy )
                                                        AND customfield17.fieldvalue IS NULL
                                                        AND tickets.departmenttitle IN ( 'Soporte O&M', 'Soporte Prepago', 'Soporte VAS', 'Soporte' )
                                                        $con
                                                    ORDER BY
                                                        tickets_dateline";
$result = consulta_kayako($sql_ticket_sservicio);
return $result;
}


?>