<?php

 $id_area = Yii::app()->user->id_area;

if($area_rem=='false' && $area_dest=='false'){


      $sql2 ="SELECT 
                     count(turnos.id) as cuenta 
                  FROM 
              public.turnos, 
              public.correspondencia, 
              public.documentos, 
              public.directorio, 
              public.datos_personales,
              public.directorio directoriodest, 
              public.datos_personales datosdest,
              public.areas,
              public.areas areas2
            WHERE 
              turnos.remitente = directorio.id AND
              turnos.destinatario = directoriodest.id AND
              correspondencia.id = turnos.id_corresp AND
              documentos.id = correspondencia.id_docto AND
              directoriodest.id_dp = datosdest.id AND
              directoriodest.id_area = areas2.id AND
              areas.id = directorio.id_area AND
              (directorio.id_area = $id_area OR directoriodest.id_area = $id_area) AND
              (turnos.fecha_turno between '$fecha1' and '$fecha2')  AND
              directorio.id_dp = datos_personales.id";

  $query ="SELECT 
              documentos.documento, 
              documentos.fecha, 
              turnos.id, 
              documentos.asunto, 
              turnos.remitente, 
              turnos.destinatario, 
              turnos.solucion, 
              turnos.estado_sol,
              turnos.solucion, 
              turnos.fecha_turno, 
              directorio.id_area,
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
              public.turnos, 
              public.correspondencia, 
              public.documentos, 
              public.directorio, 
              public.datos_personales,
              public.directorio directoriodest, 
              public.datos_personales datosdest,
              public.areas,
              public.areas areas2
            WHERE 
              turnos.remitente = directorio.id AND
              turnos.destinatario = directoriodest.id AND
              correspondencia.id = turnos.id_corresp AND
              documentos.id = correspondencia.id_docto AND
              directoriodest.id_dp = datosdest.id AND
              directoriodest.id_area = areas2.id AND
              areas.id = directorio.id_area AND
              (directorio.id_area = $id_area OR directoriodest.id_area = $id_area) AND
              (turnos.fecha_turno between '$fecha1' and '$fecha2')  AND
              directorio.id_dp = datos_personales.id";

}

   $rem = Yii::app()->db->createCommand($sql2)->queryRow();

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

                    

                             

                              ?>

                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- WIDGET TABLE -->
                                        <div class="widget widget-table" style="overflow-x: scroll;background: -webkit-linear-gradient(top, #4ca06d, #5aafb0);">
                                            <div class="widget-header">
                                                <h3><i class="fa fa-desktop"></i>Turnos</h3>
                                               
                                                <div class="btn-group widget-header-toolbar">
                                                    <div class="control-inline toolbar-item-group">
                                                      
                                                   <div id="btnExport"><?php echo CHtml::image(Yii::app()->request->baseUrl . '/images/excel.png')?></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="widget-content">
                                       <div id="datos" >
                                                <table id="visit-stat-table" class="table table-sorting table-striped table-hover datatable">
                                                    
													 <thead style="overflow-x: scroll;">
                                                        <tr>
                                                            <th></th>
                                                            <th></th>
                                                            <th ></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th colspan="3">Remitente</th>
                                                            <th colspan="3">Destinatario</th>
                                                            <th></th>
                                                            <th></th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <thead>
                                                        <tr>
                                                            <th>Num</th>
                                                            <th>Numero de Documento</th>
                                                            <th>Fecha_Documento</th>
                                                             <th>folio</th>
                                                            <th>tipo</th>
                                                            <th>FechaAcuse</th>
                                                            <th>Asunto</th>
                                                            <th>Area </th>
                                                            <th>Cargo</th>
                                                            <th>Nombre</th>
                                                            <th>Area </th>
                                                            <th>Cargo</th>
                                                            <th>Nombre</th>
                                                            <th>Estado</th>
                                                            <th>Solucion</th>
                                                         
                                                        
                                                        </tr>
                                                    </thead>
                                                    

                                                   
                                                  
  <?php

                                                  



                                                    $resultrem=Yii::app()->db->createCommand($query)->queryAll();
$cuenta=1;


                                                     foreach ($resultrem as $value) {

                                                      if($value['estado_sol']=='1'){
    $imagen="<div class=\"label label-success\"><i class=\"fa fa-check-circle\"></i> SOLUCIONADO</button></div>";
    }
      if($value['estado_sol']=='0'){
    $imagen="<div class=\"label label-warning\"><i class=\"fa fa-warning\"></i> PENDIENTE</div>"; 
    }

                                                    

                                                

                                                    ?>
                                                    <tbody>
                                                        <tr>
                                                        <td><?=$cuenta?></td>
                                                            <td><?=$value['documento']?></td>
                                                            <td><?=$value['fecha']?></td>
                                                            <td><?=$value['id']?></td>
                                                            <td></td>
                                                             <td></td>
                                                             <td><?=$value['asunto']?></td>
                                                             <td><?=$value['nombrearea']?></td>
                                                            <td><?=$value['cargo']?></td>
                                                             <td><?=$value['nombrerem']?> <?=$value['apprem']?> <?=$value['apmrem']?></td>
                                                             <td><?=$value['nombreareadest']?></td>
                                                            <td><?=$value['cargodest']?></td>
                                                             <td><?=$value['nombredest']?> <?=$value['appdest']?> <?=$value['apmdest']?></td>
                                                             <td><?=$imagen?></td>
                                                             <td><?=$value['solucion']?></td>
                                                        </tr>
                                                     
                                                    </tbody>

                                                    <?php 
                                                    $cuenta++;
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

