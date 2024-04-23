<?php
function unique(){
	return uniqid('user',true);
}
function get_user_id(){
	return $_COOKIE['user_id'];	
}

if(!isset($_COOKIE['user_id'])){
	setcookie('user_id',unique(),0,'/');
}//as a cookie so an anonymour user can come back later