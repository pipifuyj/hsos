<?php
class CalendarView extends View{
	public function Index(){
		require("Calendar.Index.php");
	}
	public function Data(){
		header('Content-type: text/xml');
		$xml="<?xml version='1.0'  encoding='UTF-8'?>\n";
		$xml.="<files>";
		foreach($this->data as $index=>$record){
			$xml.="<file>";
				$xml.="<id>".$record->id."</id>";
				$xml.="<name>".$record->name."</name>";
				$xml.="<path>".$this->dspath.$record->path."</path>";
				$xml.="<day>".$index."</day>";
			$xml.="</file>";
		}	
		$xml.="</files>";	
		echo $xml;
	}
}
?>
