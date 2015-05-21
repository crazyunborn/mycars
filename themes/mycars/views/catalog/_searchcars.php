<div style="float:left; width:150px; margin-right:50px;">
	Марка:<br />
	<?php echo CHtml::dropDownList($model, 'brand', Catalog::selectShowenBrands(), array(
		'empty'=>Yii::t('default', 'Выберите марку'),
	    'id' => 'brand-input',
	    'ajax' => array(        
	                'type'=>'GET',
	                'url'=>$this->createUrl('/catalog/getNeededModels'),
	                'update'=>'#hidebramd',
	                'data'=>array(
	                    'brand'=> 'js:this.value',
	                ),
	                'success' => 'function(html){
		                           jQuery("#hidebramd").html(html);
		                       }',
	                         
	)));
	?>
</div>
<span id="hidebramd"></span>
