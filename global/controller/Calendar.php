<?php
class CalendarController extends Controller{
	public function Index(){
	}
	public function Data(){
		$year=$_REQUEST['year'];
		$month=$_REQUEST['month'];
		$dataset=$_REQUEST['dataset'];

		$Store1=$this->framework->getModel("Dataset")->store();
		$records=$Store1->filter(array(array("table","=",$dataset)));
		$this->dspath=$records[0]->path; 

		$dataFilter[]=array("starttime",">=",$year."-".$month."-01 00:00:00");
		$dataFilter[]=array("starttime","<=",$year."-".$month."-31 23:59:59");
		$Store2=$this->framework->getModel("Autodata")->store();
		$Store2->sortBy("starttime","ASC");
		$this->records=$Store2->filter($dataFilter,$start,$limit);
		$this->lastClause=$this->sql->lastClause;
		$this->count=$Store2->getTotalCount($dataFilter);
		
		$this->data=array();
		foreach($this->records as $record){
			$this->data[substr($record->starttime,8,2)]=$record;
		}
	}
}
?>
