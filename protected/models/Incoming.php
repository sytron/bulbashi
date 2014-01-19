<?php

/**
 * This is the model class for table "incomings".
 *
 * The followings are the available columns in table 'incomings':
 * @property integer $id
 * @property integer $time_register
 * @property string $supplier
 * @property string $items
 */
class Incoming extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Incoming the static model class
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
		return 'incomings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('time_register, contragent_id, items', 'required'),
			array('time_register', 'numerical', 'integerOnly'=>true),
			array('supplier, osnovanie, date, number', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, time_register, osnovanie, date, number, contragent_id, items', 'safe'),
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
			'id' => '№',
			'time_register' => 'Время регистрации',
			'supplier' => 'Поставщик',
            'contragent_id' => 'Контрагент',
            'number' => 'Номер',
            'date' => 'Дата',
            'osnovanie' => 'Основание',
			'items' => 'Товары',
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
        $criteria->compare('number',$this->number,true);
        $criteria->compare('date',$this->date,true);
		$criteria->compare('time_register',$this->time_register);
		/*if( !empty($this->time_register) ) {
            $time = explode(' - ',$this->time_register);
            $criteria->addCondition('time_register >= '.strtotime($time[0]));
            $criteria->addCondition('time_register < '.strtotime($time[1]));
        }*/
        $criteria->compare('contragent_id',$this->contragent_id);
		//$criteria->compare('supplier',$this->supplier,true);
		$criteria->compare('items',$this->items,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination' => array('pageSize' => 100),
		));
	}


    public function getItemsDataProvider( ) {
        if( !is_array($this->items) ) {
            $this->items = unserialize($this->items);
        }
        //
        $dataProvider=new CArrayDataProvider($this->items, array(
            'id'=>'id',
            'sort'=>array(
                'attributes'=>array(
                    'id', 'name', 'count', 'price'
                ),
            ),
            'pagination'=>array(
                'pageSize'=>15,
            ),
        ));

        return $dataProvider;
    }

    public function getContragent( ) {
        $contra = Contragent::model()->findByPk($this->contragent_id);
        return $contra->name;
    }

}