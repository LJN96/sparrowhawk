<?php

include_once 'db.php';

/* code for data insert */
if(isset($_POST['save']))
{

     $fn = $MySQLiconn->real_escape_string($_POST['fn']);
     $ln = $MySQLiconn->real_escape_string($_POST['ln']);
     $dl = $MySQLiconn->real_escape_string($_POST['People_licence']);
	
	 $SQL = $MySQLiconn->query("INSERT INTO people(fn,ln) VALUES('$fn','$ln')");
	 
	 if(!$SQL)
	 {
		 echo $MySQLiconn->error;
	 } 
}
/* code for data insert */


/* code for data delete */
if(isset($_GET['del']))
{
	$SQL = $MySQLiconn->query("DELETE FROM people WHERE id=".$_GET['del']);
	header("Location: crudindex.php");
}
/* code for data delete */



/* code for data update */
if(isset($_GET['edit']))
{
	$SQL = $MySQLiconn->query("SELECT * FROM people WHERE id=".$_GET['edit']);
	$getROW = $SQL->fetch_array();
}

if(isset($_POST['update']))
{
	$SQL = $MySQLiconn->query("UPDATE people SET fn='".$_POST['fn']."', ln='".$_POST['ln']."' WHERE id=".$_GET['edit']);
	header("Location: crudindex.php");
}
/* code for data update */

?>