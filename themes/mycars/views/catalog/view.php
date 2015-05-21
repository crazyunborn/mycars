<?php
/* @var $this CatalogController */
/* @var $model Catalog */

$model->name = $model->brand.' '.$model->model.' '.$model->options;

$this->breadcrumbs=array(
	'Catalogs'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Catalog', 'url'=>array('index')),
	array('label'=>'Create Catalog', 'url'=>array('create')),
	array('label'=>'Update Catalog', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Catalog', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Catalog', 'url'=>array('admin')),
);
?>

<div style="float:left; margin-right:10px;">
	<img src="<?=$model->foto?>" style="width:300px;">
</div>
<div style="float:left;width:400px;">
	<h1>
		<?php echo $model->brand.' '.$model->model.' '.$model->options; ?>
	</h1>
	<?php echo $model->desc; ?>
</div>
<?php 
/*
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'brand',
		'model',
		'options',
		'foto',
		'name',
		'desc',
	),
)); 
*/
?>
