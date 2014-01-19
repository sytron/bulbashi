<?php

/**
 * This is the model class for table "models".
 *
 * The followings are the available columns in table 'models':
 * @property integer $id
 * @property integer $modelrows_id
 * @property integer $vendor_id
 * @property string $name
 * @property string $code
 * @property string $car
 * @property string $ls
 * @property string $year
 * @property integer $mann_id
 * @property double $volume
 * @property integer $setup1
 * @property integer $setup2
 * @property integer $setup3
 * @property integer $setup4
 */
class ModelCar extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ModelCar the static model class
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
		return 'models';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('modelrows_id, vendor_id, name, code, car, ls, year, mann_id', 'required'),
			array('modelrows_id, vendor_id, mann_id, setup1, setup2, setup3, setup4', 'numerical', 'integerOnly'=>true),
			array('volume', 'numerical'),
			array('name, code, car, ls, year', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, modelrows_id, vendor_id, name, code, car, ls, year, mann_id, volume, setup1, setup2, setup3, setup4', 'safe', 'on'=>'search'),
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
            'modelrow'     => array(self::BELONGS_TO, 'Modelrow', 'modelrows_id'),
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
			'modelrows_id' => 'Modelrows',
			'vendor_id' => 'Vendor',
			'name' => 'Name',
			'code' => 'Code',
			'car' => 'Car',
			'ls' => 'Ls',
			'year' => 'Year',
			'mann_id' => 'Mann',
			'volume' => 'Volume',
			'setup1' => 'Setup1',
			'setup2' => 'Setup2',
			'setup3' => 'Setup3',
			'setup4' => 'Setup4',
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
		$criteria->compare('modelrows_id',$this->modelrows_id);
		$criteria->compare('vendor_id',$this->vendor_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('car',$this->car,true);
		$criteria->compare('ls',$this->ls,true);
		$criteria->compare('year',$this->year,true);
		$criteria->compare('mann_id',$this->mann_id);
		$criteria->compare('volume',$this->volume);
		$criteria->compare('setup1',$this->setup1);
		$criteria->compare('setup2',$this->setup2);
		$criteria->compare('setup3',$this->setup3);
		$criteria->compare('setup4',$this->setup4);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination' => array('pageSize' => 100),
		));
	}

    static function getArrayList( $modelrow_id ) {
        $modelcars = self::model()->findAllByAttributes(array('modelrows_id' => $modelrow_id ));
        $res = array();
        $res[0] = 'Выберите модель';
        foreach( $modelcars as $v ) {
            $res[$v->id] = $v->name.' '.$v->ls.'л.с. '.$v->year;
        }
        return $res;
    }
}