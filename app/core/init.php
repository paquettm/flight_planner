<?php
	//TODO: more initialization goes in this file
	session_start();
	require_once('vendor/autoload.php');
	require_once('app/core/autoload.php');
	include_once('app/core/i18n.php');
	include_once('app/core/users.php');
	\app\core\DAO::connect();