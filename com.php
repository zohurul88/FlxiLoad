<?php
	
	exec("MODE COM27: BAUD=9600 PARITY=N DATA=8 STOP=1", $output, $retval);
	$fp = fopen("COM27" , 'r+');
			if (!$fp) {
			//throw new Exception("Unable to open port \"{$this->port}\"");
			echo "Unable to open port COMP27";
		}
		else
		{
			echo "COM27 Open";
		}
		fwrite($fp, chr(65).chr(84).chr(13));
		//fwrite($fp, "658443677713");
		echo fread($fp,1024);
		
?>