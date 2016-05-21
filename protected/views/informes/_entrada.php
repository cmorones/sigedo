    <?php

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
  nombretipo.id = correspondencia.tipo AND
  nombredoc.id = documentos.tipo_docto AND
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
        nombretipo.id = correspondencia.tipo AND
        nombredoc.id = documentos.tipo_docto AND
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
  nombretipo.id = correspondencia.tipo AND
  nombredoc.id = documentos.tipo_docto AND
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
        nombretipo.id = correspondencia.tipo AND
        nombredoc.id = documentos.tipo_docto AND
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
  nombretipo.id = correspondencia.tipo AND
  nombredoc.id = documentos.tipo_docto AND
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
        nombretipo.id = correspondencia.tipo AND
        nombredoc.id = documentos.tipo_docto AND
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
  nombretipo.id = correspondencia.tipo AND
  nombredoc.id = documentos.tipo_docto AND
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

?>

    <!-- content-wrapper -->
                    <div class="col-md-12 content-wrapper">
                  
                        <!-- main -->
                        <div class="content">
                            <div class="main-header">
                                <h2><?php //echo $area; ?></h2>
                                <em>Informacion Estadistica del Área</em>
                                

                            </div>
                            <div class="main-content">
                                <div class="row">
                                    <div class="col-md-9">
                                        <!-- WIDGET NO HEADER -->
                                        <div class="widget widget-hide-header">
                                            <div class="widget-header hide">
                                                <h3>Summary Info</h3>
                                            </div>
                                  
                                        </div>
                                        <!-- WIDGET NO HEADER -->
                                    </div>
                                   
                                </div>

                            <?php

                            
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

                              ?>

                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- WIDGET TABLE -->
                                        <div class="widget widget-table">
                                            <div class="widget-header">
                                                <h3><i class="fa fa-desktop"></i>Reporte de Correspondencia Bandeja de Entrada</h3>
                                               
                                                <div class="btn-group widget-header-toolbar">
                                                    <div class="control-inline toolbar-item-group">
                                                        <?   echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl . '/images/excel.png'),array('apiExcel/Entrada?fecha1='.$fecha1.'&fecha2='.$fecha2.'&id_tipo='.$id_tipo.'&area_rem='.$area_rem.'&area_dest='.$area_dest)); ?>
                                                    
                                                  
                                                    </div>
                                                </div>
                                            </div>

                                           <div class="widget-content">
                                            <div id="datos" >
                                                <table id="visit-stat-table" class="table table-sorting table-striped table-hover datatable">
                                                    
													 <thead>
                              <tr>
                             <th colspan="2">Fecha: </th>
                             <th colspan="4">Del <?=$fecha1?> al <?=$fecha2?></th>
                           </tr>
                           <tr>
                             <th colspan="2">Area Remitente:</th>
                             <th colspan="4"><?=$nombre_area_rem?></th>
                           </tr>
                           <tr>
                             <th colspan="2">Area Destinatario:</th>
                             <th colspan="4"><?=$nombre_area_dest?></th>
                           </tr>
                           <tr>
                             <th colspan="2">Numero de Oficios Por Confirmar: </th>
                             <th colspan="4"><?=$rem['cuenta']?></th>
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
                                                            <th colspan="3">Remitente</th>
                                                            <th colspan="3">Destinatario</th>
                                                            
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
                                                    </thead>
                                                    

                                                   
                                                  
  <?php

                                                  



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

                                                

                                                    ?>
                                                    <tbody>
                                                        <tr>
                                                            <td><?=$i?></td>
                                                            <td><?=$value['documento']?></td>
                                                            <td><?=$value['fecha']?></td>
                                                           <td><?=$value['nomdoc']?></td>
                                                            <td><?=$value['nomdoc2']?></td>
                                                            <td><?=$value['asunto']?></td>
                                                             <td><?=$value['nombrearea']?></td>
                                                            <td><?=$value['cargo']?></td>
                                                             <td><?=$value['nombrerem']?> <?=$value['apprem']?> <?=$value['apmrem']?></td>
                                                             <td><?=$value['nombreareadest']?></td>
                                                            <td><?=$value['cargodest']?></td>
                                                             <td><?=$value['nombredest']?> <?=$value['appdest']?> <?=$value['apmdest']?></td>
                                                             <td><?=$imagen?></td>
                                                        </tr>
                                                     
                                                    </tbody>

                                                    <?php 
                                                    $cuenta++;
                                                    $i++;
                                                }

                                                ?>
                                               
                                                </table>
                                            </div>
                                            </div>
                                        </div>
                                        <!-- END WIDGET TABLE -->

                                       
                                <!-- END WIDGET TICKET TABLE -->
                            </div>
                            <!-- /main-content -->
                        </div>


                      
                    </div>
                    <!-- /content-wrapper -->

   