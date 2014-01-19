<?php

/**
 * This is the model class for table "filters".
 *
 * The followings are the available columns in table 'filters':
 * @property integer $id
 * @property string $name
 * @property integer $mann_id
 * @property double $price
 * @property integer $type
 * @property integer $amount
 */
class Filter extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Filter the static model class
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
		return 'filters';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, mann_id, amount', 'required'),
			array('mann_id, type, amount', 'numerical', 'integerOnly'=>true),
			array('price', 'numerical'),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, mann_id, price, type, amount', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'mann_id' => 'Mann',
			'price' => 'Price',
			'type' => 'Type',
			'amount' => 'Amount',
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
		$criteria->compare('mann_id',$this->mann_id);
		$criteria->compare('price',$this->price);
		$criteria->compare('type',$this->type);
		$criteria->compare('amount',$this->amount);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination' => array('pageSize' => 100),
		));
	}
}