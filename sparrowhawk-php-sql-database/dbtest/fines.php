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
            <li><a href="report.php">Report</a></li>
            <li class="active"><a href="fines.php">Fines</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp; <?php echo $userRow['username']; ?></a></li>
            <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp; Logout</a></li>
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
<h1>Assign a Fine</h1>
<br />
<html>
  <head>
    <title>Search</title>
  </head>


<div class="container">
  <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" href="#collapse1">Add Fine</a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse">
        <div class="panel-body">
            <form method="post" width="100%" id=thisform border="1" cellpadding="15" align="center">
    <input type="text" name="amount" placeholder="Amount" dir="ltr">
    <input type="text" name="points" placeholder="Points" dir="ltr">
    <input type="text" name="incident" placeholder="Incident ID" dir="ltr">
    

  </br>
</br>

    <input type="submit" value="add"></form>
  </form>

        </div>
        <div class="panel-footer"> </div>
      </div>
    </div>
  </div>
</div>
<hr>
<br></br>
<h><b>Reference</b></h>
<br></br>
              
    <table>
      <tr>
        <th>Offence ID</th>
        <th>Offence Description</th>
        <th>Max Fine</th>
        <th>Max Points</th>
      </tr>
<tr>
<td>1</td>
<td>Speeding</td>
<td>1000</td>
<td>3</td>
</tr>
<tr>
<td>2</td>
<td>Speeding on a motorway</td>
<td>2500</td>
<td>6</td>
</tr>
<tr>
<td>3</td>
<td>Seat belt offence</td>
<td>500</td>
<td>0</td>
</tr>
<tr>
<td>4</td>
<td>Illegal parking</td>
<td>500</td>
<td>0</td>
</tr>
<tr>
<td>5</td>
<td>Drink driving</td>
<td>10000</td>
<td>11</td>
</tr>
<tr>
<td>6
<td>Driving without a licence
<td>10000
<td>0
</tr>
<tr>
<td>7</td>
<td>Driving without a licence</td>
<td>10000</td>
<td>0</td>
</tr>
<tr>
<td>8</td>
<td>Traffic light offences</td>
<td>1000</td>
<td>3</td>
</tr>
<tr>
<td>9</td>
<td>Cycling on pavement</td>
<td>500</td>
<td>0</td>
</tr>
<tr>
<td>10</td>
<td>Failure to have control of vehicle</td>
<td>1000</td>
<td>3</td>
</tr>
<tr>
<td>11</td>
<td>Dangerous driving</td>
<td>1000</td>
<td>11</td>
</tr>
<tr>
<td>12</td>
<td>Careless driving</td>
<td>5000</td>
<td>6</td>
</tr>
<tr>
<td>13</td>
<td>Dangerous cycling</td>
<td>2500</td>
<td>0</td>
</tr>
    </table>
    





<?php
$conn = new mysqli('localhost', 'root', '','dbtest') or die ("Cannot connect to db");
    if (isset($_POST['amount']) && $_POST['points']!="" && $_POST['incident']!="")
{


$isql="INSERT INTO fines (Fine_Amount, Fine_Points, Incident_ID) VALUES ('$_POST[amount]','$_POST[points]','$_POST[incident]')";

$fine = mysqli_query($conn, $isql);



/*$sql3="UPDATE ownership SET People_ID = (SELECT id FROM people WHERE people.People_licence = '$own2') WHERE ownership.People_ID IS NULL;";
$car2 = mysqli_query($conn, $sql3); */

/*$sql="INSERT INTO vehicle (Vehicle_licence, Vehicle_type, Vehicle_colour) VALUES
('$_POST[Registration]','$_POST[Type]','$_POST[Colour]')"; 

$sql1="INSERT INTO people(fn, ln, People_licence, People_address) VALUES ('$_POST[firstname]','$_POST[lastname]','$_POST[licence]','$_POST[addy]')";

$sql2="INSERT INTO ownership(Vehicle_ID) SELECT Vehicle_ID FROM vehicle WHERE NOT EXISTS (SELECT Vehicle_ID FROM ownership WHERE ownership.Vehicle_ID = vehicle.Vehicle_ID)"; 

$sql3="UPDATE ownership SET People_ID = (SELECT id FROM people WHERE people.People_licence = '$own') WHERE ownership.People_ID IS NULL;"; 


$insert = mysqli_query($conn, $sql);
$insert1 = mysqli_query($conn, $sql1);
$insert2 = mysqli_query($conn, $sql2);
$insert3 = mysqli_query($conn, $sql3);*/
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

