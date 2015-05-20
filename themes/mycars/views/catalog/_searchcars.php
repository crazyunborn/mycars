Марка<span class="red">*</span>:<br />
<?php echo CHtml::dropDownList($model, 'brand', Catalog::selectShowenBrands(), array(
	'empty'=>Yii::t('default', 'Выберите марку'),
    'id' => 'brand-input',
    'ajax' => array(        
                'type'=>'GET',
                'url'=>$this->createUrl('/catalog/getNeededModels'),
                'update'=>'#models',
                'data'=>array(
                    'brand'=> 'js:this.value',
                ),
                'success' => 'function(html){
	                           jQuery("#models").html(html);
	                       }',
                         
)));
?>
<span id="models"></span>
<span id="options"></span>