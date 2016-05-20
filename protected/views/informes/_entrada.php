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

                              $id_area = Yii::app()->user->id_area;

                               $sql2 ="SELECT 
                                                                  count(correspondencia.id) as cuenta 
                                                                FROM 
                                                                  public.correspondencia, 
                                                                  public.documentos, 
                                                                  public.directorio, 
                                                                  public.directorio as direm
                                                                 
                                                                WHERE 
                                                                  correspondencia.destinatario = directorio.id_area AND
                                                                  documentos.id = correspondencia.id_docto AND
                                                                  documentos.remitente = direm.id AND
                                                                  documentos.estado = 1 AND
                                                                  correspondencia.estado = 1 AND
                                                                  directorio.id_area = $id_area";
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
                                                         
                                                        
                                                        </tr>
                                                    </thead>
                                                    

                                                   
                                                  
  <?php

                                                  


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
  correspondencia.estado_acuse = 1  AND 
  (documentos.fecha between '$fecha1' and '$fecha2')  AND
  documentos.estado = 1
  order by documentos.id desc";

                                                    $resultrem=Yii::app()->db->createCommand($query)->queryAll();
$cuenta=0;
                                                     foreach ($resultrem as $value) {

                                                    

                                                

                                                    ?>
                                                    <tbody>
                                                        <tr>
                                                            <td><?=$i?></td>
                                                            <td><?=$value['documento']?></td>
                                                            <td><?=$value['fecha']?></td>
                                                           <td><?=$value['nomdoc']?></td>
                                                            <td><?=$value['nomdoc2']?></td>
                                                            <td><?=str_replace("“", '-',str_replace("”", '-', str_replace("\"", '-', $value['asunto'])))?></td>
                                                             <td><?=$value['nombrearea']?></td>
                                                            <td><?=$value['cargo']?></td>
                                                             <td><?=$value['nombrerem']?> <?=$value['apprem']?> <?=$value['apmrem']?></td>
                                                             <td><?=$value['nombreareadest']?></td>
                                                            <td><?=$value['cargodest']?></td>
                                                             <td><?=$value['nombredest']?> <?=$value['appdest']?> <?=$value['apmdest']?></td>
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

   