<?php
class DataController extends Controller{
	public function Index(){
		$start=0;$limit=10;$sort="id";$dir="ASC";$dataFilter=array();
		foreach($_REQUEST as $key=>$value){
			if($key=="start"&&$value!="")$start=$value;
			if($key=="limit"&&$value!="")$limit=$value;
			if($key=="sort"&&$value!="")$sort=$value;
			if($key=="dir"&&$value!="")$dir=$value;
			if($key=="starttime"&&$value!="") $dataFilter[]=array("starttime",">=",$value);
			if($key=="endtime"&&$value!="") $dataFilter[]=array("endtime","<=",$value);
		}
		$dataset=$_REQUEST['dataset'];
		$Store1=$this->framework->getModel("Dataset")->store();
		$records=$Store1->filter(array(array("table","=",$dataset)));
		$this->dspath=$records[0]->path; 

		$Store2=$this->framework->getModel("Autodata")->store();
		$Store2->sortBy($sort,$dir);
		$this->records=$Store2->filter($dataFilter,$start,$limit);
		$this->lastClause=$this->sql->lastClause;//echo $this->lastClause;
		$this->count=$Store2->getTotalCount($dataFilter);
	}
	public function Dataset(){
		$Store=$this->framework->getModel("Dataset")->store();
		$dataFilter=array();$dataFilter[]=array("type","=","fit");
		$this->records=$Store->filter($dataFilter);
		$this->lastClause=$this->sql->lastClause;
	}
	public function JpgDataset(){
		$Store=$this->framework->getModel("Dataset")->store();
		$dataFilter=array();$dataFilter[]=array("type","=","jpeg");
		$this->records=$Store->filter($dataFilter);
		$this->lastClause=$this->sql->lastClause;
	}
	public function Event(){
		$start=0;$limit=10;$sort="id";$dir="ASC";$dataFilter=array();
		foreach($_REQUEST as $key=>$value){
			if($key=="start"&&$value!="")$start=$value;
			if($key=="limit"&&$value!="")$limit=$value;
			if($key=="sort"&&$value!="")$sort=$value;
			if($key=="dir"&&$value!="")$dir=$value;
			if($key=="starttime"&&$value!="") $dataFilter[]=array("starttime",">=",$value);
			if($key=="endtime"&&$value!="") $dataFilter[]=array("endtime","<=",$value);
			if($key=="regionnum"&&$value!="") $dataFilter[]=array("regionnum","=",$value);
			if($key=="lat"&&$value!="") $dataFilter[]=array("lat","=",$value);
			if($key=="long"&&$value!="") $dataFilter[]=array("long","=",$value);
		}
		$Store=$this->framework->getModel("Event")->store();
		$Store->sortBy($sort,$dir);
		$this->records=$Store->filter($dataFilter,$start,$limit);
		$this->lastClause=$this->sql->lastClause;
		$this->count=$Store->getTotalCount($dataFilter);
	}
	public function Regionnum(){
		$Store=$this->framework->getModel("Event")->store();
		$this->regnums=$Store->collect("regionnum");
	}
	public function Longitude(){
		$Store=$this->framework->getModel("Event")->store();
		$this->longs=$Store->collect("long");
	}
	public function Latitude(){
		$Store=$this->framework->getModel("Event")->store();
		$this->lats=$Store->collect("lat");
	}
	public function Images(){
	}
}
?>
