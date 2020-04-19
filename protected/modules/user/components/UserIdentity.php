<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{	
		// echo md5($this->password);exit;
		$this->password = md5($this->password);
		$model = Users::model()->find('email = :email and password = :password and active =:active',
			array(':email' => $this->username,':password' => $this->password,':active'=>'1')
		);//md5($this->password)
		$users = array();
		if(!empty($model)){
			$users[$model->email] = $model->password;			
		}		
		
		if(!isset($users[$this->username])){			
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		}elseif($users[$this->username]!==$this->password){			
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		}else{	
			$this->errorCode=self::ERROR_NONE;
			Yii::app()->session['user_id'] = $model->id;
		}
		return !$this->errorCode;
	}
}
