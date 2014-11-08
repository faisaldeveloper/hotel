<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{

	 // Need to store the user's ID:
	 private $_id;
	 

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
		$user = User::model()->findByAttributes(array('username'=>$this->username, 'password'=>$this->password));

		if ($this->username !== $user->username) { // No user found!		
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		} else if ($user->password !== $this->password ) { // Invalid password!//SHA1($this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		}else { // Okay!		
		$branch = HmsBranches::model()->find(
		array('condition'=>'branch_id=:branch_id and expiry_date > :expdate','params'=>array('branch_id'=>$user->hotel_branch_id,'expdate'=>date('Y-m-d'))
		));
		
				if($branch->branch_id > 0){				
					$this->errorCode=self::ERROR_NONE;
					// Store the role in a session:
					//$this->setState('role', $user->role);			
					$this->_id = $user->id;			
					$this->setState("branch_id",$user->hotel_branch_id);
					$this->setState("hotel_id",$user->hotel_id);			
					/*$session=new CHttpSession;
					$session->open();
					$session['hotel_branch_id']=$user->hotel_branch_id;
					$session->close();*/  
				}else{//else if branch_id>0
					//$this->errorCode=self::ERROR_UNKNOWN_IDENTITY;
					$this->errorCode=self::ERROR_VALIDITY_INVALID;
				}		
		return !$this->errorCode;		
		} //end main else
	}
	
	public function getId()
	{
	 return $this->_id;
	}
	
	
	
}