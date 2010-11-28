<?php
$path="/media/hsos/3Channel_mag";
$files=array();
filescanner($files,$path,strlen($path));

function filescanner(&$files,$path,$len,$year="",$level=0){
	$paths=@scandir($path);
	while(list($k,$v)=@each($paths)){
		$currpath="$path/$v";
		if(substr($v,0,1)!="."&&is_dir($currpath)){
			if($level==0) $year=$v;
			filescanner(&$files,$currpath,$len,$year,$level+1);
		}
		if(substr($v,0,1)!="."&&is_file($currpath)){ 
			$path=substr("$path/$v",$len,strlen($currpath)-$len);
			$time=$year."-".substr($v,7,2)."-".substr($v,9,2)." ".substr($v,11,2).":".substr($v,13,2).":".substr($v,15,2);
			$name=$v;
			$sql="INSERT INTO  `bao`.`3channel_mag_fit` (`file_id` ,`file_name` ,`file_path` ,`obsv_start_time` ,`obsv_end_time`)VALUES (NULL,  '$name',  '$path',  '$time',  '$time');";
			echo $sql."\n";
		}
	}
}
?>
