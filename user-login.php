<?php
/**
 * Model User Login
 */

class User{
 
    public static function auth($userId){
        
        $_SESSION['user'] = $userId;
    }

    public static function checkLogged(){
		
        if (isset($_SESSION['user'])){
            return $_SESSION['user'];
        }
    }
 

    public static function isGuest(){
		
        if (isset($_SESSION['user'])){
            return false;
        }
        return true;
    }
	
	
	public function actionIndex(){ 

        if(User::isGuest()){
            require_once('views/login.php');     
        }else{ 

            require_once('views/profile.php');
        }
             
        return true;
    }
 
}