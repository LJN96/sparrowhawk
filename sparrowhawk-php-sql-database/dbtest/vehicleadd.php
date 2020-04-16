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
            <li class="active"><a href="http://www.google.com">Vehicles</a></li>
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
<h1>Enter Details</h1>
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
    ?>

    <input type="submit" value="add"></form>

</br>
  <form action="addowner.php">
    <input type="submit" value="Owner not in list?" align="right" />
</form>
</body>
<hr>
<?php



if (isset($_POST['Registration']) && $_POST['Type']!="" && $_POST['Colour']!="" && $_POST['Owner']!="")
{
  $car = $_POST['Registration'];
  $regcheck = mysqli_real_escape_string($conn, $car);  
  $result2 = mysqli_query($conn, "SELECT 1 FROM vehicle WHERE Vehicle_licence='$car' LIMIT 1");
  
    if (mysqli_fetch_row($result2)) {
    echo 'Vehicle already in database';
    }

    else {
    if (isset($_POST['Registration']) && $_POST['Type']!="" && $_POST['Colour']!="" && $_POST['Owner']!="")
{
 echo "Registration: ".$_POST['Registration']." Type: ".$_POST['Type']." Colour: ".$_POST['Colour']." Owner: ".$_POST['Owner']."<br>";

$own = $_POST['Owner'];

$sql="INSERT INTO vehicle (Vehicle_licence, Vehicle_type, Vehicle_colour) VALUES
('$_POST[Registration]', '$_POST[Type]', '$_POST[Colour]')"; 

$sql2="INSERT INTO ownership(Vehicle_ID) SELECT Vehicle_ID FROM vehicle WHERE NOT EXISTS (SELECT Vehicle_ID FROM ownership WHERE ownership.Vehicle_ID = vehicle.Vehicle_ID)"; 

$sql3="UPDATE ownership SET People_ID = (SELECT id FROM people WHERE people.People_licence = '$own') WHERE ownership.People_ID IS NULL;"; 


$insert = mysqli_query($conn, $sql);
$insert2 = mysqli_query($conn, $sql2);
$insert3 = mysqli_query($conn, $sql3);
}
}
}

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