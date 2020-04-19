<?php

class AdminModule extends CWebModule
{
	
	public function init()
	{
		$this->setImport(array(
			'admin.models.*',
			'admin.components.*',
		));
		$this->setComponents(array(
            'errorHandler' => array(
                'errorAction' => 'admin/default/error'),
            'user' => array(
                'class' => 'CWebUser',             		                
                'loginUrl' => Yii::app()->createUrl('admin/default/login'),
            )
        ));

		Yii::app()->user->setStateKeyPrefix('_admin');
	}

	public function beforeControllerAction($controller, $action) {
		
        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here
            $route = $controller->id . '/' . $action->id;
           // echo $route;
            $publicPages = array(
                'default/login',
                'default/error',
                'adminmstr/create'
            );  

            if (Yii::app()->user->isGuest && !in_array($route, $publicPages)){                        	
                Yii::app()->getModule('admin')->user->loginRequired();                
            }
            else
                return true;
        }
        else
            return false;
    }
}
