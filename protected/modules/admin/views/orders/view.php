<?php
/* @var $this OrdersController */
/* @var $model Orders */

$this->breadcrumbs=array(
	'Orders'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Orders', 'url'=>array('index')),
	array('label'=>'Create Orders', 'url'=>array('create')),
	array('label'=>'Update Orders', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Orders', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Orders', 'url'=>array('admin')),
);
?>

<h1>View Orders #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'paymentType.name',
		'StatusName',		
		'user.name',
		'created_at',
	),
)); ?>
<br/>
<h1>Order Details</h1>
<?php 
if(isset($modelOrders) && !empty($modelOrders)){ 
	foreach ($modelOrders as $key => $value) { 	
		echo "<h3>Product {$key}</h3>";
		echo "Sub-order id: {$value->id}";
		echo '<br>';
		echo "Product: {$value->product->title}";
		echo '<br>';
		echo "Price: {$value->price}";
		echo '<br>';
		echo '<hr>';
	}
} ?>	