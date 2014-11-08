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
	public function authenticate()
	{
		//echo "<script>alert('".$this->username."')</script9>";
		//echo "<script>alert('".$this->password."')</script9>";
		$user = Logins::model()->findByAttributes(array('username'=>$this->username,'password'=>$this->password));

		

		if ($this->username !== $user->username) { // No user found!		
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		} else if ($user->password !== $this->password ) { // Invalid password!//SHA1($this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		}else{
			
			 $this->errorCode=self::ERROR_NONE;	
			 $this->_id = $user->id;	
			// $this->setState("branch_id",1);
			 //$this->setState("hotel_id",1);
		}
		return !$this->errorCode;
	}
	
	public function getId()
	{
	 return $this->_id;
	}
	
	
	
}