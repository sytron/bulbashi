<?php

/**
 * This is the model class for table "clients".
 *
 * The followings are the available columns in table 'clients':
 * @property integer $id
 * @property string $name
 * @property string $gosnomer
 * @property string $vin
 * @property integer $vendor_id
 * @property integer $modelrow_id
 * @property integer $model_id
 * @property string $barcode
 * @property integer $time_register
 * @property integer $time_lastvisit
 * @property string $comment
 * @property integer $mileage
 * @property string $howknow
 * @property integer $card
 */
class Client extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Client the static model class
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
		return 'clients';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, vendor_id, modelrow_id, model_id', 'required'),
			array('vendor_id, modelrow_id, model_id, time_register, time_lastvisit, mileage, card', 'numerical', 'integerOnly'=>true),
			array('name, gosnomer, vin, barcode', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, gosnomer, vin, vendor_id, modelrow_id, model_id, barcode, time_register, time_lastvisit, comment, mileage, howknow, card', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
        return array(
            'vendor'     => array(self::BELONGS_TO, 'Vendor', 'vendor_id'),
            'modelrow'     => array(self::BELONGS_TO, 'Modelrow', 'modelrow_id'),
            'modelcar'     => array(self::BELONGS_TO, 'ModelCar', 'model_id'),
            'orders'   => array(self::HAS_MANY, 'Order',    'client_id'),
        );
	}

    public function behaviors()
    {
        return array(
            'activerecord-relation'=>array(
                'class'=>'ext.yiiext.behaviors.activerecord-relation.EActiveRecordRelationBehavior',
            ));
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'ФИО',
			'gosnomer' => 'Гос.номер',
			'vin' => 'VIN',
			'vendor_id' => 'Марка авто',
			'modelrow_id' => 'Модельный ряд',
			'model_id' => 'Модель',
			'barcode' => 'Штрих-код',
			'time_register' => 'Время регистрации',
			'time_lastvisit' => 'Время последнего посещения',
			'comment' => 'Примечания',
			'mileage' => 'Пробег',
			'howknow' => 'Как узнал',
			'card' => 'Карта',
            'CarName' => 'Автомобиль',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('gosnomer',$this->gosnomer,true);
		$criteria->compare('vin',$this->vin,true);
		$criteria->compare('vendor_id',$this->vendor_id);
		$criteria->compare('modelrow_id',$this->modelrow_id);
		$criteria->compare('model_id',$this->model_id);
		$criteria->compare('barcode',$this->barcode,true);
		$criteria->compare('time_register',$this->time_register);
		$criteria->compare('time_lastvisit',$this->time_lastvisit);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('mileage',$this->mileage);
		$criteria->compare('howknow',$this->howknow,true);
		$criteria->compare('card',$this->card);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination' => array('pageSize' => 100),
		));
	}

    public function getCarName ( ) {
        return $this->vendor->name . " " . $this->modelrow->name . " " . $this->modelcar->name;
    }

    public function getBarcodeImageUrl ( ) {
        return Yii::app()->createUrl('barcodegenerator/generatebarcode', array('code'=>$this->barcode));
    }

    public static function getHowknowArray() {
        return array(
        	'' => '',
            'От друзей' => 'От друзей',
            'Интернет' => 'Интернет',
            'Проезжал мимо' => 'Проезжал мимо',
        );
    }


    static function getArrayList(  ) {
        $clients = self::model()->findAll();
        $res = array();
        $res[0] = 'Все';
        foreach( $clients as $v ) {
            $res[$v->id] = $v->name.' ('.$v->CarName.')';
        }
        return $res;
    }
}