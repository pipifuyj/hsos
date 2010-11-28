<?php
class DatasetModelSQLStore extends ModelSQLStore{
	public $id="dataset_id";	
	public $fields=array("dataset_id","dataset_name","file_num","data_type","equipment","table_name","dataset_path");
	public $table="dataset";
}
?>
