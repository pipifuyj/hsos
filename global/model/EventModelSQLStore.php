<?php
class EventModelSQLStore extends ModelSQLStore{
	public $id="event_id";	
	public $fields=array("event_id","region_num","longitude","latitude","start_time","end_time","event_type");
	public $table="astro_event";
}
?>
