<?php

/**
 * This is the model class for table "admin_final".
 *
 * The followings are the available columns in table 'admin_final':
 * @property integer $id
 * @property string $documento
 * @property integer $id_area
 * @property string $cargo
 * @property string $cargo_des
 * @property integer $area_des
 * @property string $nombre
 * @property string $apellido_p
 * @property string $apellido_m
 * @property string $nombre_des
 * @property string $apellidop_des
 * @property string $apellidom_des
 * @property integer $tipo
 * @property integer $tipo_docto
 * @property string $asunto
 * @property string $fecha
 */
class AdminFinal extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AdminFinal the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'admin_final';
	}

	public function primaryKey()
    {
            return 'id';
    }


	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, estado_acuse, id_area, area_des, tipo, tipo_docto', 'numerical', 'integerOnly'=>true),
			array('cargo, cargo_des', 'length', 'max'=>300),
			array('nombre, apellido_p, apellido_m, nombre_des, apellidop_des, apellidom_des', 'length', 'max'=>200),
			array('documento, asunto, fecha', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, documento, id_area, cargo, cargo_des, area_des, nombre, apellido_p, apellido_m, nombre_des, apellidop_des, apellidom_des, tipo, tipo_docto, asunto, fecha', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'Tipodoc'=>array(self::BELONGS_TO,'TipoDoc','tipo_docto'),
			'Tipo'=>array(self::BELONGS_TO,'TipoCopia','tipo'),
			'Areas'=>array(self::BELONGS_TO,'Areas','id_area'),
			'Areas2'=>array(self::BELONGS_TO,'Areas','area_des'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'estado_acuse' => 'Estado',
			'documento' => 'Documento',
			'id_area' => 'Area Remitente',
			'cargo' => 'Cargo',
			'cargo_des' => 'Cargo Des',
			'area_des' => 'Area Des',
			'nombre' => 'Nombre',
			'apellido_p' => 'Apellido P',
			'apellido_m' => 'Apellido M',
			'nombre_des' => 'Nombre Des',
			'apellidop_des' => 'Apellidop Des',
			'apellidom_des' => 'Apellidom Des',
			'tipo' => 'Tipo',
			'tipo_docto' => 'Tipo Docto',
			'asunto' => 'Asunto',
			'fecha' => 'Fecha',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched. $id_area = Yii::app()->user->id_area;

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('documento',$this->documento,true);
		$criteria->compare('id_area',$this->id_area);
		$criteria->compare('cargo',$this->cargo,true);
		$criteria->compare('cargo_des',$this->cargo_des,true);
		$criteria->compare('area_des',$this->area_des);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('apellido_p',$this->apellido_p,true);
		$criteria->compare('apellido_m',$this->apellido_m,true);
		$criteria->compare('nombre_des',$this->nombre_des,true);
		$criteria->compare('apellidop_des',$this->apellidop_des,true);
		$criteria->compare('apellidom_des',$this->apellidom_des,true);
		$criteria->compare('tipo',$this->tipo);
		$criteria->compare('tipo_docto',$this->tipo_docto);
		$criteria->compare('asunto',$this->asunto,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->order = 'fecha desc';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array('pageSize' => 20),
		));
	}

	public function search2()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched. $id_area = Yii::app()->user->id_area;

		$id_area = Yii::app()->user->id_area;

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('documento',$this->documento,true);
		$criteria->compare('id_area',$this->id_area);
		$criteria->compare('cargo',$this->cargo,true);
		$criteria->compare('cargo_des',$this->cargo_des,true);
		$criteria->compare('area_des',$id_area);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('apellido_p',$this->apellido_p,true);
		$criteria->compare('apellido_m',$this->apellido_m,true);
		$criteria->compare('nombre_des',$this->nombre_des,true);
		$criteria->compare('apellidop_des',$this->apellidop_des,true);
		$criteria->compare('apellidom_des',$this->apellidom_des,true);
		$criteria->compare('tipo',$this->tipo);
		$criteria->compare('tipo_docto',$this->tipo_docto);
		$criteria->compare('asunto',$this->asunto,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->order = 'fecha desc';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array('pageSize' => 20),
		));
	}

	public function getImagen(){

	//	$imagen="validado.png";


$valido=0;


  $sql = "SELECT count(id) as cuenta from turnos where id_corresp=$this->id"; 
  $turnos = Yii::app()->db->createCommand($sql)->queryRow();

  $turnado = intval($turnos['cuenta']);
  if($turnos['cuenta']>0){


  	$arg_list =ARRAY();

$q = "SELECT estado_sol FROM turnos where id_corresp=$this->id";



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

  		if($this->estado_acuse=='0'){
		$imagen="<div class=\"label label-danger\"><i class=\"fa fa-check-circle\"></i> SIN CONFIRMAR</button></div>";
		}

		if($this->estado_acuse=='1' && $turnado==0){
		$imagen="<div class=\"label label-info\"><i class=\"fa fa-check-circle\"></i> CONFIRMADO</button></div>";
		}

		if($this->estado_acuse=='1' && $turnado>0 && $valido==0 ){
		$imagen="<div class=\"label label-warning\"><i class=\"fa fa-check-circle\"></i> TURNADO SIN SOLUCION</button></div>";
		}

		if($this->estado_acuse=='1' && $turnado > 0 && $valido==1){
		$imagen="<div class=\"label label-success\"><i class=\"fa fa-check-circle\"></i> TURNADO y SOLUCIONADO</button></div>";
		}

		


		return $imagen;

		}

}