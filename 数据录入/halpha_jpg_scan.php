<?php
$path="/home/ftp/pub/full_disk/h-alpha";
$files=array();
filescanner($files,$path,strlen($path));

function filescanner($files,$path,$len,$year="",$level=0){
	$paths=@scandir($path);
	while(list($k,$v)=@each($paths)){
		$currpath="$path/$v";
		if(substr($v,0,1)!="."&&strpos($v,".")==false){
			if($level==0) $year=$v;
			filescanner($files,$currpath,$len,$year,$level+1);
		}
		if(substr($v,0,1)!="."&&substr($v,-3)=="jpg"){ 
			$newpath=substr($currpath,$len,strlen($currpath)-$len);
			$name=$v;
			if(strlen($v)==18) $time=$year."-".substr($v,0,2)."-".substr($v,2,2)." ".substr($v,4,2).":".substr($v,6,2).":".substr($v,8,2);
			else if((strlen($v)==23 || strlen($v)==22)&&is_numeric(substr($v,0,2)))$time=substr($v,6,4)."-".substr($v,0,2)." ".substr($v,10,2).":".substr($v,12,2)." ".substr($v,14,2).":".substr($v,16,2).":".substr($v,18,2);
			else if(strlen($v)==25)$time="20".substr($v,4,2)."-".substr($v,6,2)."-".substr($v,8,2)." ".substr($v,10,2).":".substr($v,12,2).":".substr($v,14,2);
			else if(strlen($v)==23&&!is_numeric(substr($v,0,4)))$time="20".substr($v,4,2)."-".substr($v,6,2)."-".substr($v,8,2)." ".substr($v,10,2).":".substr($v,12,2);
			else $time="";
			$sql="INSERT INTO  `bao`.`h_alpha_jpg` (`file_id` ,`file_name` ,`file_path` ,`obsv_start_time` ,`obsv_end_time`)VALUES (NULL,  '$name',  '$newpath',  '$time',  '$time');";
			echo $sql."\n";
		}
	}
}
?>
