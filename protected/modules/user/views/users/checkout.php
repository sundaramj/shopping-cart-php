
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<?php			
		$model->payment_type =1;
		echo $form->radioButtonList($model,'payment_type',$payMode); 
	?>
	<br/><br/><br/>
	<?php foreach ($data as $key => $value) { ?>
		<div class="row" style="width: 200px;float: left;">
			<h3>Product <?php echo $key+1; ?></h3>
			<p>Product: <?php echo $value['title'];?></p>
			<p>Price: <?php echo $value['price'];?></p>
		</div>
	<?php echo $form->hiddenField($modelOrdersDetails,"[$key]product_id",array('value' => $value['id'],'size'=>50,'maxlength'=>50)); ?>	
	<?php echo $form->hiddenField($modelOrdersDetails,"[$key]price",array('value' => $value['price'],'size'=>50,'maxlength'=>50)); ?>
	<?php } ?>

	<br/>
	<div class="row buttons clear">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
