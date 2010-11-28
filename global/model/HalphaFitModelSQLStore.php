<?php
class HalphaFitModelSQLStore extends ModelSQLStore{
	public $id="file_id";	
	public $fields=array("file_id","file_name","file_path","obsv_start_time","obsv_end_time");
	public $table="h_alpha_fit";
}
?>
