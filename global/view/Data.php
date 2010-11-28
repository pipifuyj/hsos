<?php
class DataView extends View{
	function Index(){
		header('Content-type: text/xml');
		$xml="<?xml version='1.0'  encoding='UTF-8'?>\n";
		$xml.="<files>";
		$xml.="<sql>".htmlspecialchars($this->lastClause)."</sql>";
		$xml.="<count>".$this->count."</count>";
		foreach($this->records as $record){
			$xml.="<file>";
			$xml.="<id>".$record->id."</id>";
			$xml.="<name>".$record->name."</name>";
			$xml.="<path>".$this->dspath.$record->path."</path>";
			$xml.="<starttime>".$record->starttime."</starttime>";
			$xml.="<endtime>".$record->endtime."</endtime>";
			$xml.="</file>";
		}
		$xml.="</files>";	
		echo $xml;
	} 
	public function Dataset(){
		header('Content-type: text/xml');
		$xml="<?xml version='1.0'  encoding='UTF-8'?>\n";
		//$xml.="<sql>".$this->lastClause."</sql>";
		$xml.="<datasets>";
		foreach($this->records as $record){
			$xml.="<dataset>";	
			$xml.="<id>".$record->id."</id>";
			$xml.="<table>".$record->table."</table>";
			$xml.="<equip>".$record->equip."</equip>";
			$xml.="</dataset>";	
		}
		$xml.="</datasets>";	
		echo $xml;
	}
	public function JpgDataset(){
		header('Content-type: text/xml');
		$xml="<?xml version='1.0'  encoding='UTF-8'?>\n";
		//$xml.="<sql>".$this->lastClause."</sql>";
		$xml.="<datasets>";
		foreach($this->records as $record){
			$xml.="<dataset>";	
			$xml.="<id>".$record->id."</id>";
			$xml.="<table>".$record->table."</table>";
			$xml.="<equip>".$record->equip."</equip>";
			$xml.="</dataset>";	
		}
		$xml.="</datasets>";	
		echo $xml;
	}
	function Event(){
		header('Content-type: text/xml');
		$xml="<?xml version='1.0'  encoding='UTF-8'?>\n";
		$xml.="<events>";
		$xml.="<sql>".htmlspecialchars($this->lastClause)."</sql>";
		$xml.="<count>".$this->count."</count>";
		foreach($this->records as $record){
			$xml.="<event>";
			$xml.="<id>".$record->id."</id>";
			$xml.="<regionnum>".$record->regionnum."</regionnum>";
			$xml.="<lat>".$record->lat."</lat>";
			$xml.="<long>".$record->long."</long>";
			$xml.="<starttime>".$record->starttime."</starttime>";
			$xml.="<endtime>".$record->starttime."</endtime>";
			$xml.="<eventtype>".$record->eventtype."</eventtype>";
			$xml.="</event>";
		}
		$xml.="</events>";	
		echo $xml;
	}
	function Regionnum(){
		header('Content-type: text/xml');
		$xml="<?xml version='1.0'  encoding='UTF-8'?>\n";
		$xml.="<regnums>";
		foreach($this->regnums as $regnum){
			$xml.="<regnum>";	
			$xml.="<value>".$regnum."</value>";
			$xml.="</regnum>";	
		}
		$xml.="</regnums>";	
		echo $xml;
	}
	function Longitude(){
		header('Content-type: text/xml');
		$xml="<?xml version='1.0'  encoding='UTF-8'?>\n";
		$xml.="<longs>";
		foreach($this->longs as $long){
			$xml.="<long>";	
			$xml.="<value>".$long."</value>";
			$xml.="</long>";	
		}
		$xml.="</longs>";	
		echo $xml;
	} 
	function Latitude(){
		header('Content-type: text/xml');
		$xml="<?xml version='1.0'  encoding='UTF-8'?>\n";
		$xml.="<lats>";
		foreach($this->lats as $lat){
			$xml.="<lat>";	
			$xml.="<value>".$lat."</value>";
			$xml.="</lat>";	
		}
		$xml.="</lats>";	
		echo $xml;
	} 
	function Images(){

	} 
}
?>
