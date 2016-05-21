<?php

class ApiExcelController extends Controller
{


		public function actionConfirmar($fecha1,$fecha2,$id_tipo,$area_rem,$area_dest)
	{
		
		
		
		$html2=utf8_decode($this->tabla_porconfirmar($fecha1,$fecha2,$id_tipo,$area_rem,$area_dest));
        
		header("Content-type: application/vnd.ms-excel; name='excel'; charset=utf-8");
		header("Content-Disposition: filename=\"BandejaConfirmar_". date("d/m/y H:i:s").".xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		
		echo $html2;  
		Yii::app()->end();
	
 

	}

		public function actionEntrada($fecha1,$fecha2,$id_tipo,$area_rem,$area_dest)
	{
		
		
		
		$html2=utf8_decode($this->tabla_entrada($fecha1,$fecha2,$id_tipo,$area_rem,$area_dest));
        
		header("Content-type: application/vnd.ms-excel; name='excel'; charset=utf-8");
		header("Content-Disposition: filename=\"BandejaEntradas_". date("d/m/y H:i:s").".xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		
		echo $html2;  
		Yii::app()->end();
	
 

	}

    public function actionSalida($fecha1,$fecha2,$id_tipo,$area_rem,$area_dest)
  {
    
    
    
    $html2=utf8_decode($this->tabla_salida($fecha1,$fecha2,$id_tipo,$area_rem,$area_dest));
        
    header("Content-type: application/vnd.ms-excel; name='excel'; charset=utf-8");
    header("Content-Disposition: filename=\"BandejaSalidas_". date("d/m/y H:i:s").".xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    
    echo $html2;  
    Yii::app()->end();
  
 

  }

  public function tabla_salida($fecha1,$fecha2,$id_tipo,$area_rem,$area_dest)
  {

 $id_area = Yii::app()->user->id_area;

if($area_rem=='false' && $area_dest=='false'){

  $sql2 ="SELECT 
             count(correspondencia.id) as cuenta 
          FROM 
              public.documentos, 
              public.correspondencia, 
              public.directorio, 
              public.tipo_doc nombredoc,
              public.tipo_copia nombretipo,  
              public.datos_personales, 
              public.directorio directoriodest, 
              public.datos_personales datosdest,
              public.areas,
              public.areas areas2
            WHERE 
              documentos.remitente = directorio.id AND
              documentos.id = correspondencia.id_docto AND
              correspondencia.destinatario = directoriodest.id AND
              directorio.id_dp = datos_personales.id AND
              nombretipo.id = correspondencia.tipo AND
              nombredoc.id = documentos.tipo_docto AND
              directoriodest.id_dp = datosdest.id AND
              directoriodest.id_area = areas2.id AND
              areas.id = directorio.id_area AND
              directorio.id_area = $id_area AND
             (documentos.fecha between '$fecha1' and '$fecha2')  AND
              documentos.estado = 1";

    $query ="SELECT 
              documentos.documento, 
              documentos.fecha, 
              documentos.asunto, 
              correspondencia.tipo,
              correspondencia.estado_acuse, 
              correspondencia.id,  
              correspondencia.fecha_acuse, 
              nombredoc.nombre as nomdoc,
              nombretipo.nombre as nomdoc2, 
              directorio.cargo, 
              datos_personales.nombre as nombrerem, 
              datos_personales.apellido_p as apprem, 
              datos_personales.apellido_m as apmrem, 
              datosdest.nombre as nombredest, 
              datosdest.apellido_p as appdest, 
              datosdest.apellido_m as apmdest,  
              directoriodest.cargo as cargodest,
              areas.nombre as nombrearea,
              areas2.nombre as nombreareadest
            FROM 
              public.documentos, 
              public.correspondencia, 
              public.directorio, 
              public.tipo_doc nombredoc,
              public.tipo_copia nombretipo,  
              public.datos_personales, 
              public.directorio directoriodest, 
              public.datos_personales datosdest,
              public.areas,
              public.areas areas2
            WHERE 
              documentos.remitente = directorio.id AND
              documentos.id = correspondencia.id_docto AND
              correspondencia.destinatario = directoriodest.id AND
              directorio.id_dp = datos_personales.id AND
              nombretipo.id = correspondencia.tipo AND
              nombredoc.id = documentos.tipo_docto AND
              directoriodest.id_dp = datosdest.id AND
              directoriodest.id_area = areas2.id AND
              areas.id = directorio.id_area AND
              directorio.id_area = $id_area AND
             (documentos.fecha between '$fecha1' and '$fecha2')  AND
              documentos.estado = 1
              order by documentos.id desc";



}elseif ($area_rem=='false' && $area_dest!='false') {

  $sql2 ="SELECT 
             count(correspondencia.id) as cuenta 
          FROM 
              public.documentos, 
              public.correspondencia, 
              public.directorio, 
              public.tipo_doc nombredoc,
              public.tipo_copia nombretipo,  
              public.datos_personales, 
              public.directorio directoriodest, 
              public.datos_personales datosdest,
              public.areas,
              public.areas areas2
            WHERE 
              documentos.remitente = directorio.id AND
              documentos.id = correspondencia.id_docto AND
              correspondencia.destinatario = directoriodest.id AND
              directorio.id_dp = datos_personales.id AND
               nombretipo.id = correspondencia.tipo AND
              nombredoc.id = documentos.tipo_docto AND
              directoriodest.id_dp = datosdest.id AND
              directoriodest.id_area = areas2.id AND
              areas.id = directorio.id_area AND
              directorio.id_area = $id_area AND
             (documentos.fecha between '$fecha1' and '$fecha2')  AND
              areas2.id = $area_dest AND
              documentos.estado = 1";

    $query ="SELECT 
              documentos.documento, 
              documentos.fecha, 
              documentos.asunto, 
              correspondencia.tipo,
              correspondencia.estado_acuse, 
              correspondencia.id,  
              correspondencia.fecha_acuse, 
              nombredoc.nombre as nomdoc,
              nombretipo.nombre as nomdoc2, 
              directorio.cargo, 
              datos_personales.nombre as nombrerem, 
              datos_personales.apellido_p as apprem, 
              datos_personales.apellido_m as apmrem, 
              datosdest.nombre as nombredest, 
              datosdest.apellido_p as appdest, 
              datosdest.apellido_m as apmdest,  
              directoriodest.cargo as cargodest,
              areas.nombre as nombrearea,
              areas2.nombre as nombreareadest
            FROM 
              public.documentos, 
              public.correspondencia, 
              public.directorio, 
              public.tipo_doc nombredoc,
              public.tipo_copia nombretipo,  
              public.datos_personales, 
              public.directorio directoriodest, 
              public.datos_personales datosdest,
              public.areas,
              public.areas areas2
            WHERE 
              documentos.remitente = directorio.id AND
              documentos.id = correspondencia.id_docto AND
              correspondencia.destinatario = directoriodest.id AND
              directorio.id_dp = datos_personales.id AND
               nombretipo.id = correspondencia.tipo AND
              nombredoc.id = documentos.tipo_docto AND
              directoriodest.id_dp = datosdest.id AND
              directoriodest.id_area = areas2.id AND
              areas.id = directorio.id_area AND
              directorio.id_area = $id_area AND
             (documentos.fecha between '$fecha1' and '$fecha2')  AND
              areas2.id = $area_dest AND
              documentos.estado = 1
              order by documentos.id desc";

} elseif ($area_rem!='false' && $area_dest=='false') {

$sql2 ="SELECT 
             count(correspondencia.id) as cuenta 
          FROM 
              public.documentos, 
              public.correspondencia, 
              public.directorio, 
              public.tipo_doc nombredoc,
              public.tipo_copia nombretipo,  
              public.datos_personales, 
              public.directorio directoriodest, 
              public.datos_personales datosdest,
              public.areas,
              public.areas areas2
            WHERE 
              documentos.remitente = directorio.id AND
              documentos.id = correspondencia.id_docto AND
              correspondencia.destinatario = directoriodest.id AND
              directorio.id_dp = datos_personales.id AND
               nombretipo.id = correspondencia.tipo AND
              nombredoc.id = documentos.tipo_docto AND
              directoriodest.id_dp = datosdest.id AND
              directoriodest.id_area = areas2.id AND
              areas.id = directorio.id_area AND
              directorio.id_area = $id_area AND
             (documentos.fecha between '$fecha1' and '$fecha2')  AND
              areas.id = $area_rem  AND
              documentos.estado = 1";

    $query ="SELECT 
              documentos.documento, 
              documentos.fecha, 
              documentos.asunto, 
              correspondencia.tipo,
              correspondencia.estado_acuse, 
              correspondencia.id,  
              correspondencia.fecha_acuse, 
              nombredoc.nombre as nomdoc,
              nombretipo.nombre as nomdoc2, 
              directorio.cargo, 
              datos_personales.nombre as nombrerem, 
              datos_personales.apellido_p as apprem, 
              datos_personales.apellido_m as apmrem, 
              datosdest.nombre as nombredest, 
              datosdest.apellido_p as appdest, 
              datosdest.apellido_m as apmdest,  
              directoriodest.cargo as cargodest,
              areas.nombre as nombrearea,
              areas2.nombre as nombreareadest
            FROM 
              public.documentos, 
              public.correspondencia, 
              public.directorio, 
              public.tipo_doc nombredoc,
              public.tipo_copia nombretipo,  
              public.datos_personales, 
              public.directorio directoriodest, 
              public.datos_personales datosdest,
              public.areas,
              public.areas areas2
            WHERE 
              documentos.remitente = directorio.id AND
              documentos.id = correspondencia.id_docto AND
              correspondencia.destinatario = directoriodest.id AND
              directorio.id_dp = datos_personales.id AND
              nombretipo.id = correspondencia.tipo AND
              nombredoc.id = documentos.tipo_docto AND
              directoriodest.id_dp = datosdest.id AND
              directoriodest.id_area = areas2.id AND
              areas.id = directorio.id_area AND
              directorio.id_area = $id_area AND
             (documentos.fecha between '$fecha1' and '$fecha2')  AND
              areas.id = $area_rem  AND
              documentos.estado = 1
              order by documentos.id desc";


} elseif ($area_rem!='false' && $area_dest!='false') {

  $sql2 ="SELECT 
             count(correspondencia.id) as cuenta 
          FROM 
              public.documentos, 
              public.correspondencia, 
              public.directorio, 
              public.tipo_doc nombredoc,
              public.tipo_copia nombretipo,  
              public.datos_personales, 
              public.directorio directoriodest, 
              public.datos_personales datosdest,
              public.areas,
              public.areas areas2
            WHERE 
              documentos.remitente = directorio.id AND
              documentos.id = correspondencia.id_docto AND
              correspondencia.destinatario = directoriodest.id AND
              directorio.id_dp = datos_personales.id AND
               nombretipo.id = correspondencia.tipo AND
              nombredoc.id = documentos.tipo_docto AND
              directoriodest.id_dp = datosdest.id AND
              directoriodest.id_area = areas2.id AND
              areas.id = directorio.id_area AND
              directorio.id_area = $id_area AND
             (documentos.fecha between '$fecha1' and '$fecha2')  AND
             areas.id = $area_rem AND
             areas2.id = $area_dest AND
              documentos.estado = 1";

    $query ="SELECT 
              documentos.documento, 
              documentos.fecha, 
              documentos.asunto, 
              correspondencia.tipo,
              correspondencia.estado_acuse, 
              correspondencia.id,  
              correspondencia.fecha_acuse, 
              nombredoc.nombre as nomdoc,
              nombretipo.nombre as nomdoc2, 
              directorio.cargo, 
              datos_personales.nombre as nombrerem, 
              datos_personales.apellido_p as apprem, 
              datos_personales.apellido_m as apmrem, 
              datosdest.nombre as nombredest, 
              datosdest.apellido_p as appdest, 
              datosdest.apellido_m as apmdest,  
              directoriodest.cargo as cargodest,
              areas.nombre as nombrearea,
              areas2.nombre as nombreareadest
            FROM 
              public.documentos, 
              public.correspondencia, 
              public.directorio, 
              public.tipo_doc nombredoc,
              public.tipo_copia nombretipo,  
              public.datos_personales, 
              public.directorio directoriodest, 
              public.datos_personales datosdest,
              public.areas,
              public.areas areas2
            WHERE 
              documentos.remitente = directorio.id AND
              documentos.id = correspondencia.id_docto AND
              correspondencia.destinatario = directoriodest.id AND
              directorio.id_dp = datos_personales.id AND
              nombretipo.id = correspondencia.tipo AND
              nombredoc.id = documentos.tipo_docto AND
              directoriodest.id_dp = datosdest.id AND
              directoriodest.id_area = areas2.id AND
              areas.id = directorio.id_area AND
              directorio.id_area = $id_area AND
             (documentos.fecha between '$fecha1' and '$fecha2')  AND
             areas.id = $area_rem AND
             areas2.id = $area_dest AND
              documentos.estado = 1
              order by documentos.id desc";

}

     $rem = Yii::app()->db->createCommand($sql2)->queryRow();
                              $i=1;


                 if($area_rem=='false'){
                    $nombre_area_rem = 'TODOS';
                  }else{
                    $sql = "SELECT nombre from areas where id=$area_rem"; 
                    $nom = Yii::app()->db->createCommand($sql)->queryRow();
                    $nombre_area_rem = $nom['nombre'];

                  }

                   if($area_dest=='false'){
                    $nombre_area_dest = 'TODOS';
                  }else{
                    $sql = "SELECT nombre from areas where id=$area_dest"; 
                    $nom = Yii::app()->db->createCommand($sql)->queryRow();
                    $nombre_area_dest = $nom['nombre'];

                  }

                           

                 $html ="<table id=\"visit-stat-table\" class=\"table table-sorting table-striped table-hover datatable\">
                                                    
                           <thead>
                              <tr>
                             <th colspan=\"2\">Fecha: </th>
                             <th colspan=\"4\">Del $fecha1 al $fecha2</th>
                           </tr>
                           <tr>
                             <th colspan=\"2\">Area Remitente:</th>
                             <th colspan=\"4\">$nombre_area_rem</th>
                           </tr>
                           <tr>
                             <th colspan=\"2\">Area Destinatario:</th>
                             <th colspan=\"4\">$nombre_area_dest</th>
                           </tr>
                           <tr>
                             <th colspan=\"2\">Numero de Oficios Por Confirmar: </th>
                             <th colspan=\"4\">$rem[cuenta]</th>
                           </tr>
                           <tr>
                             <td></td>
                           </tr>
                                                        <tr>
                                                            <th></th>
                                                            <th ></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th colspan=\"3\">Remitente</th>
                                                            <th colspan=\"3\">Destinatario</th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <thead>
                                                        <tr>
                                                            <th>Num</th>
                                                            <th>Numero de Documento</th>
                                                            <th>Fecha_Documento</th>
                                                            <th>tipo</th>
                                                            <th>Docto</th>
                                                            <th>Asunto</th>
                                                            <th>Area </th>
                                                            <th>Cargo</th>
                                                            <th>Nombre</th>
                                                            <th>Area </th>
                                                            <th>Cargo</th>
                                                            <th>Nombre</th>
                                                            <th>Estado</th>
                                                         
                                                        
                                                        </tr>
                                                    </thead>";
                                                    

                                                   
                                                  

                

$resultrem=Yii::app()->db->createCommand($query)->queryAll();
$cuenta=0;

foreach ($resultrem as $value) {

                                                    
$valido=0;


  $sql = "SELECT count(id) as cuenta from turnos where id_corresp=$value[id]"; 
  $turnos = Yii::app()->db->createCommand($sql)->queryRow();

  $turnado = intval($turnos['cuenta']);
  if($turnos['cuenta']>0){


    $arg_list =ARRAY();

$q = "SELECT estado_sol FROM turnos where id_corresp=$value[id]";



$cmd = Yii::app()->db->createCommand($q);
//$cmd->getText();

$resultado = $cmd->query();
foreach ($resultado as $row) {


$arg_list[] =$row['estado_sol'];

}



if(in_array(0, $arg_list)){
  $valido = 0;
}else{
  $valido = 1;
}

  }

      if($value['estado_acuse']=='0'){
    $imagen="<div class=\"label label-danger\"><i class=\"fa fa-check-circle\"></i> SIN CONFIRMAR</button></div>";
    }

    if($value['estado_acuse']=='1' && $turnado==0){
    $imagen="<div class=\"label label-info\"><i class=\"fa fa-check-circle\"></i> CONFIRMADO</button></div>";
    }

    if($value['estado_acuse']=='1' && $turnado>0 && $valido==0 ){
    $imagen="<div class=\"label label-warning\"><i class=\"fa fa-check-circle\"></i> TURNADO SIN SOLUCION</button></div>";
    }

    if($value['estado_acuse']=='1' && $turnado > 0 && $valido==1){
    $imagen="<div class=\"label label-success\"><i class=\"fa fa-check-circle\"></i> TURNADO y SOLUCIONADO</button></div>";
    }

                                   

                                                    

                                                

                                                    $html .="<tbody>
                                                        <tr>
                                                            <td>$i</td>
                                                            <td>$value[documento]</td>
                                                            <td>$value[fecha]</td>
                                                           <td>$value[nomdoc]</td>
                                                            <td>$value[nomdoc2]</td>
                                                            <td>$value[asunto]</td>
                                                             <td>$value[nombrearea]</td>
                                                            <td>$value[cargo]</td>
                                                             <td>$value[nombrerem] $value[apprem] $value[apmrem]</td>
                                                             <td>$value[nombreareadest]</td>
                                                            <td>$value[cargodest]</td>
                                                             <td>$value[nombredest] $value[appdest] $value[apmdest]</td>
                                                             <td>$imagen</td>
                                                        </tr>
                                                     
                                                    </tbody>";

                                                  
                                                    $cuenta++;
                                                    $i++;
                                                }

                                                
                                               
                                                $html .="</table>";
                                                 return $html;



  }

	public function tabla_entrada($fecha1,$fecha2,$id_tipo,$area_rem,$area_dest)
	{



                         $id_area = Yii::app()->user->id_area;

if($area_rem=='false' && $area_dest=='false'){


$sql2 ="SELECT 
           count(correspondencia.id) as cuenta 
       FROM 
        public.documentos, 
        public.correspondencia, 
        public.directorio, 
        public.tipo_doc nombredoc,
        public.tipo_copia nombretipo,  
        public.datos_personales, 
        public.directorio directoriodest, 
        public.datos_personales datosdest,
        public.areas,
        public.areas areas2
      WHERE 
        documentos.remitente = directorio.id AND
        documentos.id = correspondencia.id_docto AND
        correspondencia.destinatario = directoriodest.id AND
        directorio.id_dp = datos_personales.id AND
        nombredoc.id = correspondencia.tipo AND
        nombretipo.id = documentos.tipo_docto AND
        directoriodest.id_dp = datosdest.id AND
        directoriodest.id_area = areas2.id AND
        areas.id = directorio.id_area AND
        directoriodest.id_area = $id_area AND
        correspondencia.estado_acuse = 1  AND 
        (documentos.fecha between '$fecha1' and '$fecha2')  AND
        documentos.estado = 1";

 $query ="SELECT 
  documentos.documento, 
  documentos.fecha, 
  documentos.asunto,
  correspondencia.id, 
  correspondencia.tipo, 
  correspondencia.fecha_acuse,
  correspondencia.estado_acuse, 
  nombredoc.nombre as nomdoc,
  nombretipo.nombre as nomdoc2, 
  directorio.cargo, 
  datos_personales.nombre as nombrerem, 
  datos_personales.apellido_p as apprem, 
  datos_personales.apellido_m as apmrem, 
  datosdest.nombre as nombredest, 
  datosdest.apellido_p as appdest, 
  datosdest.apellido_m as apmdest,  
  directoriodest.cargo as cargodest,
  areas.nombre as nombrearea,
  areas2.nombre as nombreareadest
FROM 
  public.documentos, 
  public.correspondencia, 
  public.directorio, 
  public.tipo_doc nombredoc,
  public.tipo_copia nombretipo,  
  public.datos_personales, 
  public.directorio directoriodest, 
  public.datos_personales datosdest,
  public.areas,
  public.areas areas2
WHERE 
  documentos.remitente = directorio.id AND
  documentos.id = correspondencia.id_docto AND
  correspondencia.destinatario = directoriodest.id AND
  directorio.id_dp = datos_personales.id AND
  nombredoc.id = correspondencia.tipo AND
  nombretipo.id = documentos.tipo_docto AND
  directoriodest.id_dp = datosdest.id AND
  directoriodest.id_area = areas2.id AND
  areas.id = directorio.id_area AND
  directoriodest.id_area = $id_area AND
  correspondencia.estado_acuse = 1  AND 
  (documentos.fecha between '$fecha1' and '$fecha2')  AND
  documentos.estado = 1
  order by documentos.id desc";


}elseif ($area_rem=='false' && $area_dest!='false') {

  $sql2 ="SELECT 
           count(correspondencia.id) as cuenta 
       FROM 
        public.documentos, 
        public.correspondencia, 
        public.directorio, 
        public.tipo_doc nombredoc,
        public.tipo_copia nombretipo,  
        public.datos_personales, 
        public.directorio directoriodest, 
        public.datos_personales datosdest,
        public.areas,
        public.areas areas2
      WHERE 
        documentos.remitente = directorio.id AND
        documentos.id = correspondencia.id_docto AND
        correspondencia.destinatario = directoriodest.id AND
        directorio.id_dp = datos_personales.id AND
        nombredoc.id = correspondencia.tipo AND
        nombretipo.id = documentos.tipo_docto AND
        directoriodest.id_dp = datosdest.id AND
        directoriodest.id_area = areas2.id AND
        areas.id = directorio.id_area AND
        directoriodest.id_area = $id_area AND
        correspondencia.estado_acuse = 1  AND 
        (documentos.fecha between '$fecha1' and '$fecha2')  AND
        areas2.id = $area_dest AND
        documentos.estado = 1";

 $query ="SELECT 
  documentos.documento, 
  documentos.fecha, 
  documentos.asunto,
  correspondencia.id, 
  correspondencia.tipo, 
  correspondencia.fecha_acuse,
  correspondencia.estado_acuse, 
  nombredoc.nombre as nomdoc,
  nombretipo.nombre as nomdoc2, 
  directorio.cargo, 
  datos_personales.nombre as nombrerem, 
  datos_personales.apellido_p as apprem, 
  datos_personales.apellido_m as apmrem, 
  datosdest.nombre as nombredest, 
  datosdest.apellido_p as appdest, 
  datosdest.apellido_m as apmdest,  
  directoriodest.cargo as cargodest,
  areas.nombre as nombrearea,
  areas2.nombre as nombreareadest
FROM 
  public.documentos, 
  public.correspondencia, 
  public.directorio, 
  public.tipo_doc nombredoc,
  public.tipo_copia nombretipo,  
  public.datos_personales, 
  public.directorio directoriodest, 
  public.datos_personales datosdest,
  public.areas,
  public.areas areas2
WHERE 
  documentos.remitente = directorio.id AND
  documentos.id = correspondencia.id_docto AND
  correspondencia.destinatario = directoriodest.id AND
  directorio.id_dp = datos_personales.id AND
  nombredoc.id = correspondencia.tipo AND
  nombretipo.id = documentos.tipo_docto AND
  directoriodest.id_dp = datosdest.id AND
  directoriodest.id_area = areas2.id AND
  areas.id = directorio.id_area AND
  directoriodest.id_area = $id_area AND
  correspondencia.estado_acuse = 1  AND 
  (documentos.fecha between '$fecha1' and '$fecha2')  AND
  documentos.estado = 1 AND 
  areas2.id = $area_dest 
  order by documentos.id desc";

} elseif ($area_rem!='false' && $area_dest=='false') {

    $sql2 ="SELECT 
           count(correspondencia.id) as cuenta 
       FROM 
        public.documentos, 
        public.correspondencia, 
        public.directorio, 
        public.tipo_doc nombredoc,
        public.tipo_copia nombretipo,  
        public.datos_personales, 
        public.directorio directoriodest, 
        public.datos_personales datosdest,
        public.areas,
        public.areas areas2
      WHERE 
        documentos.remitente = directorio.id AND
        documentos.id = correspondencia.id_docto AND
        correspondencia.destinatario = directoriodest.id AND
        directorio.id_dp = datos_personales.id AND
        nombredoc.id = correspondencia.tipo AND
        nombretipo.id = documentos.tipo_docto AND
        directoriodest.id_dp = datosdest.id AND
        directoriodest.id_area = areas2.id AND
        areas.id = directorio.id_area AND
        directoriodest.id_area = $id_area AND
        correspondencia.estado_acuse = 1  AND 
        (documentos.fecha between '$fecha1' and '$fecha2')  AND
        areas.id = $area_rem AND
        documentos.estado = 1";

 $query ="SELECT 
  documentos.documento, 
  documentos.fecha, 
  documentos.asunto,
  correspondencia.id, 
  correspondencia.tipo, 
  correspondencia.fecha_acuse,
  correspondencia.estado_acuse, 
  nombredoc.nombre as nomdoc,
  nombretipo.nombre as nomdoc2, 
  directorio.cargo, 
  datos_personales.nombre as nombrerem, 
  datos_personales.apellido_p as apprem, 
  datos_personales.apellido_m as apmrem, 
  datosdest.nombre as nombredest, 
  datosdest.apellido_p as appdest, 
  datosdest.apellido_m as apmdest,  
  directoriodest.cargo as cargodest,
  areas.nombre as nombrearea,
  areas2.nombre as nombreareadest
FROM 
  public.documentos, 
  public.correspondencia, 
  public.directorio, 
  public.tipo_doc nombredoc,
  public.tipo_copia nombretipo,  
  public.datos_personales, 
  public.directorio directoriodest, 
  public.datos_personales datosdest,
  public.areas,
  public.areas areas2
WHERE 
  documentos.remitente = directorio.id AND
  documentos.id = correspondencia.id_docto AND
  correspondencia.destinatario = directoriodest.id AND
  directorio.id_dp = datos_personales.id AND
  nombredoc.id = correspondencia.tipo AND
  nombretipo.id = documentos.tipo_docto AND
  directoriodest.id_dp = datosdest.id AND
  directoriodest.id_area = areas2.id AND
  areas.id = directorio.id_area AND
  directoriodest.id_area = $id_area AND
  correspondencia.estado_acuse = 1  AND 
  (documentos.fecha between '$fecha1' and '$fecha2')  AND
  documentos.estado = 1 AND 
  areas.id = $area_rem 
  order by documentos.id desc";

} elseif ($area_rem!='false' && $area_dest!='false') {

   $sql2 ="SELECT 
           count(correspondencia.id) as cuenta 
       FROM 
        public.documentos, 
        public.correspondencia, 
        public.directorio, 
        public.tipo_doc nombredoc,
        public.tipo_copia nombretipo,  
        public.datos_personales, 
        public.directorio directoriodest, 
        public.datos_personales datosdest,
        public.areas,
        public.areas areas2
      WHERE 
        documentos.remitente = directorio.id AND
        documentos.id = correspondencia.id_docto AND
        correspondencia.destinatario = directoriodest.id AND
        directorio.id_dp = datos_personales.id AND
        nombredoc.id = correspondencia.tipo AND
        nombretipo.id = documentos.tipo_docto AND
        directoriodest.id_dp = datosdest.id AND
        directoriodest.id_area = areas2.id AND
        areas.id = directorio.id_area AND
        directoriodest.id_area = $id_area AND
        correspondencia.estado_acuse = 1  AND 
        (documentos.fecha between '$fecha1' and '$fecha2')  AND
        areas.id = $area_rem AND
        areas2.id = $area_dest AND
        documentos.estado = 1";

 $query ="SELECT 
  documentos.documento, 
  documentos.fecha, 
  documentos.asunto,
  correspondencia.id, 
  correspondencia.tipo, 
  correspondencia.fecha_acuse,
  correspondencia.estado_acuse, 
  nombredoc.nombre as nomdoc,
  nombretipo.nombre as nomdoc2, 
  directorio.cargo, 
  datos_personales.nombre as nombrerem, 
  datos_personales.apellido_p as apprem, 
  datos_personales.apellido_m as apmrem, 
  datosdest.nombre as nombredest, 
  datosdest.apellido_p as appdest, 
  datosdest.apellido_m as apmdest,  
  directoriodest.cargo as cargodest,
  areas.nombre as nombrearea,
  areas2.nombre as nombreareadest
FROM 
  public.documentos, 
  public.correspondencia, 
  public.directorio, 
  public.tipo_doc nombredoc,
  public.tipo_copia nombretipo,  
  public.datos_personales, 
  public.directorio directoriodest, 
  public.datos_personales datosdest,
  public.areas,
  public.areas areas2
WHERE 
  documentos.remitente = directorio.id AND
  documentos.id = correspondencia.id_docto AND
  correspondencia.destinatario = directoriodest.id AND
  directorio.id_dp = datos_personales.id AND
  nombredoc.id = correspondencia.tipo AND
  nombretipo.id = documentos.tipo_docto AND
  directoriodest.id_dp = datosdest.id AND
  directoriodest.id_area = areas2.id AND
  areas.id = directorio.id_area AND
  directoriodest.id_area = $id_area AND
  correspondencia.estado_acuse = 1  AND 
  (documentos.fecha between '$fecha1' and '$fecha2')  AND
  documentos.estado = 1 AND 
  areas.id = $area_rem AND
  areas2.id = $area_dest
  order by documentos.id desc";

}

                 $rem = Yii::app()->db->createCommand($sql2)->queryRow();
                              $i=1;


                 if($area_rem=='false'){
                    $nombre_area_rem = 'TODOS';
                  }else{
                    $sql = "SELECT nombre from areas where id=$area_rem"; 
                    $nom = Yii::app()->db->createCommand($sql)->queryRow();
                    $nombre_area_rem = $nom['nombre'];

                  }

                   if($area_dest=='false'){
                    $nombre_area_dest = 'TODOS';
                  }else{
                    $sql = "SELECT nombre from areas where id=$area_dest"; 
                    $nom = Yii::app()->db->createCommand($sql)->queryRow();
                    $nombre_area_dest = $nom['nombre'];

                  }

                           

                 $html ="<table id=\"visit-stat-table\" class=\"table table-sorting table-striped table-hover datatable\">
                                                    
													 <thead>
                              <tr>
                             <th colspan=\"2\">Fecha: </th>
                             <th colspan=\"4\">Del $fecha1 al $fecha2</th>
                           </tr>
                           <tr>
                             <th colspan=\"2\">Area Remitente:</th>
                             <th colspan=\"4\">$nombre_area_rem</th>
                           </tr>
                           <tr>
                             <th colspan=\"2\">Area Destinatario:</th>
                             <th colspan=\"4\">$nombre_area_dest</th>
                           </tr>
                           <tr>
                             <th colspan=\"2\">Numero de Oficios Por Confirmar: </th>
                             <th colspan=\"4\">$rem[cuenta]</th>
                           </tr>
                           <tr>
                             <td></td>
                           </tr>
                                                        <tr>
                                                            <th></th>
                                                            <th ></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th colspan=\"3\">Remitente</th>
                                                            <th colspan=\"3\">Destinatario</th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <thead>
                                                        <tr>
                                                            <th>Num</th>
                                                            <th>Numero de Documento</th>
                                                            <th>Fecha_Documento</th>
                                                            <th>tipo</th>
                                                            <th>Docto</th>
                                                            <th>Asunto</th>
                                                            <th>Area </th>
                                                            <th>Cargo</th>
                                                            <th>Nombre</th>
                                                            <th>Area </th>
                                                            <th>Cargo</th>
                                                            <th>Nombre</th>
                                                            <th>Estado</th>
                                                         
                                                        
                                                        </tr>
                                                    </thead>";
                                                    

                                                   
                                                  

                

$resultrem=Yii::app()->db->createCommand($query)->queryAll();
$cuenta=0;

foreach ($resultrem as $value) {

                                                    
$valido=0;


  $sql = "SELECT count(id) as cuenta from turnos where id_corresp=$value[id]"; 
  $turnos = Yii::app()->db->createCommand($sql)->queryRow();

  $turnado = intval($turnos['cuenta']);
  if($turnos['cuenta']>0){


    $arg_list =ARRAY();

$q = "SELECT estado_sol FROM turnos where id_corresp=$value[id]";



$cmd = Yii::app()->db->createCommand($q);
//$cmd->getText();

$resultado = $cmd->query();
foreach ($resultado as $row) {


$arg_list[] =$row['estado_sol'];

}



if(in_array(0, $arg_list)){
  $valido = 0;
}else{
  $valido = 1;
}

  }

      if($value['estado_acuse']=='0'){
    $imagen="<div class=\"label label-danger\"><i class=\"fa fa-check-circle\"></i> SIN CONFIRMAR</button></div>";
    }

    if($value['estado_acuse']=='1' && $turnado==0){
    $imagen="<div class=\"label label-info\"><i class=\"fa fa-check-circle\"></i> CONFIRMADO</button></div>";
    }

    if($value['estado_acuse']=='1' && $turnado>0 && $valido==0 ){
    $imagen="<div class=\"label label-warning\"><i class=\"fa fa-check-circle\"></i> TURNADO SIN SOLUCION</button></div>";
    }

    if($value['estado_acuse']=='1' && $turnado > 0 && $valido==1){
    $imagen="<div class=\"label label-success\"><i class=\"fa fa-check-circle\"></i> TURNADO y SOLUCIONADO</button></div>";
    }

                                   

                                                    

                                                

                                                    $html .="<tbody>
                                                        <tr>
                                                            <td>$i</td>
                                                            <td>$value[documento]</td>
                                                            <td>$value[fecha]</td>
                                                           <td>$value[nomdoc]</td>
                                                            <td>$value[nomdoc2]</td>
                                                            <td>$value[asunto]</td>
                                                             <td>$value[nombrearea]</td>
                                                            <td>$value[cargo]</td>
                                                             <td>$value[nombrerem] $value[apprem] $value[apmrem]</td>
                                                             <td>$value[nombreareadest]</td>
                                                            <td>$value[cargodest]</td>
                                                             <td>$value[nombredest] $value[appdest] $value[apmdest]</td>
                                                             <td>$imagen</td>
                                                        </tr>
                                                     
                                                    </tbody>";

                                                  
                                                    $cuenta++;
                                                    $i++;
                                                }

                                                
                                               
                                                $html .="</table>";
                                                 return $html;

	}

	public function tabla_porconfirmar($fecha1,$fecha2,$id_tipo,$area_rem,$area_dest)
	{

		 

                              $id_area = Yii::app()->user->id_area;

                              if($area_rem=='false' && $area_dest=='false'){

                                 $sql2 ="SELECT 
                                                                    count(correspondencia.id) as cuenta 
                                                                  FROM 
                                                public.documentos, 
                                                public.correspondencia, 
                                                public.directorio, 
                                                public.tipo_doc nombredoc,
                                                public.tipo_copia nombretipo,  
                                                public.datos_personales, 
                                                public.directorio directoriodest, 
                                                public.datos_personales datosdest,
                                                public.areas,
                                                public.areas areas2
                                              WHERE 
                                                documentos.remitente = directorio.id AND
                                                documentos.id = correspondencia.id_docto AND
                                                correspondencia.destinatario = directoriodest.id AND
                                                directorio.id_dp = datos_personales.id AND
                                                nombredoc.id = correspondencia.tipo AND
                                                nombretipo.id = documentos.tipo_docto AND
                                                directoriodest.id_dp = datosdest.id AND
                                                directoriodest.id_area = areas2.id AND
                                                areas.id = directorio.id_area AND
                                                directoriodest.id_area = $id_area AND
                                                correspondencia.estado_acuse = 0  AND 
                                                (documentos.fecha between '$fecha1' and '$fecha2')  AND
                                                documentos.estado = 1";


                                                                                    $query ="SELECT 
  documentos.documento, 
  documentos.fecha, 
  documentos.asunto, 
  correspondencia.tipo, 
  correspondencia.fecha_acuse, 
  nombredoc.nombre as nomdoc,
  nombretipo.nombre as nomdoc2, 
  directorio.cargo, 
  datos_personales.nombre as nombrerem, 
  datos_personales.apellido_p as apprem, 
  datos_personales.apellido_m as apmrem, 
  datosdest.nombre as nombredest, 
  datosdest.apellido_p as appdest, 
  datosdest.apellido_m as apmdest,  
  directoriodest.cargo as cargodest,
  areas.nombre as nombrearea,
  areas2.nombre as nombreareadest
FROM 
  public.documentos, 
  public.correspondencia, 
  public.directorio, 
  public.tipo_doc nombredoc,
  public.tipo_copia nombretipo,  
  public.datos_personales, 
  public.directorio directoriodest, 
  public.datos_personales datosdest,
  public.areas,
  public.areas areas2
WHERE 
  documentos.remitente = directorio.id AND
  documentos.id = correspondencia.id_docto AND
  correspondencia.destinatario = directoriodest.id AND
  directorio.id_dp = datos_personales.id AND
  nombredoc.id = correspondencia.tipo AND
  nombretipo.id = documentos.tipo_docto AND
  directoriodest.id_dp = datosdest.id AND
  directoriodest.id_area = areas2.id AND
  areas.id = directorio.id_area AND
  directoriodest.id_area = $id_area AND
  correspondencia.estado_acuse = 0  AND 
  (documentos.fecha between '$fecha1' and '$fecha2')  AND
  documentos.estado = 1
  order by documentos.id desc";

                              } elseif ($area_rem=='false' && $area_dest!='false') {
                                 $sql2 ="SELECT 
                                                                    count(correspondencia.id) as cuenta 
                                                                 FROM 
                                          public.documentos, 
                                          public.correspondencia, 
                                          public.directorio, 
                                          public.tipo_doc nombredoc,
                                          public.tipo_copia nombretipo,  
                                          public.datos_personales, 
                                          public.directorio directoriodest, 
                                          public.datos_personales datosdest,
                                          public.areas,
                                          public.areas areas2
                                        WHERE 
                                          documentos.remitente = directorio.id AND
                                          documentos.id = correspondencia.id_docto AND
                                          correspondencia.destinatario = directoriodest.id AND
                                          directorio.id_dp = datos_personales.id AND
                                          nombredoc.id = correspondencia.tipo AND
                                          nombretipo.id = documentos.tipo_docto AND
                                          directoriodest.id_dp = datosdest.id AND
                                          directoriodest.id_area = areas2.id AND
                                          areas.id = directorio.id_area AND
                                          directoriodest.id_area = $id_area AND
                                          correspondencia.estado_acuse = 0  AND 
                                          (documentos.fecha between '$fecha1' and '$fecha2')  AND
                                          documentos.estado = 1 AND
                                          areas2.id = $area_dest";

                                         $query ="SELECT 
                                          documentos.documento, 
                                          documentos.fecha, 
                                          documentos.asunto, 
                                          correspondencia.tipo, 
                                          correspondencia.fecha_acuse, 
                                          nombredoc.nombre as nomdoc,
                                          nombretipo.nombre as nomdoc2, 
                                          directorio.cargo, 
                                          datos_personales.nombre as nombrerem, 
                                          datos_personales.apellido_p as apprem, 
                                          datos_personales.apellido_m as apmrem, 
                                          datosdest.nombre as nombredest, 
                                          datosdest.apellido_p as appdest, 
                                          datosdest.apellido_m as apmdest,  
                                          directoriodest.cargo as cargodest,
                                          areas.nombre as nombrearea,
                                          areas2.nombre as nombreareadest
                                        FROM 
                                          public.documentos, 
                                          public.correspondencia, 
                                          public.directorio, 
                                          public.tipo_doc nombredoc,
                                          public.tipo_copia nombretipo,  
                                          public.datos_personales, 
                                          public.directorio directoriodest, 
                                          public.datos_personales datosdest,
                                          public.areas,
                                          public.areas areas2
                                        WHERE 
                                          documentos.remitente = directorio.id AND
                                          documentos.id = correspondencia.id_docto AND
                                          correspondencia.destinatario = directoriodest.id AND
                                          directorio.id_dp = datos_personales.id AND
                                          nombredoc.id = correspondencia.tipo AND
                                          nombretipo.id = documentos.tipo_docto AND
                                          directoriodest.id_dp = datosdest.id AND
                                          directoriodest.id_area = areas2.id AND
                                          areas.id = directorio.id_area AND
                                          directoriodest.id_area = $id_area AND
                                          correspondencia.estado_acuse = 0  AND 
                                          (documentos.fecha between '$fecha1' and '$fecha2')  AND
                                          documentos.estado = 1 AND
                                          areas2.id = $area_dest 
                                          order by documentos.id desc";



                              } elseif ($area_rem!='false' && $area_dest=='false') {
                                 $sql2 ="SELECT 
                                                                    count(correspondencia.id) as cuenta 
                                                                  FROM 
                                          public.documentos, 
                                          public.correspondencia, 
                                          public.directorio, 
                                          public.tipo_doc nombredoc,
                                          public.tipo_copia nombretipo,  
                                          public.datos_personales, 
                                          public.directorio directoriodest, 
                                          public.datos_personales datosdest,
                                          public.areas,
                                          public.areas areas2
                                        WHERE 
                                          documentos.remitente = directorio.id AND
                                          documentos.id = correspondencia.id_docto AND
                                          correspondencia.destinatario = directoriodest.id AND
                                          directorio.id_dp = datos_personales.id AND
                                          nombredoc.id = correspondencia.tipo AND
                                          nombretipo.id = documentos.tipo_docto AND
                                          directoriodest.id_dp = datosdest.id AND
                                          directoriodest.id_area = areas2.id AND
                                          areas.id = directorio.id_area AND
                                          directoriodest.id_area = $id_area AND
                                          correspondencia.estado_acuse = 0  AND 
                                          (documentos.fecha between '$fecha1' and '$fecha2')  AND
                                          documentos.estado = 1 AND
                                          areas.id = $area_rem";


                                $query ="SELECT 
                                          documentos.documento, 
                                          documentos.fecha, 
                                          documentos.asunto, 
                                          correspondencia.tipo, 
                                          correspondencia.fecha_acuse, 
                                          nombredoc.nombre as nomdoc,
                                          nombretipo.nombre as nomdoc2, 
                                          directorio.cargo, 
                                          datos_personales.nombre as nombrerem, 
                                          datos_personales.apellido_p as apprem, 
                                          datos_personales.apellido_m as apmrem, 
                                          datosdest.nombre as nombredest, 
                                          datosdest.apellido_p as appdest, 
                                          datosdest.apellido_m as apmdest,  
                                          directoriodest.cargo as cargodest,
                                          areas.nombre as nombrearea,
                                          areas2.nombre as nombreareadest
                                        FROM 
                                          public.documentos, 
                                          public.correspondencia, 
                                          public.directorio, 
                                          public.tipo_doc nombredoc,
                                          public.tipo_copia nombretipo,  
                                          public.datos_personales, 
                                          public.directorio directoriodest, 
                                          public.datos_personales datosdest,
                                          public.areas,
                                          public.areas areas2
                                        WHERE 
                                          documentos.remitente = directorio.id AND
                                          documentos.id = correspondencia.id_docto AND
                                          correspondencia.destinatario = directoriodest.id AND
                                          directorio.id_dp = datos_personales.id AND
                                          nombredoc.id = correspondencia.tipo AND
                                          nombretipo.id = documentos.tipo_docto AND
                                          directoriodest.id_dp = datosdest.id AND
                                          directoriodest.id_area = areas2.id AND
                                          areas.id = directorio.id_area AND
                                          directoriodest.id_area = $id_area AND
                                          correspondencia.estado_acuse = 0  AND 
                                          (documentos.fecha between '$fecha1' and '$fecha2')  AND
                                          documentos.estado = 1 AND
                                          areas.id = $area_rem 
                                          order by documentos.id desc";
                              } elseif ($area_rem!='false' && $area_dest!='false') {
                                 $sql2 ="SELECT 
                                                                    count(correspondencia.id) as cuenta 
                                                                  FROM 
                                          public.documentos, 
                                          public.correspondencia, 
                                          public.directorio, 
                                          public.tipo_doc nombredoc,
                                          public.tipo_copia nombretipo,  
                                          public.datos_personales, 
                                          public.directorio directoriodest, 
                                          public.datos_personales datosdest,
                                          public.areas,
                                          public.areas areas2
                                        WHERE 
                                          documentos.remitente = directorio.id AND
                                          documentos.id = correspondencia.id_docto AND
                                          correspondencia.destinatario = directoriodest.id AND
                                          directorio.id_dp = datos_personales.id AND
                                          nombredoc.id = correspondencia.tipo AND
                                          nombretipo.id = documentos.tipo_docto AND
                                          directoriodest.id_dp = datosdest.id AND
                                          directoriodest.id_area = areas2.id AND
                                          areas.id = directorio.id_area AND
                                          directoriodest.id_area = $id_area AND
                                          correspondencia.estado_acuse = 0  AND 
                                          (documentos.fecha between '$fecha1' and '$fecha2')  AND
                                          documentos.estado = 1 AND
                                          areas.id = $area_rem  AND
                                          areas2.id = $area_dest";


                                $query ="SELECT 
                                          documentos.documento, 
                                          documentos.fecha, 
                                          documentos.asunto, 
                                          correspondencia.tipo, 
                                          correspondencia.fecha_acuse, 
                                          nombredoc.nombre as nomdoc,
                                          nombretipo.nombre as nomdoc2, 
                                          directorio.cargo, 
                                          datos_personales.nombre as nombrerem, 
                                          datos_personales.apellido_p as apprem, 
                                          datos_personales.apellido_m as apmrem, 
                                          datosdest.nombre as nombredest, 
                                          datosdest.apellido_p as appdest, 
                                          datosdest.apellido_m as apmdest,  
                                          directoriodest.cargo as cargodest,
                                          areas.nombre as nombrearea,
                                          areas2.nombre as nombreareadest
                                        FROM 
                                          public.documentos, 
                                          public.correspondencia, 
                                          public.directorio, 
                                          public.tipo_doc nombredoc,
                                          public.tipo_copia nombretipo,  
                                          public.datos_personales, 
                                          public.directorio directoriodest, 
                                          public.datos_personales datosdest,
                                          public.areas,
                                          public.areas areas2
                                        WHERE 
                                          documentos.remitente = directorio.id AND
                                          documentos.id = correspondencia.id_docto AND
                                          correspondencia.destinatario = directoriodest.id AND
                                          directorio.id_dp = datos_personales.id AND
                                          nombredoc.id = correspondencia.tipo AND
                                          nombretipo.id = documentos.tipo_docto AND
                                          directoriodest.id_dp = datosdest.id AND
                                          directoriodest.id_area = areas2.id AND
                                          areas.id = directorio.id_area AND
                                          directoriodest.id_area = $id_area AND
                                          correspondencia.estado_acuse = 0  AND 
                                          (documentos.fecha between '$fecha1' and '$fecha2')  AND
                                          documentos.estado = 1 AND
                                          areas.id = $area_rem  AND
                                          areas2.id = $area_dest
                                          order by documentos.id desc";
                              }   
  


                             // echo $query;                               
                                $rem = Yii::app()->db->createCommand($sql2)->queryRow();
                              $i=1;

                   $resultrem=Yii::app()->db->createCommand($query)->queryAll();
                  $cuenta=0;

                  if($area_rem=='false'){
                    $nombre_area_rem = 'TODOS';
                  }else{
                    $sql = "SELECT nombre from areas where id=$area_rem"; 
                    $nom = Yii::app()->db->createCommand($sql)->queryRow();
                    $nombre_area_rem = $nom['nombre'];

                  }

                   if($area_dest=='false'){
                    $nombre_area_dest = 'TODOS';
                  }else{
                    $sql = "SELECT nombre from areas where id=$area_dest"; 
                    $nom = Yii::app()->db->createCommand($sql)->queryRow();
                    $nombre_area_dest = $nom['nombre'];

                  }




                              


               
		                $html ="<table id=\"visit-stat-table\" class=\"table table-sorting table-striped table-hover datatable\">
                                                    
													 <thead>
                           <tr>
                             <th colspan=\"2\">Fecha:</th>
                             <th colspan=\"4\">Del $fecha1 al $fecha2 </th>
                           </tr>
                           <tr>
                             <th colspan=\"2\">Area Remitente:</th>
                             <th colspan=\"4\">$nombre_area_rem</th>
                           </tr>
                           <tr>
                             <th colspan=\"2\">Area Destinatario:</th>
                             <th colspan=\"4\">$nombre_area_dest</th>
                           </tr>
                           <tr>
                             <th colspan=\"2\">Numero de Oficios Por Confirmar: </th>
                             <th colspan=\"4\">$rem[cuenta]</th>
                           </tr>
                           <tr>
                             <td></td>
                           </tr>
                           <tr>
                                                            <th></th>
                                                            <th ></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th colspan=\"3\">Remitente</th>
                                                            <th colspan=\"3\">Destinatario</th>
                                                            <th></th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <thead>
                                                        <tr>
                                                            <th>Num</th>
                                                            <th>Numero de Documento</th>
                                                            <th>Fecha_Documento</th>
                                                            <th>tipo</th>
                                                            <th>Docto</th>
                                                            <th>Asunto</th>
                                                            <th>Area </th>
                                                            <th>Cargo</th>
                                                            <th>Nombre</th>
                                                            <th>Area </th>
                                                            <th>Cargo</th>
                                                            <th>Nombre</th>
                                                            <th>Estado</th>
                                                         
                                                        
                                                        </tr>
                                                    </thead>";
                                                    

                                                   
                                                  


                                                  





                                                     foreach ($resultrem as $value) {

 $fecha_reg = date("Y-m-d H:i:s");
  $dias = Correspondencia::dias_transcurridos($value['fecha'],$fecha_reg);

  

    if($dias>40){
    $imagen="<div class=\"label label-danger\"><i class=\"fa fa-info-circle\"> $dias dias</i> (FUERA DE TIEMPO)</button></div>";
    }else{
      $imagen="<div class=\"label label-success\"><i class=\"fa fa-check-circle\"></i>VIGENTE</button></div>";
    }                                                    

                                                

                                                  
                                                    $html .="<tbody>
                                                        <tr>
                                                            <td>$i</td>
                                                            <td width='100'>$value[documento]</td>
                                                            <td>$value[fecha]</td>
                                                           <td>$value[nomdoc]</td>
                                                            <td>$value[nomdoc2]</td>
                                                            <td>$value[asunto]</td>
                                                             <td>$value[nombrearea]</td>
                                                            <td>$value[cargo]</td>
                                                             <td>$value[nombrerem] $value[apprem] $value[apmrem]</td>
                                                             <td>$value[nombreareadest]</td>
                                                            <td>$value[cargodest]</td>
                                                             <td>$value[nombredest] $value[appdest] $value[apmdest]</td>
                                                             <td>$imagen</td>
                                                        </tr>
                                                     
                                                    </tbody>";

                                                  
                                                    $cuenta++;
                                                    $i++;
                                                }

                                                                                            
        $html .="</table>";
		
        return $html;
	}


	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}