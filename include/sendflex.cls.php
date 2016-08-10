<?php
	
	class Sendflex{
		
		private $table=l_info;
		
		public function send_flex($type,$number,$amount)
		{
			$opt=$this->check_opt($number);
			//send the flexiload
			$tid="R130826.1452.210068";
			$status=2;
			$update=$this->updateinfo($opt,$number,$amount,$tid,$status);
			if($update)
			{
				return "Flexiload Send Sucsses";
			}
			else
			{
				return "Flexiload Send But Not Seved In DB";
			}
		}
		
		
		private function updateinfo($opt,$num,$amount,$t_id,$status)
		{
			global $db;
			$query_text="INSERT INTO ";
			$query_text.=$this->table." VALUES('','".date("Y-m-d")."','".time("H:i:s")."'," ;
			$query_text.=$_SESSION[session]["USER_ID"].",'Dont know','".$num."'";
			$query_text.=",".$opt.",".$amount.",'".$t_id."',".$status;
			$query_text.=")";
			if($db->query($query_text))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		
		private function check_opt($num)
		{
			global $oparetor;
			$return=0;
			if(gettype($num)!="string")
			{
				settype($num,"string");
			}
			$check0=substr($num,0,1);
			if($check0!=0)
			{
				$check0="0";
				$num=$check0.$num;
			}
			$opt=substr($num,0,3);
			if($opt=="017")
			{
				$return=array_search("Grameen",$oparetor);
			}
			else if($opt=="019")
			{
				$return=array_search("Banglalink",$oparetor);
			}
			else if($opt=="018")
			{
				$return=array_search("Robi",$oparetor);
			}
			else if($opt=="015")
			{
				$return=array_search("Teletalk",$oparetor);
			}
			else if($opt=="011")
			{
				$return=array_search("Citycell",$oparetor);
			}
			return $return;
		}
		
		public function get_flex_info($txt)
		{
			global $status,$db,$oparetor,$log;
			$return="";
			if($txt!="all"){
				$sta=array_search($txt,$status);
			}
			$query_txt="SELECT * FROM ".$this->table;
			if($txt!="all")
			{
				$query_txt.=" WHERE status=".$sta;
			}
			$query=$db->query($query_txt);
			while($info=$db->fetch_array($query))
			{
				$return.="<tr>";
				$return.="<td>".$info["load_id"]."</td>";
				$return.="<td>".$info["load_date"]." ".$info["sendtime"]."</td>";
				$return.="<td>".$log->user_by_id($info["load_user"])."</td>";
				$return.="<td>".$info["createdby"]."</td>";
				$return.="<td>".$info["number"]."</td>";
				$return.="<td>".$oparetor[$info["Operator"]]."</td>";
				$return.="<td>".$info["Amount"]."</td>";
				$return.="<td>".$info["Transection_Id"]."</td>";
				$return.="<td>".$status[$info["status"]]."</td>";
				$return.="</tr>";
			}
		
			return $return;
		}
		
		
	}
	
	$flex=new Sendflex;
?>