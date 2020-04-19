<?php
/* @var $this AdminMstrController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Admin Mstrs',
);

$this->menu=array(
	array('label'=>'Create AdminMstr', 'url'=>array('create')),
	array('label'=>'Manage AdminMstr', 'url'=>array('admin')),
);
?>

<h1>Admin Mstrs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
