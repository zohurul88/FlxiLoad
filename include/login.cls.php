<?php
	
	class Login {
		
		private $table=user;
		//private $utypetab=user;
		private $session=session;
		private $user="username";
		private $pass="password";
		private $uid="user_Id";
		private $login=false;
		
		function __construct(){
			if(isset($_SESSION[$this->session])){
				$this->login=true;
				}
			}
			
		public function is_login($redirect=""){
			if($this->login==true){
				return true;
			}
			return(false);
		}
		
		public function login($user="",$pass="",$next="",$auto=""){
			global $db;
			if($auto=="")
			{
				$auto=false;
			}
			if($user==""){
				return "Username is missing";
				break;
			}
			
			if($pass==""){
				return "Password is missing";
				break;
			}
			if($auto!=true)
			{
				$pass=md5($pass);
			}
			
			$query=$db->query("SELECT * FROM ".$this->table." WHERE ".$this->user."='".$user."' AND ".$this->pass."='".$pass."' LIMIT 1");
			$result=$db->num_rows($query);
			if($result > 0){
				$uInfo=$db->fetch_array($query);
				$ses=array_keys($uInfo);
				$_SESSION[$this->session]=array();
				for($i=0; $i<count($ses); $i++){
					if(gettype($ses[$i])!="string"){
						continue;
					}
					$_SESSION[$this->session][strtoupper($ses[$i])]=$uInfo[$ses[$i]];
					//$_SESSION[strtoupper($ses[$i])]=$uInfo[$ses[$i]];
				} 
				session_write_close();
				$login=true;
				if($next!=""){
				redirect($next);
				}else{
					redirect(server(true));
					}
				}
				else
				{
					return "invalide user or password";
				}	
		}
		
		public function logout($next=""){
			unset($_SESSION[$this->session]);
			if($next==""){
			redirect(server(true));
			}
			else
			{
				redirect($next);
			}
		}
		
		public function auth($next=""){
				if(!$this->is_login()){
					redirect(server(true)."/login.php?next=".$next);
				}
		}
		
		public function create_new($arg=array(),$active,$uniq=NULL)
		{
			$i=1;
			global $db;
			$arg=array_filter($arg);
			$qur_string="INSERT INTO ".$this->table." VALUES(";
			if($uniq==NULL)
			{
				$qur_string.="'',";
			}
			foreach($arg as $key => $value)
			{
				if(gettype($value)=="string")
				{
				$qur_string.="'".$value."'";
				}else{$qur_string.=$value;}
				if($i==count($arg))
				{
					break;
				}
				$qur_string.=",";
				$i++;
			}
			if($active!=NULL)
			{
				$qur_string.=",'YES'";
			}else
			{
				$qur_string.=",'NO'";
			}
			$qur_string.=")";
			
			$result=$db->query($qur_string);
			if($result)
			{
				$result="Account Created";
			}
			else
			{
				$result="Account Create Failed";
			}
			
			return $result;
		}
		
		public function user_by_id($id)
		{
			global $db;
$user=$db->fetch_array($db->query("SELECT * FROM ".$this->table." WHERE ".$this->uid."=".$id));
return $user[$this->user];
		}
	}
	
$log = new Login;

?>