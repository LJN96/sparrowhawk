<?php
session_start();
include_once 'dbconnect.php';


if (!isset($_SESSION['userSession'])) {
	header("Location: index.php");

}

$query = $DBcon->query("SELECT * FROM tbl_users WHERE user_id=".$_SESSION['userSession']);
$userRow=$query->fetch_array();
$DBcon->close();

/*if ($userRow['username'] ='haskins'){
  header("Location: home.php");
}*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $userRow['email']; ?></title>

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
            <li class="active"><a href="home.php">Home</a></li>
            <li><a href="vehicleindexsql.php">Vehicles</a></li>
            <li><a href="crudindex3.php">Persons</a></li>
            <li><a href="report.php">Report</a></li>
            <?php if($userRow['username'] =='haskins') : ?><li><a href="register.php">Add Users</a></li>
              <li><a href="fines.php">Fines</a></li>
            <?php endif; ?>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp; <?php echo $userRow['username']; ?></a></li>
            <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp; Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

<div class="container" style="margin-top:100px;text-align:center;font-family:Verdana, Geneva, sans-serif;font-size:16px;">
    <h><i>Welcome to Sparrowhawk Police Traffic Database</i></h></br>
    <img class="roundimg" src="img.png" alt="Sparrowhawk">
    <br></br>
    <h>scientia et labor</h></br>
</div>
<br></br>




</body>
</html>