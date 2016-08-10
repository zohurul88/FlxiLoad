<?php
	function redirect($location=""){
		if($location != NULL){
			header("location: {$location}");
			exit();
		}
	}
	
	function layout($page)
	{
			require_once(SITE_ROOT.D."layout".D.$page.".php");
	}
	
	function __autoload($class_name) {
		$class_name = strtolower($class_name); 
		$path =LIB_PATH.D."{$class_name}.php"; 
		if(file_exists($path)) {
				require_once($path);  
			}else {
				die("The file {$class_name}.php could not found"); 
				}
	}
	
	function rrmdir($dir) {
    foreach(glob($dir . '/*') as $file) {
        	if(is_dir($file)){
            	rrmdir($file);
			}else{
            	unlink($file);
			}
    	}
    	rmdir($dir);
	}
	
	function cPage() {
			 $pageURL = 'http';
			 if(isset($_SERVER['HTTPS'])){
			 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
			 }
			  $pageURL .= "://";
			 if ($_SERVER["SERVER_PORT"] != "80") {
			  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
			 } else {
			  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
			 }
			 return urlencode($pageURL);
			}
	
	function 	fextcheck($filename){
		$ext=pathinfo($filename,PATHINFO_EXTENSION);
		if($ext=="jpg" || $ext=="png" || $ext=="GIF")
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	
		
		
?>