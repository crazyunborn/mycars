<?php
/* @var $this CatalogController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle=' Каталог - '.Yii::app()->name;
$this->breadcrumbs=array(
	'Каталог',
);

$this->menu=array(
	array('label'=>'Create Catalog', 'url'=>array('create')),
	array('label'=>'Manage Catalog', 'url'=>array('admin')),
);
?>

<h1>Каталог автомобилей</h1>

<p>Сдесь будет ajax выборка</p>
<?php $this->renderPartial('_searchcars', array('model'=>$model)); ?>


<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>