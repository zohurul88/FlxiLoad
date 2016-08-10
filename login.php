<?php
	include_once("include/require.php");
	$error="";
	if(isset($_GET["next"]))
	{
		$next=$_GET["next"];
	}
	else
	{
		$next="request_flexi.php";
	}
	if(isset($_POST["submit"]))
	{
		$error=$log->login($_POST["user"],$_POST["pass"],$next);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
	echo $error;
?>
<form action="" method="post">
	<input type="text" name="user" />
	<input type="password" name="pass" />
	<input type="submit" name="submit" />
</form></body>
</html>