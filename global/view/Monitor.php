<?php
class MonitorView extends View{
	public function Index(){
		require("Monitor.Index.php");
	}
	public function Data(){
		header('Content-type: text/xml');
		$xml="<?xml version='1.0'  encoding='UTF-8'?>\n";
		$xml.="<files>";
		$xml.="<count>".count($this->pics)."</count>";
		foreach($this->pics as $index=>$pic){
			$xml.="<file>";
			$xml.="<id>".$index."</id>";
			$xml.="<name>".$index."</name>";
			$xml.="<path>".$pic->path."</path>";
			$xml.="<starttime>".$pic->starttime."</starttime>";
			$xml.="<endtime>".$pic->endtime."</endtime>";
			$xml.="</file>";
		}
		$xml.="</files>";	
		echo $xml;
	}
}
?>
