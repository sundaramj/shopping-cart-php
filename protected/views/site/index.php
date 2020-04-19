<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>
<h1>
<?php echo CHtml::link(CHtml::encode('Admin Login'), array('admin/default/login')); ?>
</h1>
<h1>
<?php echo CHtml::link(CHtml::encode('User Login'), array('user/default/login')); ?>
</h1>