<?php


class ApiExcelController extends Controller
{


	public function actionPorConfirmar()
	{
		
		
		echo "Hola Mundo";
		/*$html2=utf8_decode($this->tabla_porconfirmar());
        
		header("Content-type: application/vnd.ms-excel; name='excel'; charset=utf-8");
		header("Content-Disposition: filename=\"BandejaConfirmar_". date("d/m/y H:i:s").".xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		
		echo $html2;  
		Yii::app()->end();*/
	
 

	}

	public function tabla_porconfirmar()
	{


               
		                $html ="<table id=\"visit-stat-table\" class=\"table table-sorting table-striped table-hover datatable\">
                                                    
													 <thead>
                           <tr>
                             <th colspan=\"2\">Fecha: </th>
                             <th colspan=\"4\"></th>
                           </tr>
                           <tr>
                             <th colspan=\"2\">Area Remitente:</th>
                             <th colspan=\"4\"</th>
                           </tr>
                           <tr>
                             <th colspan=\"2\">Area Destinatario:</th>
                             <th colspan=\"4\"></th>
                           </tr>
                           <tr>
                             <th colspan=\"2\">Numero de Oficios Por Confirmar: </th>
                             <th colspan=\"4\"></th>
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
                                                    

                                                   
                                                  
  /*

                                                  





                                                     foreach ($resultrem as $value) {

 $fecha_reg = date("Y-m-d H:i:s");
  $dias = Correspondencia::dias_transcurridos($value['fecha'],$fecha_reg);

  

    if($dias>40){
    $imagen="<div class=\"label label-danger\"><i class=\"fa fa-info-circle\"> $dias dias</i> (FUERA DE TIEMPO)</button></div>";
    }else{
      $imagen="<div class=\"label label-success\"><i class=\"fa fa-check-circle\"></i>VIGENTE</button></div>";
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

                                                ?>*/
                                               
        $html .="</table>";
		
        return $html;
	}



}

?>

