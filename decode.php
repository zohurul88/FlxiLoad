<?php
$PDUin = "";
$PDUout = "";
if (isset($_REQUEST["PDUin"]))
	{
	$PDUin = $_REQUEST["PDUin"];
	}
if ($PDUin != "")
	{
	$PDUout = '<BR>Last PDU=<B>'.PtoT($PDUin).'</B>';
	}
	
$Textin = "";
$Textout = "";
if (isset($_REQUEST["Textin"]))
	{
	$Textin = $_REQUEST["Textin"];
	}
if ($Textin != "")
	{
	$Textout = '<BR>Last Text=<B>'.TtoP($Textin).'</B>';
	}

function PtoT($pdu)
	{
	$hexlen = (strlen($pdu)/2) - 1;
	$hexes = array();
	for ($i = 0; $i <= $hexlen; $i++)
		{
		$hexes[] = substr("00000000".base_convert((substr($pdu,($i*2), 2)),16,2),-8);
		}
	$LeftOver = "";
	$Take = 7;
	$FullBin = "";
	for ($i=0 ; $i<= $hexlen ; $i++)
		{
		$rhs = 0 - $Take;
		$FullBin .= substr($hexes[$i] , $rhs).$LeftOver;
		$lhs = 8-$Take;
		$LeftOver = substr($hexes[$i] ,0, $lhs);
		$Take = $Take-1;
		if ($Take == 0) {$Take = 7;}
		if (strlen($LeftOver) == 7)
			{
			$FullBin .= $LeftOver;
			$LeftOver = "";
			}
		}
	$chrnum = array();
	while ($FullBin != "")
		{
		$chrnum[] = chr(bindec(substr($FullBin,0,7)));
		$FullBin = substr($FullBin,7);
		}
	
	return implode("",$chrnum);
	}

function TtoP($text)
	{
	$bins = str_split($text);
	foreach ($bins as $k=>$v)
		{
		$bins[$k] = substr("0000000".base_convert(ord($v),10,2) , -7);
		}
	$hexes = array();
	$maxbins = count($bins) - 1;
	for ($i = 0 ; $i <= $maxbins ; $i++)
		{
		if ($i == $maxbins)
			{
			$hexes[] = substr("00000000".$bins[$i] , -8);
			}
		else
			{
			$hl = strlen($bins[$i]);
			if ($hl > 0)
				{
				$steal = $hl - 8;
				$hexes[] = substr($bins[$i+1],$steal).$bins[$i];
				$bins[$i+1] = substr($bins[$i+1],0,7+$steal);
				}
			}
		}
	$pdu = array();
	foreach ($hexes as $v)
		{
		if ($v != "00000000")
		{ $pdu[] = substr("0".strtoupper(base_convert($v, 2, 16)),-2); }
		}
	return implode("", $pdu);
	}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<HTML LANG="en">
<HEAD>
	<META HTTP-EQUIV=CONTENT-TYPE CONTENT="text/html; charset=utf-8">
	<TITLE>PDU in and out</TITLE>
	<META NAME="generator" CONTENT="BBEdit 9.6">
</HEAD>
<BODY>
<FORM METHOD="post" ACTION="">
Enter PDU:<BR>
<TEXTAREA NAME="PDUin" ROWS=5 COLS=50><?php echo $PDUin; ?></TEXTAREA><?php echo $PDUout; ?><BR><BR>
Enter TEXT:<BR>
<TEXTAREA NAME="Textin" ROWS=5 COLS=50><?php echo $Textin; ?></TEXTAREA><?php echo $Textout; ?><BR><BR>
<INPUT TYPE="submit" VALUE="Decode / Encode">
</FORM>

</BODY>
</HTML>