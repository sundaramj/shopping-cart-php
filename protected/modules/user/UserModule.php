<?php

class UserModule extends CWebModule
{
	
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application		
		// import the module-level models and components	
		$this->setImport(array(
			'user.models.*',
			'user.components.*',
		));
		$this->setComponents(array(
            'errorHandler' => array(
                'errorAction' => 'admin/default/error'),
            'user' => array(
                'class' => 'CWebUser',             		                
                'loginUrl' => Yii::app()->createUrl('user/default/login'),
            )
        ));        

		Yii::app()->user->setStateKeyPrefix('_user');
	}

	public function beforeControllerAction($controller, $action)
	{
		if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here
            $route = $controller->id . '/' . $action->id;
           // echo $route;
            $publicPages = array(
                'default/login',
                'default/error',
                'users/create',
            );  
			
			
            if (Yii::app()->user->isGuest && !in_array($route, $publicPages)){                        	
                Yii::app()->getModule('user')->user->loginRequired();                
            }
            else
                return true;
        }
        else
            return false;
	}
}
