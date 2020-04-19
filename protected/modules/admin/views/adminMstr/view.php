<?php
/* @var $this AdminMstrController */
/* @var $model AdminMstr */

$this->breadcrumbs=array(
	'Admin Mstrs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List AdminMstr', 'url'=>array('index')),
	array('label'=>'Create AdminMstr', 'url'=>array('create')),
	array('label'=>'Update AdminMstr', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete AdminMstr', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AdminMstr', 'url'=>array('admin')),
);
?>

<h1>View AdminMstr #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'email',
		'password',
		'role_id',
		'active',
		'created_at',
	),
)); ?>
