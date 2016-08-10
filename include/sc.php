<?php
class SC{
			public static function upload($table, $value,$unqe=NULL,$dob=NULL,$blank=NULL){
				global $db;
				array_pop($value);
				$main_array=self::filter_post($value,$dob);
				$sql_stetment=self::arraytosql($main_array,$table,$unqe,$blank);
				$result=$db->query($sql_stetment);
					if($result){
						return true;
					}else{
						return false;
					}
			}
			
			public static function arraytosql($value,$table,$unqe=NULL,$blank=NULL){
				$sql="INSERT INTO {$table} VALUES (";
				if($unqe){
					$sql.="'',";
				}
				if($blank==NULL){
					for($i=0;$i<count($value);$i++){
						$sql.="'".$value[$i]."'";
						if($i==(count($value)-1)){
							$sql.=")";
							break;
							}
						$sql.=",";
					}
				}else{
					$me= count($value);
					for($j=$me; $j<=($me+$blank)-1; $j++){
						array_push($value,'');
					}
					for($i=0;$i<count($value);$i++){
						$sql.="'".$value[$i]."'";
						if($i==(count($value)-1)){
							$sql.=")";
							break;
							}
						$sql.=",";
					}
				}
					return $sql;
				}
				
			public static function filter_post($value,$dob=false){			
						//array_pop($value);
						$main_array=$value;
						if($dob){
							$main_array=self::chek_dob($main_array);
						}
						$main_array=array_values(array_filter($main_array));
						return $main_array;
				}
				
			public static function chek_dob($value){
							$main_array=$value;
							$d="Date";
							$m="Month";
							$y="Year";
								if((array_key_exists($d,$main_array)) 
								&& (array_key_exists($m,$main_array)) 
								&& (array_key_exists($y,$main_array))){
								$main_array_value=$main_array[$y]."-".$main_array[$m]."-".$main_array[$d];
								//echo "its wark";
								$main_array[$d]=false;
								$main_array[$m]=false;
								$main_array[$y]=false;
								$main_array["dob"]=$main_array_value;
								}
								if((array_key_exists(strtoupper($d),$main_array)) 
								&& (array_key_exists(strtoupper($m),$main_array)) 
								&& (array_key_exists(strtoupper($y),$main_array))){
								$main_array_value=$main_array[strtoupper($y)]."-".$main_array[strtoupper($m)]."-".$main_array[strtoupper($d)];
								//echo "its wark";
								$main_array[strtoupper($d)]=false;
								$main_array[strtoupper($m)]=false;
								$main_array[strtoupper($y)]=false;
								$main_array["dob"]=$main_array_value;
								}
								if((array_key_exists(strtolower($d),$main_array)) 
								&& (array_key_exists(strtolower($m),$main_array)) 
								&& (array_key_exists(strtolower($y),$main_array))){
								$main_array_value=$main_array[strtolower($y)]."-".$main_array[strtolower($m)]."-".$main_array[strtolower($d)];
								//echo "its wark";
								$main_array[strtolower($d)]=false;
								$main_array[strtolower($m)]=false;
								$main_array[strtolower($y)]=false;
								$main_array["dob"]=$main_array_value;
								}
								
								return $main_array;
			}
			
			public static function get_all($table,$key=NULL,$value=NULL,$type=NULL){
				global $db;
				if($key==NULL){
					$sql="SELECT * FROM {$table}";
				}else{
				$sql="SELECT * FROM {$table} WHERE {$key}='".$value."'";
				}
				$query=$db->query($sql);
				if($type==NULL){
						return $query;
					}elseif($type=="fetch_array" || $type=="FETCH_ARRAY"){
						return $db->fetch_array($query);
					}elseif($type=="fetch_object" || $type=="FETCH_OBJECT"){
						return $db->fetch_object($query);
					}elseif($type=="fetch_row" || $type=="FETCH_ROW"){
						return $db->fetch_row($query);
					}elseif($type=="num_rows" || $type=="NUM_ROWS"){
						return $db->num_rows($query);
					}elseif($type=="num_fields" || $type=="NUM_FIELDS"){
						return $db->num_fields($query);
					}
			}
			
		
			public static function next_val($table){
				global $db;
					$id=$db->prim_key($table);
					if($id){
						$out=$db->max_id($table,$id);
						if($out){
								return $out[0];
							}else{
								return false;
								}
						}else{
							return false;
							}
				}
				
			public static function get_opt($table,$key=NULL,$val=NULL,$select=NULL){
				global $db;
				$value="";
				$sql="SELECT * FROM {$table}";
				if(($key) && ($val)){
					$sql="SELECT * FROM {$table} WHERE {$key}='".$val."'";
					}
				$source=$db->query($sql);
				if($source){
				while($i=$db->fetch_row($source)){
						if(($select) && $i[0]==$select){
							$value.="<option selected='selected' value='".$i[0]."'>";
							$value.=$i[1];
							$value.="</option>";
							continue;
						}
						$value.="<option value='".$i[0]."'>";
						$value.=$i[1];
						$value.="</option>";
					}
					return $value;
				}else{
					return false;
					}
				}
				
				public static function bsone($td,$id,$get=""){
					global $db;
					$me=$db->prim_key($td);
					if($me){
					$sql="SELECT * FROM ".$td." WHERE ".$me."=".$id;
					if($get!=""){
							$sql="SELECT ".$get." FROM ".$td." WHERE ".$me."=".$id;
						}
					return $db->query($sql);
						}else{
							return false;
						}
					}
				
				public static function get_id($td,$key,$val){
					global $db;
					$me=$db->prim_key($td);
					if($me){
						$sql="SELECT {$me} FROM {$td} WHERE {$key}='".$val."'";
						$query=$db->query($sql);
						if($query){
							return $db->fetch_row($query);
						}
					}else{
						return false;
					}
				}
}
//$up=new Upload;
?>