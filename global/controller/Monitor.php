<?php
class MonitorController extends Controller{
	public function Index(){
	}
	public function Data(){
		$start=0;$limit=1;$sort="starttime";$dir="DESC";$this->pics=array();
		$Store1=$this->framework->getModel("Dataset")->store();
		//第一步获得jpg的三个数据集的名称
		$records=$Store1->filter(array(array("type","=","jpeg")));
		//第二步获得三个数据集的最新的照片路径
		foreach($records as $record){
			//echo $record->table;
			if($record->table=="h_alpha_jpg"){
				$Store2=$this->framework->getModel("HalphaJpg")->store();
				$Store2->sortBy($sort,$dir);
				$pic=$Store2->filter(array(),$start,$limit);
				$pic[0]->path=$record->path.$pic[0]->path;
				$this->pics["h_alpha_jpg"]=$pic[0];
			}
			if($record->table=="10_full_jpg"){
				$Store2=$this->framework->getModel("ThirtyfiveLocalJpg")->store();
				$Store2->sortBy($sort,$dir);
				$pic=$Store2->filter(array(),$start,$limit);
				$pic[0]->path=$record->path.$pic[0]->path;
				$this->pics["35_local_jpg"]=$pic[0];
			}
			if($record->table=="3channel_mag_jpg"){
				$Store2=$this->framework->getModel("ThreechannelJpg")->store();
				$Store2->sortBy($sort,$dir);
				$pic=$Store2->filter(array(),$start,$limit);
				$pic[0]->path=$record->path.$pic[0]->path;
				$this->pics["3channel_mag_jpg"]=$pic[0];
			}	
		}
	}
}
?>
