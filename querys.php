<?php



$hoy=date("Y-m-d");
$ayer=add_day($hoy,"-1 day");
$tomorrow=add_day($hoy,"+1 day");
$manana=add_day($hoy,"+3 day");

$semana=date('W');

#query para consultar trabajos programados

$query_tp="SELECT  P.ID, P.FECHA_INICIO, P.HORA_INICIO, P.TP_FECHA_EXEC, P.TITULO,    
                D.TP_SUBELEMENTOS AS SERVICIO,    A.usr AS 'ASIGNADO',    A.TP_ROL,    
                E.NOMBRE AS ESTADO_FINAL,    P.RPN 
            FROM     
                PLANNED AS P LEFT JOIN ASIGNACION_PLANNED AS A ON (P.ID = A.PLANNED_ID) 
                LEFT JOIN TP_DATA AS D ON (D.PLANNED_ID = P.ID) LEFT JOIN ESTADOS_PLANNED AS E ON (P.ESTADOS_ID = E.ID) 
            WHERE  
                A.usr IN ('soporteallware','prepago_allware','o&m_allware') AND P.ESTADOS_ID NOT IN (1,4) AND A.TP_ROL != 'SOLICITANTE' AND 
                (A.TP_ROL IN ('GESTION','EJECUCION','CONOCIMIENTO','PRUEBAS','BABYSITTING') OR A.TP_ROL LIKE '%COMENTARIOS%') AND 
                CONCAT(P.FECHA_INICIO,' ',P.HORA_INICIO) BETWEEN '$ayer 19:00:00' AND '$manana 08:59:59' 
                ORDER BY
                E.NOMBRE DESC, CONCAT(P.FECHA_INICIO,' ',P.HORA_INICIO) ASC";



##query para consultar usuario en kayako

$sql_usuarios_kayako = datos_usuario("SELECT r.nombre, r.apellido, r.mail, r.rut, r.id_cargo, r.id_movil, r.path_img,r.id, m.movil, c.cargo, m.id
                        FROM `tt_recurso` r
                        LEFT JOIN tt_movil m ON m.id = r.id_movil
                        LEFT JOIN tt_cargo c ON c.id = r.id_cargo
                        WHERE r.`user`='$user'");

##query para consultar credenciales en kayako

$sql_credenciales=consulta_gestion("select * from tbl_credenciales");




$sql_recursos=consulta_gestion("select a.img, a.Nombre, a.Apellido, a.user, a.mail, a.rut, b.nombre 
from tbl_recursos a
inner join tbl_equipo b
on b.id=a.equipo;");


$sql_total_recursos="select count(1) from tbl_recursos";
$sql_total_por_area="select distinct(b.nombre),count(1) from tbl_recursos a, tbl_equipo b where b.id=a.equipo group by b.nombre";


$consulta_turno_original="select te.nombre equipo,tr.`Nombre`, tr.`Apellido` 
,ttt.turno, td.total total_dias
from tbl_turno tt
inner join tbl_recursos tr
on tt.id_recurso=tr.id
inner join tbl_equipo te
on tr.equipo=te.id
inner join tbl_tipo_turno ttt
on ttt.id_turno=tt.id_turno
inner join tbl_horario th
on ttt.horario=th.id_horario
inner join tbl_dias td
on td.id_dias=ttt.dias
where tt.`Semana`=$semana;";

$consulta_turno="select te.nombre equipo,tr.`Nombre`, tr.`Apellido` 
,ttt.turno, td.total total_dias, tr.img
from tbl_turno tt
inner join tbl_recursos tr
on tt.id_recurso=tr.id
inner join tbl_equipo te
on tr.equipo=te.id
inner join tbl_tipo_turno ttt
on ttt.id_turno=tt.id_turno
inner join tbl_horario th
on ttt.horario=th.id_horario
inner join tbl_dias td
on td.id_dias=ttt.dias
where tt.`Semana`=08;";



$consulta_recursos="select nombre,`Apellido`,id from tbl_recursos tr;";

$consulta_credencial_list="select id,servidor from tbl_credenciales;";

$consulta_servicios_list ="select id,plataforma from tbl_servicios;";

$consulta_recursos_list = "select id, Nombre, Apellido from tbl_recursos ;";


$consulta_servicios="select ts.id,ts.plataforma,tr.`Nombre`,tr.contraparte
,tcs.criticidad, tms.modelo,ts.nota,ts.fecha_tope
from tbl_servicios ts
inner join tbl_areas tr
on tr.id=ts.area
inner join tbl_criticidad_serv tcs
on tcs.id=ts.criticidad
inner join tbl_modalidad_serv tms
on tms.id=ts.modelo";





?>