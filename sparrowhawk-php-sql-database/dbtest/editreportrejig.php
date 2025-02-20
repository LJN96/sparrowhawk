<?php
session_start();
include_once 'dbconnect.php';

if (!isset($_SESSION['userSession'])) {
	header("Location: index.php");
}

$query = $DBcon->query("SELECT * FROM tbl_users WHERE user_id=".$_SESSION['userSession']);
$userRow=$query->fetch_array();
$DBcon->close();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $userRow['username']; ?></title>

<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 

<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand">Sparrowhawk</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="home.php">Home</a></li>
            <li><a href="vehicleindexsql.php">Vehicles</a></li>
            <li> <a href="crudindex3.php">Persons</a></li>
            <li class="active"><a href="report.php">Report</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp; <?php echo $userRow['username']; ?></a></li>
            <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp; Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="report.php">Report Search</a></li>
            <li> <a href="addnewreport.php">Add New Report</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
          </ul>
        </div><!--/.nav-collapse -->
      </div>
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="editreportrejig.php">Edit Report</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

<div class="container" style="margin-top:100px;text-align:center;font-family:Verdana, Geneva, sans-serif;font-size:12px;">
    <?php
include_once 'crud.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</br>
</br>
<title>Report Search</title>
<link rel="stylesheet" href="style2.css" type="text/css" />
</head>

<body>
<center>
<div id="header">
  <label></label>
</div>
<br />
<h1>Edit Report</h1>
<br />
<html>
  <head>
    <title>Search</title>
  </head>
<body>
</body>
</html>
<br />


<?php

$capture = $_SESSION['capture'];

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn = mysqli_connect("localhost", "root", "", "dbtest");
    if(mysqli_connect_errno()){
        echo "Failed to connect: " . mysqli_connect_error();
    }
    error_reporting(0);
       
    $q = mysqli_query($conn, "SELECT * FROM incident WHERE incident.Incident_Date = '$capture'") or die(mysqli_error());
    

    if(isset($_POST['done'])){
    $UpdateQuery = "UPDATE incident SET People_ID ='$_POST[PID]', Vehicle_ID ='$_POST[VI]', Incident_Date ='$_POST[INDA]', Incident_Report ='$_POST[INR]', Offence_ID ='$_POST[OID]' WHERE Incident_ID ='$_POST[hidden]'";
    mysqli_query($conn, $UpdateQuery);

    header("Refresh:0");

    } 

    $c = mysqli_num_rows($q);

    while($row = mysqli_fetch_array($q)){
        $inid = $row['Incident_ID'];
        $vid = $row['Vehicle_ID'];
        $pid = $row['People_ID'];
        $inda = $row['Incident_Date'];
        $inr = $row['Incident_Report']; /* Slight bug here, not displaying all of the text from the field */
        $oid = $row['Offence_ID'];
       
        echo "<form action=editreportrejig.php method=post>";
        echo "<table width=100% border=1 cellpadding=15 align=center><tr><th>Vehicle ID</th> <th>Incident ID</th> <th>People ID</th> <th>Incident Date</th> <th>Incident Report</th> <th>Offence ID</th></tr>"; 
        echo "<tr><td><input type=text size=8 name=VI value=" . $vid . " </td>"; 
        echo  "<td><input type=text size=9 name=INID value=" . $inid . " </td>";
        echo  "<td><input type=text size=8 name=PID value=" . $pid . " </td>";
        echo  "<td><input type=text size=11 name=INDA value=" . $inda . " </td>";
        echo  "<td><input type=text size=55 name=INR value=" . $inr . " </td>";
        echo  "<td><input type=text size=9 name=OID value=" . $oid . " </td>";
        echo  "<td><input type=hidden name=hidden value=" . $row['Incident_ID'] . " </td>";
        echo  "<td>  <center><input type=submit name=done value=submit align=center /></center></td></tr> </table></form>";
        }
   
    
    mysqli_close($conn);
?>
<hr>
<?php
    if (isset($_POST['VI']) && $_POST['INID']!="" && $_POST['PID']!="" && $_POST['INDA']!=""  && $_POST['INR']!=""  && $_POST['OID']!="")

{

 $insertVI = $_POST['VI'];
 $insertINID = $_POST['INID'];
 $insertPID = $_POST['PID'];
 $insertINDA = $_POST['INDA'];
 $insertINR = $_POST['INR'];
 $insertOID = $_POST['OID']; 
 echo "Submitted the following changes to Sparrowhawk:  Vehicle ID: ".$_POST['VI'].", Incident ID: ".$_POST['INID'].", People ID: ".$_POST['PID'].", Incident Date: ".$_POST['INDA'].", Incident Report: ".$_POST['INR'].", Offence ID: ".$_POST['OID'].".<br></br> <button type=button><a href=report.php>Accept these changes?</a></button>";

}

else{
  if (empty($_POST['INR'])){
    echo 'A report must be filed';
  }}

?>

</table>
</div>
</center>
</body>
</html>
</div>
</body>
</html>