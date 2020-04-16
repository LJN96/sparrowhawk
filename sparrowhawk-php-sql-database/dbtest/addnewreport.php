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
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
            <li ><a href="vehicleindexsql.php">Vehicles</a></li>
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
            <li><a href="report.php">Report Search</a></li>
            <li class="active"> <a href="addnewreport.php">Add New Report</a></li>
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
<title>Vehicle Search</title>
<link rel="stylesheet" href="style2.css" type="text/css" />
</head>

<body>
<center>
<div id="header">
  <label></label>
</div>
<br />
<h1>Enter Details</h1>
<br />
<html>
  <head>
    <title>Search</title>
  </head>
<body>
  <form method="post" width="100%" id=thisform border="1" cellpadding="15" align="center">
    <input type="text" name="date" placeholder="Date (yyyy-mm-dd)" dir="ltr">
    <input type="text" name="offence" placeholder="Offence ID" dir="ltr">

    <?php


    $conn = new mysqli('localhost', 'root', '','dbtest') or die ("Cannot connect to db");

        $result = $conn->query("SELECT People_licence from people");
        
        echo "<html>";
        echo "<body>";
        echo "<select name='Owner'>";

        while ($row = $result->fetch_assoc()) {

                      unset($id, $name);
                      $name = $row['People_licence']; 
                      echo '<option value="'.$name.'">'.$name.'</option>';


                     
    }

        echo "</select>";
        echo "</body>";
        echo "</html>";

        $result2 = $conn->query("SELECT Vehicle_licence from vehicle");
        
        echo "<html>";
        echo "<body>";
        echo "<select name='Vehicle'>";

        while ($row = $result2->fetch_assoc()) {

                      unset($id, $name);
                      $name = $row['Vehicle_licence']; 
                      echo '<option value="'.$name.'">'.$name.'</option>';

                     
    }

        echo "</select>";
        echo "</body>";
        echo "</html>";
    ?>

  </br>
</br>

    <textarea name="report" placeholder="Report" form=thisform dir="ltr" rows="10" cols="50"></textarea>
    <input type="submit" value="add"></form>
  </form>

</br>

</body>
<hr>
<h>Person or vehicle unknown to Sparrowhawk? </h>
</br>
</br>
<h>Please enter below: </h>
</br>
</br>

<div class="container">
  <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" href="#collapse1">1: Add Person</a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse">
        <div class="panel-body">
          <form method="post" width="100%" border="1" cellpadding="15" align="center">
    <input type="text" name="firstname" placeholder="First Name" dir="ltr">
    <input type="text" name="lastname" placeholder="Last Name" dir="ltr">
    <input type="text" name="address" placeholder="Address" dir="ltr">
    <input type="text" name="licence" placeholder="Licence Number" dir="ltr">
    <input type=submit name="psub1" dir="ltr">
        </div>
        <div class="panel-footer"> </div>
      </div>
    </div>
  </div>
</div>
<hr>


<div class="container">
  <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" href="#collapse2">2: Add Vehicle</a>
        </h4>
      </div>
      <div id="collapse2" class="panel-collapse collapse">
        <div class="panel-body">
                <form method="post" width="100%" border="1" cellpadding="15" align="center">
    <input type="text" name="type" placeholder="Vehicle Make + Model" dir="ltr">
    <input type="text" name="colour" placeholder="Colour" dir="ltr">
    <input type="text" name="reg" placeholder="Registration Plate" dir="ltr">
    <input type="text" name="lic" placeholder="Licence Number" dir="ltr">
    <input type=submit dir="ltr">
        </div>
        <div class="panel-footer">  </div>
        
      </div>
    </div>
  </div>
</div>


<?php
$conn = new mysqli('localhost', 'root', '','dbtest') or die ("Cannot connect to db");
    if (isset($_POST['date']) && $_POST['offence']!="" && $_POST['Owner']!="" && $_POST['Vehicle']!=""  && $_POST['report']!="")
{
 echo "Date: ".$_POST['date']." Offence ID: ".$_POST['offence']." Licence: ".$_POST['Owner']." Registration: ".$_POST['Vehicle']." Report: ".$_POST['report']."<br>";

$own = $_POST['Owner'];

$isql="INSERT INTO incident (Incident_Date, Incident_Report, Offence_ID) VALUES ('$_POST[date]','$_POST[report]','$_POST[offence]')";
$uisql="UPDATE incident SET Vehicle_ID = (SELECT id FROM people WHERE people.People_licence = '$own') WHERE incident.Vehicle_ID IS NULL;"; 
$uisql2="UPDATE incident SET People_ID = (SELECT id FROM people WHERE people.People_licence = '$own') WHERE incident.People_ID IS NULL;";
$incident = mysqli_query($conn, $isql);
$incident = mysqli_query($conn, $uisql);
$incident = mysqli_query($conn, $uisql2);
}

if (isset($_POST['firstname']) && $_POST['lastname']!="" && $_POST['licence']!="" && $_POST['address']!="")
{
  $own = $_POST['licence'];
  $dv = mysqli_real_escape_string($conn, $own);  
  $result = mysqli_query($conn, "SELECT 1 FROM people WHERE People_licence='$own' LIMIT 1");
  
    if (mysqli_fetch_row($result)) {
    echo 'Person already in database';}

else{

$sql1="INSERT INTO people(fn, ln, People_licence, People_address) VALUES ('$_POST[firstname]','$_POST[lastname]','$_POST[licence]','$_POST[address]')";
$person = mysqli_query($conn, $sql1);
}}


if (isset($_POST['type']) && $_POST['colour']!="" && $_POST['reg']!="" && $_POST['lic']!="")
{
  $checkcar = $_POST['reg'];
  $cc = mysqli_real_escape_string($conn, $checkcar);  
  $result = mysqli_query($conn, "SELECT 1 FROM vehicle WHERE Vehicle_licence='$checkcar' LIMIT 1");
  
    if (mysqli_fetch_row($result)) {
    echo 'Vehicle already in database';}
      
    else{ 

$sql2="INSERT INTO vehicle(Vehicle_type, Vehicle_colour, Vehicle_licence) VALUES ('$_POST[type]','$_POST[colour]','$_POST[reg]')";
$car = mysqli_query($conn, $sql2);

$own2 = $_POST['lic'];

$sql3="INSERT INTO ownership(Vehicle_ID) SELECT Vehicle_ID FROM vehicle WHERE NOT EXISTS (SELECT Vehicle_ID FROM ownership WHERE ownership.Vehicle_ID = vehicle.Vehicle_ID)"; 

$sql4="UPDATE ownership SET People_ID = (SELECT id FROM people WHERE people.People_licence = '$own2') WHERE ownership.People_ID IS NULL;"; 
$insert2 = mysqli_query($conn, $sql3);
$insert3 = mysqli_query($conn, $sql4);

}}

?>



</html>

</table>
</div>
</center>
</body>
</html>
</div>
</body>
</html>

