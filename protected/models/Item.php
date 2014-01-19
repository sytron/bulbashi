<?php

/**
 * This is the model class for table "items".
 *
 * The followings are the available columns in table 'items':
 * @property integer $id
 * @property string $name
 * @property integer $category_id
 * @property integer $amount
 * @property integer $price_z
 * @property integer $price_s
 * @property integer $price_m
 * @property string $dependence
 * @property string $barcode
 * @property string $unit
 * @property integer $minimal_amount
 */
class Item extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Item the static model class
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
		return 'items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, category_id, amount, price_z, price_s, price_m, minimal_amount', 'required'),
			array('category_id', 'numerical', 'integerOnly'=>true),
			array('name, barcode', 'length', 'max'=>255),
			array('unit', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, category_id, amount, price_z, price_s, price_m, dependence, barcode, unit, minimal_amount', 'safe', 'on'=>'search'),
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
            'category'     => array(self::BELONGS_TO, 'ItemsCategory', 'category_id'),
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
			'name' => 'Название',
			'category_id' => 'Категория',
			'amount' => 'Количество на складе',
			'price_z' => 'Цена закупочная',
			'price_s' => 'Цена стандартная',
			'price_m' => 'Цена малооптовая',
			'dependence' => 'Зависимость',
			'barcode' => 'Штрих-код',
			'unit' => 'Единица',
			'minimal_amount' => 'Минимальное количество на складе',
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
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('price_z',$this->price_z);
		$criteria->compare('price_s',$this->price_s);
		$criteria->compare('price_m',$this->price_m);
		$criteria->compare('dependence',$this->dependence,true);
		$criteria->compare('barcode',$this->barcode,true);
		$criteria->compare('unit',$this->unit,true);
		$criteria->compare('minimal_amount',$this->minimal_amount);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination' => array('pageSize' => 100),
		));
	}

    public static function getArrayOfItems( ) {
        $res = array();

        $categories = ItemsCategory::model()->findAll();
        foreach( $categories as $category ) {
            $items = self::model()->findAllByAttributes(array('category_id'=>$category->id));
            foreach( $items as $item ) {
                $res[$category->name][$item->id] = $item->name;
            }

        }

        return $res;
    }

    static function getArrayListAll() {
        $items = self::model()->findAll();
        $res = array();
        $res[0] = 'Выберите товар';
        foreach( $items as $v ) {
            $res[$v->id] = $v->name;
        }
        return $res;
    }

    public function isConnectedToModel ( $modelId ) {
    	$im = ItemsModels::model()->countByAttributes(array('item_id'=>$this->id, 'model_id'=>$modelId ));
    	if( $im > 0 ) {
    		return true;
    	} else {
    		return false;
    	}
    }
}