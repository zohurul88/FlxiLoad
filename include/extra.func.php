<?php 
//include_once("myvar.php");
function get_browser_info() {
  global $os;
  global $browser;
  global $version;
  $agent = $_SERVER['HTTP_USER_AGENT'];
  
  // Browsing Platform
  if (preg_match("/X11/", $agent)) { // UNIX, Linux, ...
    if (preg_match("/linux/i", $agent)) {
      $os = "Linux";
    } else {
      $os = "UNIX";
    }
  } elseif (preg_match("/mac/i", $agent)) {
    $os = "Macintosh";
  } elseif (preg_match("/msie|mspie|windows|win32/i",$agent)) {
    $os = "Windows";
  } elseif (preg_match("/linux/i", $agent)) { // for non-X11 browsers
    $os = "Linux";
  } else {
    $os = "Unknown";
  }
  
  // Now get the browser -- Order is important...
  $replace = '${1}';
  if (preg_match("/opera\//i",$agent)) {
    $browser = "Opera";
    $version = preg_replace("/^.*opera\/([^; ]+)[; ].*$/i", "$replace", $agent);
  } elseif (preg_match("/chrome\//i",$agent)) {
    $browser = "Google Chrome";
    $version = preg_replace("/^.*chrome\/([^; ]+)[; ].*$/i", "$replace", $agent);
  } elseif (preg_match("/firefox/i",$agent)) {
    $browser = "Firefox";
    $version = preg_replace("/^.*firefox\/([^; ]+)[; ].*$/i", "$replace", $agent);
  } elseif (preg_match("/iceweasel/i",$agent)) {
    $browser = "Firefox";
    $version = preg_replace("/^.*iceweasel\/([^; ]+)[; ].*$/i", "$replace", $agent);
  } elseif (preg_match("/netscape/i",$agent)) {
    $browser = "Netscape";
    $version = preg_replace("/^.*netscape\/([^; ]+)[; ].*$/i", "$replace", $agent);
  } elseif (preg_match("/safari/i",$agent)) {
    $browser = "Safari";
    $version = preg_replace("/^.*safari\/([^; ]+)[; ].*$/i", "$replace", $agent);
  } elseif (preg_match("/lynx/i",$agent)) {
    $browser = "Lynx";
    $version = preg_replace("/^.*lynx\/([^; ]+)[; ].*$/i", "$replace", $agent);
  } elseif (preg_match("/MSIE/i", $agent)) {
    $browser = "Internet Explorer";
    $version = preg_replace("/^.*msie[\/ ]([^; ]+)[; ].*$/i", "$replace", $agent);
  } else {
    $browser = "Other";
    $version = "Unknown";
  }
  return $browser." - ".$os;
}


	function limit_words($string, $word_limit){
			$words = explode(" ",$string);
			return implode(" ",array_splice($words,0,$word_limit));
			}
			
	function server($ofline=false)
	{
		$pageURL = 'http';
			 if(isset($_SERVER['HTTPS'])){
			 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
			 }
			  $pageURL .= "://";
			 if ($_SERVER["SERVER_PORT"] != "80") {
			  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"];
			 } else {
			  $pageURL .= $_SERVER["SERVER_NAME"];
			 }
			 if($ofline){
				 $pageURL .="/speedyflexi";
				 }
				return $pageURL;
			
	}
	function get_client_ip() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {   //check ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    } 
	//preg_match('/<img.+src=[\'"](?P<src>.+)[\'"].*>/i', $con[2], $image);
	function oparetor($me="")
		{
			global $oparetor;
			$option="";
			if($me=="" || $me==false)
			{
				$option="";
			}
			else
			{
				$option.='<option value="0">None</option>';
			}
			for($i=1; $i<=count($oparetor); $i++)
			{
				$option.='<option value="'.($i).'">'.$oparetor[$i].'</option>';
			}
			return $option;
		}
		
		function number_type($me="")
		{
			global $num_type;
			$option="";
			if($me=="" || $me==false)
			{
				$option="";
			}
			else
			{
				$option.='<option value="0">None</option>';
			}
			for($i=1; $i<=count($num_type); $i++)
			{
				$option.='<option value="'.($i).'">'.$num_type[$i].'</option>';
			}
			return $option;
		}
?>