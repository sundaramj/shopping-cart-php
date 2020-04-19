<?php
/* @var $this AdminMstrController */
/* @var $model AdminMstr */

$this->breadcrumbs=array(
	'Admin Mstrs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AdminMstr', 'url'=>array('index')),
	array('label'=>'Manage AdminMstr', 'url'=>array('admin')),
);
?>

<h1>Sign up</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>