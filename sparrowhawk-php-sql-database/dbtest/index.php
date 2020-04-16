<?php
session_start();
require_once 'dbconnect.php';

if (isset($_SESSION['userSession'])!="") {
	header("Location: home.php");
	exit;
}

if (isset($_POST['btn-login'])) {
	
	$username = strip_tags($_POST['username']);
	$password = strip_tags($_POST['password']);
	
	$username = $DBcon->real_escape_string($username);
	$password = $DBcon->real_escape_string($password);
	
	$query = $DBcon->query("SELECT user_id, username, password FROM tbl_users WHERE username='$username'");
	$row=$query->fetch_array();
	
	$count = $query->num_rows; // if name/password are correct returns must be 1 row
	
	if ($password = $row['password'] && $count==1) {
		$_SESSION['userSession'] = $row['user_id'];
		header("Location: home.php");
	}
	
		else{
		$msg = "<div class='alert alert-danger'>
					<span class='glyphicon glyphicon-info-sign'></span> &nbsp; Invalid Username or Password !
				</div>";
	}
	$DBcon->close();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sparrowhawk Login</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>

<div class="signin-form">

	<div class="container">
     
        
       <form class="form-signin" method="post" id="login-form">
      
        <h2 class="form-signin-heading">Sign In.</h2><hr />
        
        <?php
		if(isset($msg)){
			echo $msg;
		}
		?>
        
        <div class="form-group">
        <input type="username" class="form-control" placeholder="Username" name="username" required />
        <span id="check-e"></span>
        </div>
        
        <div class="form-group">
        <input type="password" class="form-control" placeholder="Password" name="password" required />
        </div>
       
     	<hr />
        
        <div class="form-group">
            <button type="submit" class="btn btn-default" name="btn-login" id="btn-login">
    		<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In
			</button> 
            
            <!--<a href="register.php" class="btn btn-default" style="float:right;">Add Account</a>-->
            
        </div>  
        
        
      
      </form>

    </div>
    
</div>

</body>
</html>