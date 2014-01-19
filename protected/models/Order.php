<?php

/**
 * This is the model class for table "orders".
 *
 * The followings are the available columns in table 'orders':
 * @property integer $id
 * @property integer $client_id
 * @property integer $status
 * @property integer $time_created
 * @property float $cost
 * @property integer $team_id
 */
class Order extends CActiveRecord
{
    public $withDiscount;
    public $test;
    public $client_car;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Order the static model class
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
		return 'orders';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('client_id, status, time_created, team_id', 'required'),
			array('client_id, status, time_created, team_id', 'numerical', 'integerOnly'=>true),
            array('items', 'length', 'max'=>255000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
            array('id, client_id, status, time_created, cost, items, advice, team_id', 'safe'),
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
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
        return array(
            'client'     => array(self::BELONGS_TO, 'Client', 'client_id'),
            'team'     => array(self::BELONGS_TO, 'Team', 'team_id'),
            //'items'      => array(self::MANY_MANY, 'Item', 'order_items(order_id, item_id)')
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '№',
			'client_id' => 'Клиент',
			'status' => 'Статус',
			'time_created' => 'Создан',
			'cost' => 'Общая сумма',
            'items' => 'Товары',
            'time_created_view' => 'Создан',
            'statusName' => 'Статус',
            'team_id' => 'Бригада',
            'advice' => 'Рекомендации',
            'client_car' => 'Авто'
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

        //$criteria->with = array('client' => array( 'select' => 'model_id' ) );

		$criteria->compare('id',$this->id);
		$criteria->compare('client_id',$this->client_id);
		$criteria->compare('status',$this->status);
        if( !empty($this->time_created) ) {
            $time = explode(' - ',$this->time_created);
            $criteria->addCondition('time_created >= '.strtotime($time[0]));
            $criteria->addCondition('time_created < '.strtotime($time[1]));
        }
        //$criteria->compare('client.model_id',$this->client_car);
        //$this->client_car

		$criteria->compare('cost',$this->cost);
        $criteria->order = "id ASC";
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination' => array('pageSize' => 100),
		));
	}

    public static function getStatusList() {
        return array(
            0 => 'Открыт',
            1 => 'Выполнен частично',
            2 => 'Выполнен полностью',
            3 => 'Закрыт',
        );
    }

    public static function getCarsList() {
        $clients = Client::model()->findAll();

        $res = array();
        foreach($clients as $cl ) {
            if( !empty($cl->model_id) ) {
                $res[$cl->model_id] = $cl->CarName;
            }
        }

        return $res;
    }

    public static function getTeamList() {
        $teams = Team::model()->findAll();
        $res = array();
        $res[0] = '';
        foreach ($teams as $team) {
            $res[$team->id] = $team->name; 
        }
        return $res;
    }

    public function getStatusName() {
        $a = $this::getStatusList();
        return $a[$this->status];
    }

    public function beforeSave() {
        parent::beforeSave();
        if( is_array($this->items) )
            $this->items = serialize( $this->items );
        $client = Client::model()->findByPk($this->client_id);
        $client->time_lastvisit = time();
        $client->save();
        return true;
    }

    public function afterConstruct() {
        parent::afterConstruct();
        $this->items = array();
        return true;
    }


    public function afterFind() {
        parent::afterFind();
        if( !empty($this->items ) ) {
            $this->items = unserialize( $this->items );
        } else {
            $this->items = array();
        }
        return true;
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

    public function gettime_created_view() {
        return date("H:i:s d.m.Y", $this->time_created);
    }

    public static function getItemsForOrder($category_id, $model_id, $discount = 0) {

    	$c3 = new CDbCriteria();
        $c3->compare('category_id', $category_id);
        $items = Item::model()->findAll($c3);

        $result = array();
        foreach($items as $item) {
            if( $item->isConnectedToModel($model_id ) ) {
               if( $item['amount'] < 1 ) {
                    $lable = $item['name'].' (нет в наличии)';    
                } else {
                    $lable = $item['name'];    
                }
                
                $result[] = array_merge(array(
                    'id'=>$item['id'],
                    'label'=>$lable,
                    'value'=>$item['id'],
                    'price'=>round ((empty($discount)?($item['price_s']):(Order::getDiscount()*$item['price_s'])), 2)
                ), $item->attributes);
            }
        }
        return $result;
    }

    public function getisClosed() {
        if( $this->status == 3 ) {
            return true;
        }
        return false;
    }

    public function close() {

        $this->status = 3;
        $this->items = serialize( $this->items );
        $this->save();
        $this->items = unserialize( $this->items );
    }

    public static function getDiscount( ) {
        return 1-0.05;
    }

}