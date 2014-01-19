<?php

/**
 * This is the model class for table "booking".
 *
 * The followings are the available columns in table 'booking':
 * @property integer $id
 * @property string $day
 * @property string $time
 * @property integer $type
 * @property string $name
 * @property integer $phone
 */
class Booking extends CActiveRecord
{
    public $checked = 0;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Booking the static model class
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
		return 'booking';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('day, time, type', 'required'),
			array('type', 'numerical', 'integerOnly'=>true),
			array('day, time', 'length', 'max'=>20),
			array('name, phone', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, day, time, type, name, phone, comment', 'safe'),
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
			'day' => 'Дата',
			'time' => 'Время',
			'type' => 'Тип работы',
			'name' => 'Имя',
			'phone' => 'Телефон',
            'comment' => 'Комментарий'
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
		$criteria->compare('day',$this->day,true);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('type',$this->type, true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('phone',$this->phone,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination' => array('pageSize' => 100),
		));
	}

     public static function convTypeName( $type ) {
         switch( $type ) {
             case 1 : return 'Замена масла'; break;
             case 2 : return 'Другое'; break;
             case 3 : return 'Обслуживание тормозных систем'; break;
         }
    }

    public function getTypeName( ) {
        switch( $this->type ) {
            case 1 : return 'Замена масла'; break;
            case 2 : return 'Другое'; break;
            case 3 : return 'Обслуживание тормозных систем'; break;
        }
    }

    static public function getTypes()
    {
        return array(
            array('id'=>'1', 'title'=>'Замена масла'),
            array('id'=>'3', 'title'=>'Обслуживание тормозных систем'),
            array('id'=>'2', 'title'=>'Другое'),
        );
    }

    public static function getAllTimes($type) {
        if( $type == 1 ) { // Замена масла
            return array(
                '10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '13:00', '13:30', '14:00', '14:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00', '18:30', '19:00', '19:30', '20:00', '20:30', '21:00', '21:30'
            );
        }
        if( $type == 3 ) { // Обслуживание тормозных систем
            return array(
                '10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '13:00', '13:30', '14:00', '14:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00', '18:30', '19:00', '19:30', '20:00', '20:30', '21:00', '21:30'
            );
        }
        if( $type == 2 ) { // Остальное
            return array(
                '10:00', '11:00', '12:00', '13:00', '14:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00'
            );
        }
        return array();

    }

    public static function isTimeFree($day, $time, $type) {
        if( $type == 1 ) {
            $test = self::model()->findAllByAttributes(array('day'=>$day, 'time'=>$time, 'type'=>1 ));
            if( count($test) > 0 )
                return false;
            $test = self::model()->findAllByAttributes(array('day'=>$day, 'time'=>$time, 'type'=>2 ));
            if( count($test) > 0 )
                return false;
        }

    }
}