<?php
require_once(LIB_PATH.D."config.php"); // load the config file
require_once(LIB_PATH.D."main.func.php");
class MysqlDatabase{
	
		private $connetion;
		public $last_query;
		private $real_escape_string_exists;
		
		function __construct(){
			$this->open_connection();
			$this->real_escape_string_exists = function_exists("mysql_real_escape_string");
		}
		
		
		public function open_connection(){
			$this->connetion = mysql_connect(HOST_NAME,USER_NAME,USER_PASS);
			if(!$this->connetion){
				redirect("install/");
			}else{
				$select_db=mysql_select_db(DATA_NAME,$this->connetion);
				if(!$select_db){
					die("Install Error".mysql_error());
				}
			}
		}
		
		public function close_connection(){
			if(isset($this->connetion)){
				mysql_close($this->connetion);
				unset($this->connetion);
			}
		}
		
		public function query($sql){
			$this->last_query = $sql;
			$result = mysql_query($sql, $this->connetion);
			$this->confram_query($result);
			return $result;
		}
		
		public function escape_value($value){
			if($this->real_escape_string_exists){
				if(get_magic_quotes_gpc()) { $value = stripslashes($value);}
				$value = mysql_real_escape_string($value);
			}else{
				if(!get_magic_quotes_gpc()) { $value = addslashes($value);}
			}
			return $value;
		}
		
		public function fetch_array($result){
			return mysql_fetch_array($result);
		}
		
		public function fetch_row($result){
			return mysql_fetch_row($result);
		}
		
		public function max_id($table,$sel=NULL,$val=NULL,$key=NULL){
			if($key==NULL){$key=$this->prim_key($table);}
			$txt="SELECT MAX({$key}) AS {$key} FROM {$table}";
			if($val!="" && $sel!=""){$txt.=" WHERE {$sel}='".$val."'";}
			$query=$this->query($txt);
			$result=$this->fetch_row($query);
			if($result){
				return $result[0];
			}else{
				return false;
				}
			}
		
		public function min_id($table,$key=NULL){
			if($key==NULL){$key=$this->prim_key($table);}
			$query=$this->query("SELECT MIN({$key}) AS {$key} FROM {$table}");
			$result=$this->fetch_row($query);
			if($result){
				return $result[0];
			}else{
				return false;
				}
			}
		
		public function num_rows($result){
			return mysql_num_rows($result);
		}
		
		public function num_fields($table){
			return mysql_num_fields($table); 
		}
		
		public function insert_id($result){
			return mysql_insert_id($result);
		}
		
		public function affected_rows($result){
			return mysql_affected_rows($result);
		}
		
		public function fetch_assoc($result){
			return mysql_fetch_assoc($result);
		}
		
		public function fetch_object($result){
			return mysql_fetch_object($result);
		}
		
		public function culmon_list($table){
			return $this->query("SHOW COLUMNS FROM {$table}");
		}
		
		public function drop_table($value){
			$sql="DROP TABLE IF EXISTS ".$value."";
			$this->query("$sql");
		}
		
		public function create_table($value,$sql){
			$this->drop_table($value);
			$this->query($sql);			
		}
		
		public function create_new_table($sql){
			$this->query($sql);			
		}
		public function count_all($table){
			$sql = "SELECT COUNT(*) FROM {$table}";
				$result = $this->query($sql);
				$row = $this->fetch_array($result);
				return array_shift($row);
		}
		
		public function get_single_field_name($result, $i){
			return mysql_field_name($result, $i);
		}
		
		public function get_all_field_name($table){
			$sql=$table."(";
			$result =$this->query("SELECT * FROM ".$table);
			for ($i = 0; $i < $this->num_fields($result); ++$i) {
			$field = $this->get_single_field_name($result, $i);
			$sql .= $field;
				if($i==$this->num_fields($result)-1){
					break;
				}else{
					$sql.= ", ";
				}
			}
			$sql.=") ";
			return  $sql;
		}
		
		public function get_field_as_array($table){
			$array_list=array();
			$result =$this->query("SELECT * FROM ".$table);
				for ($i = 0; $i < $this->num_fields($result); ++$i) {
					$field = $this->get_single_field_name($result, $i);
					$sqls=array_push($array_list, $field);
				}
				return  $array_list;
		}
		
		private function confram_query($result){
			if(!$result){
				$msg = "Dtabase Error ".mysql_query();
				$msg .= "Your last Query is{$this->last_query}";
				die($msg);
			}
		}
		
		public function all_table_name(){
			$dbname = DATA_NAME;
			$table=array();
			$sql = "SHOW TABLES FROM {$dbname}";
			$result = $this->query($sql);

			while ($row = mysql_fetch_row($result)) {
    			array_push($table,$row[0]);
				}
			mysql_free_result($result);
			return $table;

			}
		
		public function delete_by_id($table,$id){
			$result=$this->query("DELETE FROM {$table} WHERE ID={$id}");
			if($result){
				return true;
			}else{
				return false;
			}
		}
		
		public function create($value, $sql){
			$this->drop_table($value);
			$this->query($sql);
		}
		
		public function prim_key($table){
			$ts = $this->culmon_list($table);
			$cts = $this->num_rows($ts);
			while($ats = $this->fetch_array($ts)){
				if($ats['Key'] == "PRI"){
					return($ats['Field']);
				}
			}
		return(false);
		}
		
		public function n_r($table,$key="",$val=""){
			$sql="SELECT * FROM {$table}";
			if(($key) && ($val)){
					$sql.=" WHERE {$key}='".$val."'";
				}
				$query=$this->query($sql);
				$nw=$this->num_rows($query);
				if($nw){
				return $nw;
				}
				return(false);
			}
}


$db = new MysqlDatabase;
?>