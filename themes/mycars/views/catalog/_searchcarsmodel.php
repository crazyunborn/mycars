<div style="float:left; width:150px; margin-right:50px;">
    Модель:<br />
    <span id="models">
    <?php
    	if (isset($dataProvider)) {
    	echo CHtml::dropDownList($model, 'model', $dataProvider, array(
    	'empty'=>Yii::t('default', 'Выберите модель'),
        'id' => 'model-input',
        'ajax' => array(        
                    'type'=>'GET',
                    'url'=>$this->createUrl('/catalog/getNeededOptions'),
                    'update'=>'#hideoptions',
                    'data'=>array(
                        'model'=> 'js:this.value',
                    ),
                    'success' => 'function(html){
    	                           jQuery("#hideoptions").html(html);
    	                       }',
                             
    	)));
    	}
    	?>
    </span>
</div>
<span id="hideoptions"></span>