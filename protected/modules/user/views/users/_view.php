<?php
/* @var $this UsersController */
/* @var $data Users */
$cart_item = isset(Yii::app()->session['cart_item']) ? Yii::app()->session['cart_item'] : "";
$cart_data = false;
if(!empty($cart_item)){
	if(in_array($data->id, $cart_item)){
		$cart_data = true;
	}
}
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::encode($data->id); ?>
	<?php if(!$cart_data){ ?>
	<?php echo CHtml::link(CHtml::encode('Add to cart'), array('addcart', 'id'=>$data->id)); ?>
		<?php }else{ ?>
	<?php echo CHtml::link(CHtml::encode('Remove cart'), array('removecart', 'id'=>$data->id)); ?>
		<?php } ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />


</div>