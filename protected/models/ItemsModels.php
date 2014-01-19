<?php

/**
 * This is the model class for table "items_categories".
 *
 * The followings are the available columns in table 'items_categories':
 * @property integer $id
 * @property string $name
 * @property integer $parent
 */
class ItemsModels extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ItemsCategory the static model class
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
		return 'items_models';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('item_id, model_id', 'required'),
			array('item_id, model_id, vendor_id, modelrow_id', 'numerical', 'integerOnly'=>true),
			array('item_id, model_id, vendor_id, modelrow_id', 'safe', 'on'=>'search'),
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
            'vendor_id' => 'Производитель',
            'modelrow_id' => 'Модельный ряд',
			'item_id' => 'Товар',
			'model_id' => 'Модель',
            'itemName' => 'Товар',
            'modelName' => 'Модель',
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

		$criteria->compare('item_id',$this->item_id);
        $criteria->compare('model_id',$this->model_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination' => array('pageSize' => 100),
		));
	}

    public function getItemName() {
        $item = Item::model()->findByPk($this->item_id);
        return $item->name;
    }

    public function getModelName() {
        $vendor = Vendor::model()->findByPk($this->vendor_id);
        $modelrow = Modelrow::model()->findByPk($this->modelrow_id);
        $modelcar = ModelCar::model()->findByPk($this->model_id);
        return $vendor->name . ' ' . $modelrow->name . ' ' . $modelcar->name;
    }

}