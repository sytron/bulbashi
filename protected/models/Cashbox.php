<?php

/**
 * This is the model class for table "cashbox".
 *
 * The followings are the available columns in table 'cashbox':
 * @property integer $id
 * @property string $name
 * @property string $object
 * @property integer $change
 * @property integer $time_created
 */
class Cashbox extends CActiveRecord
{
    public $tempDate;
    public $nextId;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Cashbox the static model class
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
		return 'cashbox';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, tempDate, article_id, name, change', 'required'),
			array('id, article_id', 'numerical', 'integerOnly'=>true),
            //array('id', 'exists'),
            array('id', 'unique' ),
            array('tempDate', 'date', 'format' => 'dd.mm.yyyy', 'timestampAttribute' => 'time_created'),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, object, change, time_created, date, type, article_id', 'safe'),
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
            'article'     => array(self::BELONGS_TO, 'Article', 'article_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Номер п/п',
			'name' => 'Содержание',
			'object' => 'Object',
			'change' => 'Сумма',
			'time_created' => 'Дата',
            'article_id' => 'Статья расходов',
            'type' => 'Тип',
            'tempDate' => 'Дата'
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
		$criteria->compare('object',$this->object,true);
		$criteria->compare('change',$this->change,true);
        $criteria->compare('type',$this->type,true);
        $criteria->compare('article_id',$this->article_id);
        if( !empty($this->time_created) ) {
            $time = explode(' - ',$this->time_created);
            $criteria->addCondition('time_created >= '.strtotime($time[0]));
            $criteria->addCondition('time_created < '.strtotime($time[1]));
        }
		$criteria->order = "id DESC";
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination' => array('pageSize' => 100),
		));
	}

    public static function registerChange( $name, $change, $object ) {
        $new = new Cashbox();
        $new->name = $name;
        $new->change = $change;
        $new->object = $object;
        $new->type = 'Доход';
        $new->article_id = 2;
        $new->time_created = time();
        $new->save();
    }

    public static function getCurrentBalance() {
        $cashboxs = self::model()->findAll();
        $bal = 0;
        foreach($cashboxs as $cas) {
            $bal += $cas->change;
        }
        return round($bal,2);
    }

    public function getNextId() {
        $criteria = new CDbCriteria;
        $criteria->select='MAX(id) as nextId';
        $product = self::model()->find($criteria);
        return $product->nextId+1;
    }

    public function getIsManual() {
        if( $this->object == 'manual' )
            return true;
        else
            return false;
    }
}