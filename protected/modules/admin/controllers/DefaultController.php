<?php

class DefaultController extends Controller
{

	public $layout='/layouts/main';

	public function actionIndex()
	{		
		$this->render('index');
	}

	public function actionLogin()
	{
		if(Yii::app()->session['user_id']){
			$this->redirect(array('/admin/category/index'));
		}

		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			// echo $model->login();
			// echo $model->validate();exit;
			if($model->validate() && $model->login())
				// echo Yii::app()->user->returnUrl;exit;
				$this->redirect(Yii::app()->getModule('admin')->user->loginUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->getModule('admin')->user->loginUrl);
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
}