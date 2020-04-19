<?php
/* @var $this AdminMstrController */
/* @var $model AdminMstr */

$this->breadcrumbs=array(
	'Admin Mstrs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AdminMstr', 'url'=>array('index')),
	array('label'=>'Create AdminMstr', 'url'=>array('create')),
	array('label'=>'View AdminMstr', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage AdminMstr', 'url'=>array('admin')),
);
?>

<h1>Update AdminMstr <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>