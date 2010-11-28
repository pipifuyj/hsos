<?php
require("global/php/framework.php");
require("global/php/mysql.php");
//error_reporting(E_ALL);
ini_set("error_reporting",E_ALL);
//ini_set("display_errors",1);
$global=new framework("global","global");
$global->title="National Observatory";
$global->sql=new mysql("localhost","root","868686","bao","utf8");
$global->main();
//echo $this->lastClause;
?>
