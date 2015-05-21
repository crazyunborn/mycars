<div style="float:left; width:150px; margin-right:50px;">
    Комплектация:<br />
    <span id="options">
    <?php
    	if (isset($dataProvider)) {
    	echo CHtml::dropDownList($model, 'car', $dataProvider, array(
    	'empty'=>Yii::t('default', 'Выберите комплектацию'),
        'id' => 'car-input',
        'ajax' => array(        
                    'type'=>'GET',
                    'url'=>$this->createUrl('/catalog/getNeededCar'),
                    'update'=>'#buttoncar',
                    'data'=>array(
                        'id'=> 'js:this.value',
                    ),
                    'success' => 'function(html){
    	                           jQuery("#buttoncar").html(html);
    	                       }',
                             
    	)));
    	}
    	?>
    </span>
</div>
<span id="buttoncar"></span>