<?php

//SMS via GSM Modem - A PHP class to send SMS messages via a GSM modem attached to the computers serial port.

//Windows only (tested on XP with PHP 5.2.6)
//Tested with the EZ863 (Telit GE863) GSM modem
//Requires that PHP has permission to access "COM" system device, and system "mode" command

error_reporting(E_ALL);

//Example

$gsm_send_sms = new gsm_send_sms();
$gsm_send_sms->debug = false;
$gsm_send_sms->port = 'COM27';
$gsm_send_sms->baud = 9600;
$gsm_send_sms->init();

/*$status = $gsm_send_sms->send('+8801716036453', 'testing 123');
if ($status) {
	echo "Message sent\n";
} else {
	echo "Message not sent\n";
}*/

/*$status = $gsm_send_sms->send('+44123456789', 'testing 456');
if ($status) {
	echo "Message sent\n";
} else {
	echo "Message not sent\n";
}*/

$gsm_send_sms->close();

//Send SMS via serial SMS modem
class gsm_send_sms {

	public $port ;//= 'COM27';
	public $baud;// = 9600;

	public $debug = false;

	private $fp;
	private $buffer="";

	//Setup COM port
	public function init() {

		$this->debugmsg("Setting up port: \"{$this->port} @ \"{$this->baud}\" baud");

		exec("MODE {$this->port}: BAUD={$this->baud} PARITY=N DATA=8 STOP=1", $output, $retval);

		if ($retval != 0) {
			//throw new Exception('Unable to setup COM port, check it is correct');
			echo 'Unable to setup COM port, check it is correct';
		}

		$this->debugmsg(implode("\n", $output));

		$this->debugmsg("Opening port");

		//Open COM port
		$this->fp = fopen($this->port , 'r+');

		//Check port opened
		if (!$this->fp) {
			//throw new Exception("Unable to open port \"{$this->port}\"");
			echo "Unable to open port \"{$this->port}\"";
		}

		$this->debugmsg("Port opened");
		$this->debugmsg("Checking for responce from modem");

		//Check modem connected
		fwrite($this->fp, "AT\r");

		//Wait for ok
		$status = $this->wait_reply("OK", 5);

		if (!$status) {
			//throw new Exception('Did not receive responce from modem');
			echo 'Did not receive responce from modem';
		}

		$this->debugmsg('Modem connected');

		//Set modem to SMS text mode
		$this->debugmsg('Setting text mode');
		fwrite($this->fp, "AT+CMGF=1");

		$status = $this->wait_reply("OK\r\n", 5);

		if (!$status) {
			//throw new Exception('Unable to set text mode');
			echo 'Unable to set text mode';
		}

		$this->debugmsg('Text mode set');

	}

	//Wait for reply from modem
	private function wait_reply($expected_result, $timeout) {

		$this->debugmsg("Waiting {$timeout} seconds for expected result");

		//Clear buffer
		$this->buffer = '';

		//Set timeout
		$timeoutat = time() + $timeout;

		//Loop until timeout reached (or expected result found)
		do {

			$this->debugmsg('Now: ' . time() . ", Timeout at: {$timeoutat}");

			$buffer = fread($this->fp, 1024);
			$this->buffer .= $buffer;
			echo $this->buffer;
			usleep(200000);//0.2 sec

			$this->debugmsg("Received: {$buffer}");

			//Check if received expected responce
			if (preg_match('/'.preg_quote($expected_result, '/').'$/', $this->buffer)) {
				$this->debugmsg('Found match');
				return true;
				//break;
			} else if (preg_match('/\+CMS ERROR\:\ \d{1,3}\r\n$/', $this->buffer)) {
				return false;
			}

		} while ($timeoutat > time());

		$this->debugmsg('Timed out');

		return false;

	}

	//Print debug messages
	private function debugmsg($message) {

		if ($this->debug == true) {
			$message = preg_replace("%[^\040-\176\n\t]%", '', $message);
			echo $message . "\n";
		}

	}

	//Close port
	public function close() {

		$this->debugmsg('Closing port');

		fclose($this->fp);

	}

	//Send message
	public function send($tel, $message) {

		//Filter tel
		$tel = preg_replace("%[^0-9\+]%", '', $tel);

		//Filter message text
		$message = preg_replace("%[^\040-\176\r\n\t]%", '', $message);

		$this->debugmsg("Sending message \"{$message}\" to \"{$tel}\"");

		//Start sending of message
		fputs($this->fp, "AT+CMGS=\"{$tel}\"\r");

		//Wait for confirmation
		$status = $this->wait_reply("\r\n> ", 5);

		if (!$status) {
			//throw new Exception('Did not receive confirmation from modem');
			$this->debugmsg('Did not receive confirmation from modem');
			return false;
		}

		//Send message text
		fputs($this->fp, $message);

		//Send message finished indicator
		fputs($this->fp, chr(26));

		//Wait for confirmation
		$status = $this->wait_reply("OK\r\n", 180);

		if (!$status) {
			//throw new Exception('Did not receive confirmation of messgage sent');
			$this->debugmsg('Did not receive confirmation of messgage sent');
			return false;
		}

		$this->debugmsg("Message sent");

		return true;

	}

}

?>