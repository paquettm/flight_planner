<?php
function unique(){
	return uniqid('user',true);
}
function get_user_id(){
	return $_COOKIE['user_id'];	
}
function set_user_id($user_id){
	setcookie('user_id',$user_id,0,'/');
	$_COOKIE['user_id'] = $user_id;
}
function delete_user_id(){
	setcookie('user_id',null,-1,'/');
	unset($_COOKIE['user_id']);
}

if(!isset($_COOKIE['user_id'])){
	set_user_id(unique());
}//as a cookie so an anonymous user can come back later