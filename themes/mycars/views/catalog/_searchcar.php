<div style="float:left; width:100px;">
<br />
    <?php
         echo CHtml::link('Показать', array('catalog/view', 'id'=>$dataProvider['id'],'url1'=>$dataProvider['brand'],'url2'=>$dataProvider['model'],'url3'=>$dataProvider['options']));
    ?>
</div>