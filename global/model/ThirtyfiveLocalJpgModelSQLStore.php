<?php
class ThirtyfiveLocalJpgModelSQLStore extends ModelSQLStore{
	public $id="file_id";	
	public $fields=array("file_id","file_name","file_path","obsv_start_time","obsv_end_time");
	public $table="10_full_jpg";
}
?>
