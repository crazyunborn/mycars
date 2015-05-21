<?php

/**
 * This is the model class for table "catalog".
 *
 * The followings are the available columns in table 'catalog':
 * @property integer $id
 * @property string $brand
 * @property string $model
 * @property string $options
 * @property string $foto
 * @property string $name
 * @property string $desc
 */
class Catalog extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'catalog';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('brand, model, options, foto, name, desc', 'required'),
			array('brand, model, options, foto, name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, brand, model, options, foto, name, desc', 'safe', 'on'=>'search'),
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
			'brand' => 'Brand',
			'model' => 'Model',
			'options' => 'Options',
			'foto' => 'Foto',
			'name' => 'Name',
			'desc' => 'Desc',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('brand',$this->brand,true);
		$criteria->compare('model',$this->model,true);
		$criteria->compare('options',$this->options,true);
		$criteria->compare('foto',$this->foto,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('desc',$this->desc,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Catalog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function selectShowenBrands(){
        $models = self::model()->findAll();
        return CHtml::listData($models, 'brand', 'brand');
	}

	public static function selectShowenModels($brand){
        $atts = self::model()->findAllByAttributes(array('brand'=>$brand));
        return CHtml::listData($atts, 'model', 'model');
	}

	public static function selectShowenOptions($model){
        $atts = self::model()->findAllByAttributes(array('model'=>$model));
        return CHtml::listData($atts, 'id', 'options');
	}

	public static function selectShowenCar($options){
        $atts = self::model()->findAllByAttributes(array('options'=>$options));
        return CHtml::listData($atts, 'id', 'options');
	}
}
