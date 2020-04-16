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
<!DOCTYPE html>
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
            <li class="active"> <a href="crudindex3.php">Persons</a></li>
            <li><a href="report.php">Report</a></li>
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
include_once 'crud3.php';
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Person Search</title>
<link rel="stylesheet" href="style2.css" type="text/css" />
</head>

<body>
<center>
<div id="header">
  <label></label>
</div>
<br />
<h1>Person Search</h1>
<br />
<html>
  <head>
    <title>Search</title>
  </head>
<body>
  <form method="get" width="100%" border="1" cellpadding="15" align="center">
    <input type="text" name="q" placeholder="Names / License Number" dir="ltr">
    <input type="submit" value="search">
  </form>
</body>
</html>
<br />

<?php
   
    $conn = mysqli_connect("localhost", "root", "", "dbtest");
   
    if(mysqli_connect_errno()){
        echo "Failed to connect: " . mysqli_connect_error();
    }
 
    error_reporting(0);
 
    $output = '';
   
    if(isset($_GET['q']) && $_GET['q'] !== ' '){
        $searchq = $_GET['q'];
       
        $q = mysqli_query($conn, "SELECT * FROM people WHERE fn LIKE '%$searchq%' or ln LIKE '%$searchq%' or People_licence LIKE '%$searchq%'") or die(mysqli_error());
        $c = mysqli_num_rows($q);
        if($c == 0){
            $output = 'No search results for <b>"' . $searchq . '"</b>';
        } else {
            while($row = mysqli_fetch_array($q)){
                $id = $row['id'];
                $fn = $row['fn'];
                $ln = $row['ln'];
                $pa = $row['People_address'];
                $pl = $row['People_licence'];
               
                $output .= '<p width="100%" border="1" cellpadding="15" align="center">"' . $id . ': ' . $fn . ' ' . $ln . ' - ' . $pl . ' - ' . $pa . '"
                            
                            </p>';
            }
        }
    } 
    print("$output");
    mysqli_close($conn);
 
?>





</table>
</div>
</center>
</body>
</html>
</div>
</body>
</html>