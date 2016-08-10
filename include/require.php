<?php
session_start();
defined("D") ? NULL : define("D",DIRECTORY_SEPARATOR); // get the /(slash) 
defined("SITE_ROOT") ? NULL : define("SITE_ROOT", D."wamp".D."www".D."speedyFlexi"); //site root folder
defined("LIB_PATH") ? NULL : define("LIB_PATH", SITE_ROOT.D."include");// site libarey
defined("SERVER")?NULL:define("SERVER","http://".$_SERVER['SERVER_NAME']);

//Database class
require_once("db.class.php");

//load functions
//require_once("main.func.php");
include_once("myvar.php");
require_once("extra.func.php");
//Extra Class
require_once("login.cls.php");
require_once("sendflex.cls.php");
//<!--  -->require_once("sc.php");


if(server(true)."/login.php" != server().$_SERVER['PHP_SELF'])
{
	$log->auth(urldecode(server().$_SERVER['PHP_SELF']));
}

?>