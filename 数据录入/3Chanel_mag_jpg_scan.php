<?php
$path="/home/ftp/pub/3Channel_mag";
$files=array();
echo strlen($path);
filescanner($files,$path,strlen($path));
function filescanner($files,$path,$len){
	$paths=@scandir($path);
	while(list($k,$v)=@each($paths)){
		$currpath="$path/$v";
		if(substr($v,0,1)!="."&&strpos($v,".")==false){
			filescanner($files,$currpath,$len);
		}
		if(substr($v,0,1)!="."&&substr($v,-3)=="jpg"){ 
			$newpath=substr($currpath,$len,strlen($currpath)-$len);
			$name=$v;
			if(strlen($v)==25) $time=substr($v,0,4)."-".substr($v,4,2)."-".substr($v,6,2)." ".substr($v,8,2).":".substr($v,10,2);
			if(strlen($v)==21) $time=substr($v,0,4)."-".substr($v,4,2)."-".substr($v,6,2);
			$sql="INSERT INTO  `bao`.`3channel_mag_jpg` (`file_id` ,`file_name` ,`file_path` ,`obsv_start_time` ,`obsv_end_time`)VALUES (NULL,  '$name',  '$newpath',  '$time',  '$time');";
			echo $sql."\n";
		}
	}
}
?>
