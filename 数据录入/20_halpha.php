<?php
$path="/media/新加卷/ha_20";
$files=array();
filescanner($files,$path,strlen($path));

function filescanner(&$files,$path,$len,$year="",$month="",$day="",$level=0){
	$paths=@scandir($path);
	while(list($k,$v)=@each($paths)){
		$currpath="$path/$v";
		if(substr($v,0,1)!="."&&is_dir($currpath)){
			if($level==0) $year=$v;
			if($level==1){
				$month=strtolower($v);
				if($month=="jan")$month="01";
				if($month=="feb")$month="02";
				if($month=="mar")$month="03";
				if($month=="apr")$month="04";
				if($month=="may")$month="05";
				if($month=="jun")$month="06";
				if($month=="jul")$month="07";
				if($month=="aug")$month="08";
				if($month=="sep")$month="09";
				if($month=="oct")$month="10";
				if($month=="nov")$month="11";
				if($month=="dec")$month="12";
			}
			if($level==2) $day=$v;
			filescanner(&$files,$currpath,$len,$year,$month,$day,$level+1);
		}
		if(substr($v,0,1)!="."&&is_file($currpath)){ 
			$path=substr("$path/$v",$len,strlen($currpath)-$len);
			$time1=substr($v,10,2).":".substr($v,12,2).":".substr($v,14,2);
			if(strlen($day)==4) $time=$year."-".$month."-".substr($day,2,2);
			else if(strlen($day)==6) $time=$year."-".$month."-".substr($day,4,2);
			else $time=$year."-".$month."-".$day;
			$time=$time." ".$time1;
			$name=$v;
			$sql="INSERT INTO  `bao`.`20_halpha_fit` (`file_id` ,`file_name` ,`file_path` ,`obsv_start_time` ,`obsv_end_time`)VALUES (NULL,  '$name',  '$path',  '$time',  '$time');";
			echo $sql."\n";
		}
	}
}
?>
