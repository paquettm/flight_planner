<?php 
namespace app\controllers;

class User extends \app\core\Controller{

	function index(){//login here
		if(!isset($_POST['action'])){//there is no form being submitted
			$this->view('User/login');
		}else{//there is a form submitted
			$user = \app\daos\User::get($_POST['username']);
			if($user != false){
				if(password_verify($_POST['password'],$user->password_hash)){
					//yay! login - store that state in a session
					$_SESSION['username'] = $user->username;

//user logging in may have flights in their cart and flights in their account
//the user_id in the cookie may not match that of the unconfirmed flights
//must update
					$old_user_id = get_user_id();
					$new_user_id = $user->user_id;

					if ($old_user_id != $new_user_id)
					    \app\daos\Trip::updateUserId($old_user_id,$new_user_id);

					set_user_id($new_user_id);

					if(isset($_SESSION['redirect'])){
						header('location:' . $_SESSION['redirect']);
						unset($_SESSION['redirect']);
					}elseif(isset($_GET['redirect'])){
						header('location:' . $_GET['redirect']);
						unset($_GET['redirect']);
					}else{
						header('location:/Flight/index');

					}
				}else{
					//not the correct password
					$this->view('User/login','Incorrect username/password combination.');
				}
			}else{
				$this->view('User/login','Incorrect username/password combination.');
			}
		}
	}

	function register(){//register here
		if(!isset($_POST['action'])){//there is no form being submitted
			$this->view('User/register');
		}else{//there is a form submitted
			$newUser = new \app\models\User();
			$newUser->user_id = get_user_id();//generated upfront
			$newUser->username = $_POST['username'];
			$newUser->password = $_POST['password'];
			$newUser->password_confirm = $_POST['password_confirm'];
			if($_POST['password'] != $_POST['password_confirm'] || empty($_POST['password'])){
				header('location:/User/register?error=password need be nonempty and must match!');
				return;
			}

			if($newUser->exists()){
				header('location:/User/register?error=The user account with that email address already exists.');
				return;
			}

			if($newUser->numberExists()){
				header('location:/User/register?error=The user account with that number already exists.');
				return;
			}
			 	
			$newUser->password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

		 	if($newUser->insert()){
				header('location:/User/index');
			}
			else
			{
				header('location:/User/register?error=FAIL!');
			}
		}
	}

	#[\app\filters\Login]
	function logout(){
		session_destroy();//deletes the session ID and all data
		delete_user_id();
		header('location:' . ($_GET['redirect']??'/User/index'));
	}

}
