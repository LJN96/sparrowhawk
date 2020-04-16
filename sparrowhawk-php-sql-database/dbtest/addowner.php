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
            <li class="active"><a href="vehicleindexsql.php">Vehicles</a></li>
            <li> <a href="crudindex3.php">Persons</a></li>
            <li><a href="report.php">Report</a></li>
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
            <li><a href="vehicleindexsql.php">Vehicle Search</a></li>
            <li class="active"> <a href="vehicleadd.php">Add New Vehicle</a></li>

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
<h1>Vehicle Details</h1>
<br />
<html>
  <head>
    <title>Search</title>
  </head>
<body>
  <form method="post" width="100%" border="1" cellpadding="15" align="center">
    <input type="text" name="Registration" placeholder="Registration Plate" dir="ltr">
    <input type="text" name="Type" placeholder="Make/Model" dir="ltr">
    <input type="text" name="Colour" placeholder="Colour" dir="ltr">
  </br>
</br>
<h><b>Personal Details</b></h>
</br>
</br>
    First name:<br>
    <input type="text" name="firstname"><br>
    Last name:<br>
    <input type="text" name="lastname"><br>
    Licence Number:<br>
    <input type="text" name='licence'><br>
    Address:<br>
    <input type="text" name="addy"><br>
  </br>



    <input type="submit" value="add"></form>
    <hr>

<?php
$conn = new mysqli('localhost', 'root', '','dbtest') or die ("Cannot connect to db");
$own = '';


if (isset($_POST['Registration']) && $_POST['Type']!="" && $_POST['Colour']!="" && $_POST['firstname']!="" && $_POST['lastname']!="" && $_POST['licence']!="" && $_POST['addy']!="")
{
  $own = $_POST['licence'];
  $dv = mysqli_real_escape_string($conn, $own);  
  $result = mysqli_query($conn, "SELECT 1 FROM people WHERE People_licence='$own' LIMIT 1");
  
    if (mysqli_fetch_row($result)) {
    echo 'Person already in database';
    }
  $car = $_POST['Registration'];
  $regcheck = mysqli_real_escape_string($conn, $car);  
  $result2 = mysqli_query($conn, "SELECT 1 FROM vehicle WHERE Vehicle_licence='$car' LIMIT 1");
  
    if (mysqli_fetch_row($result2)) {
    echo 'Vehicle already in database';
    }

    else {
    
        if (isset($_POST['Registration']) && $_POST['Type']!="" && $_POST['Colour']!="" && $_POST['firstname']!="" && $_POST['lastname']!="" && $_POST['licence']!="" && $_POST['addy']!=""){
                    echo "Registration: ".$_POST['Registration']." Type: ".$_POST['Type']." Colour: ".$_POST['Colour']." First Name: ".$_POST['firstname']." Last Name: ".$_POST['lastname']." Licence Number: ".$_POST['licence']." Address: ".$_POST['addy']."<br>";



  $sql="INSERT INTO vehicle (Vehicle_licence, Vehicle_type, Vehicle_colour) VALUES
  ('$_POST[Registration]','$_POST[Type]','$_POST[Colour]')"; 

  $sql1="INSERT INTO people(fn, ln, People_licence, People_address) VALUES ('$_POST[firstname]','$_POST[lastname]','$_POST[licence]','$_POST[addy]')";

  $sql2="INSERT INTO ownership(Vehicle_ID) SELECT Vehicle_ID FROM vehicle WHERE NOT EXISTS (SELECT Vehicle_ID FROM ownership WHERE ownership.Vehicle_ID = vehicle.Vehicle_ID)"; 

  $sql3="UPDATE ownership SET People_ID = (SELECT id FROM people WHERE people.People_licence = '$own') WHERE ownership.People_ID IS NULL;"; 


$insert = mysqli_query($conn, $sql);
$insert1 = mysqli_query($conn, $sql1);
$insert2 = mysqli_query($conn, $sql2);
$insert3 = mysqli_query($conn, $sql3);


}
}
}
$result = null

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