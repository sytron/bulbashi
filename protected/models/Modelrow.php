<?php

/**
 * This is the model class for table "modelrows".
 *
 * The followings are the available columns in table 'modelrows':
 * @property integer $id
 * @property integer $mann_id
 * @property string $name
 * @property integer $vendor_id
 */
class Modelrow extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Modelrow the static model class
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
		return 'modelrows';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mann_id, name, vendor_id', 'required'),
			array('mann_id, vendor_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, mann_id, name, vendor_id', 'safe', 'on'=>'search'),
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
            'vendor'     => array(self::BELONGS_TO, 'Vendor', 'vendor_id'),
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
			'mann_id' => 'Mann',
			'name' => 'Name',
			'vendor_id' => 'Vendor',
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
		$criteria->compare('mann_id',$this->mann_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('vendor_id',$this->vendor_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination' => array('pageSize' => 100),
		));
	}


    static function getArrayList( $vendor_id ) {
        $modelrows = self::model()->findAllByAttributes(array('vendor_id' => $vendor_id));
        $res = array();
        $res[0] = 'Выберите модельный ряд';
        foreach( $modelrows as $v ) {
            $res[$v->id] = $v->name;
        }
        return $res;
    }
}