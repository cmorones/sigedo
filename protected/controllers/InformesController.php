<?php

class InformesController extends Controller
{
	

	
	public function actionIndex()
	{

		$this->render('index');

	}

	public function actionTurnos()
	{

		$this->render('turnos');

	}

	public function actionAdmin()
	{
		$this->render('admin');
	}

	public function actionSalida()
	{
		
		$id_area= Yii::app()->user->id_area;
		
		$sql = "SELECT nombre from areas where id=$id_area"; 
	    $ejercicio = Yii::app()->db->createCommand($sql)->queryRow();
	    $area = $ejercicio['nombre'];



		$this->render('salida', array(
			'area'=>$area,
			
			));
	}


    public function actionCargo()
	{
		$this->render('cargo');
	}


public function actionReqPto() {



if(empty($_POST['fecha1']) && empty($_POST['fecha2'])  && empty($_POST['fecha2']) ){
echo "Debe seleccionar un criterio";

}
elseif($_POST['id_tipo']==0){

$this->renderPartial('_porconfirmar', array(
		//	'model'=>$model,
			'fecha1'=>$_POST['fecha1'],
			'fecha2'=>$_POST['fecha2'],
			'id_tipo'=>$_POST['id_tipo'],
			'area_rem'=>$_POST['area_rem'],
			'area_dest'=>$_POST['area_dest'],
			));
}
elseif($_POST['id_tipo']==1){

$this->renderPartial('_entrada', array(
		//	'model'=>$model,
			'fecha1'=>$_POST['fecha1'],
			'fecha2'=>$_POST['fecha2'],
			'id_tipo'=>$_POST['id_tipo'],
			'area_rem'=>$_POST['area_rem'],
			'area_dest'=>$_POST['area_dest'],
			));
			
}
elseif($_POST['id_tipo']==2){

$this->renderPartial('_salida', array(
		//	'model'=>$model,
			'fecha1'=>$_POST['fecha1'],
			'fecha2'=>$_POST['fecha2'],
			'id_tipo'=>$_POST['id_tipo'],
			'area_rem'=>$_POST['area_rem'],
			'area_dest'=>$_POST['area_dest'],
			));
}


}

public function actionReqPto2() {





$this->renderPartial('_turnos', array(
		//	'model'=>$model,
			'fecha1'=>$_POST['fecha1'],
			'fecha2'=>$_POST['fecha2'],
			'id_tipo'=>$_POST['id_tipo'],
			'area_rem'=>$_POST['area_rem'],
			'area_dest'=>$_POST['area_dest'],
			));




}

public function actionRemitentes()
{
  /* $data=Trimestres::model()->findAll('id_periodo=:id_periodo',array('order'=>'id desc'), 
                 array(':id_periodo'=>(int) $_POST['id_periodo']));*/
/*    $data =Trimestres::model()->findAll((array(
    'condition'=>"id_periodo=$_POST[id_periodo]",
    'order'=>'id'
	)));*/
$query ="SELECT 
			  datos_personales.nombre, 
			  datos_personales.apellido_p, 
			  datos_personales.apellido_m, 
			  directorio.id_area,
			  directorio.id
			FROM 
			  public.directorio, 
			  public.datos_personales
			WHERE 
			  directorio.id_dp = datos_personales.id AND
			  directorio.id_area = $_POST[area_rem] AND
			  directorio.status=1";

	$resultrem=Yii::app()->db->createCommand($query)->queryAll();
		foreach ($resultrem as $value) {

			$nombre = $value['nombre'] . "  " .$value['apellido_p'] . "  " . $value['apellido_m'];

			echo CHtml::tag('option',array('value'=>$value['id']),CHtml::encode($nombre),true);

		}
 
    
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