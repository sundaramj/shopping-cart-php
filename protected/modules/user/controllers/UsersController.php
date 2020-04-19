<?php

class UsersController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='main';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','create'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update','dashboard','addcart','removecart','CheckOut','Success'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Users;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			$model->password = md5($_POST['Users']['password']);
			if($model->save())
				$this->redirect(array('default/login'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Users');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Users('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Users']))
			$model->attributes=$_GET['Users'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Users the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Users::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Users $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='users-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actiondashboard(){
		
		$dataProvider=new CActiveDataProvider('Products');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function	actionaddcart(){
		
		// Yii::app()->session['cart_item'] = array();
		$cart_added = Yii::app()->session['cart_item'];
		if(!empty($cart_added)){
			if(!in_array($_GET['id'], $cart_added)){
					$cart_added[$_GET['id']] = $_GET['id'];
			}else{
				echo 'Already added in cart';
			}
		}else{
			$cart_added[$_GET['id']] = $_GET['id'];
		}
		Yii::app()->session['cart_item'] = $cart_added;
		$this->redirect(array('/user/users/CheckOut'));
		
	}

	public function	actionremovecart(){
		
		// Yii::app()->session['cart_item'] = array();
		$cart_added = Yii::app()->session['cart_item'];
		
		if(!empty($cart_added)){
			if(in_array($_GET['id'], $cart_added)){
				echo $cart_added[$_GET['id']];
					unset($cart_added[$_GET['id']]);
			}
		}		
		Yii::app()->session['cart_item'] = $cart_added;
		$this->redirect(array('/user/users/dashboard'));
	}

	public function	actionCheckOut(){

		$data = Products::getCartData();
		if(!$data){
			throw new CHttpException(400, 'No data in cart');
		}
		$payMode = PaymentMode::getPayMode();		
		
		$modelOrders = new Orders;		
		$modelOrdersDetails = new OrdersDetails;
		// save data on post
		if(!empty($_POST['Orders']) && !empty($_POST['OrdersDetails'])){
			$DBtransaction = Yii::app()->db->beginTransaction();			
			try {							
				$savedOrderId = Orders::saveData($_POST);
				$DBtransaction->commit();
				Yii::app()->session['cart_item'] = array(); // after checkout destroy cart
				$this->redirect(array('/user/users/success','order_id' => $savedOrderId));
			} catch (Exception $e) {
				echo "<hr /><h1>DEBUG</h1><pre>";
				print_r($e->getMessage());
				echo "</pre>";
				die();				
				$DBtransaction->rollback();
			}					
		}
		$this->render('checkout',array(
			'model' => $modelOrders,
			'modelOrdersDetails' => $modelOrdersDetails,
			'data' => $data,
			'payMode' => $payMode	
		));
	}

	public function actionSuccess(){
		$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : "";
		$this->render('success',array('order_id' => $order_id));
	}
}
