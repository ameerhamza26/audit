


<!DOCTYPE html>
<html>
<head>
	<title>login</title>
	<link rel="shortcut icon" href="favicon.ico" />

	<link rel="stylesheet" type="text/css" href="css/app.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-datetimepicker.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/sb-admin2.css">
	<link rel="stylesheet" type="text/css" href="css/selectionPage.css">
	<link rel="stylesheet" type="text/css" href="css/sms.css">
	<link rel="stylesheet" type="text/css" href="css/structure.css">
	<link rel="stylesheet" type="text/css" href="css/design.css">
</head>
<body>
	<br />
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Login<img style="float:right;" src="img/logo.png"></div>
					<br />
					<br />
					<div class="panel-body">


						<form class="form-horizontal" role="form" method="POST" action="login.php">


							<div class="form-group">
								<label class="col-md-4 control-label">E-Mail Address</label>
								<div class="col-md-6">
									<input type="email" class="form-control" name="Email" value="">
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Password</label>
								<div class="col-md-6">
									<input type="password" class="form-control" name="Password">
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-success">Login</button>
								</div>
							</div>
						</form>
						<?php
						include_once 'db_functions.php';
						session_start(); 
						if(isset($_SESSION['login_user'])){
							header("location: profile.php");
						}


						$error=''; 
						if (isset($_POST['Email'])) {
							if (empty($_POST['Email']) || empty($_POST['Password'])) {
								$error = "Email or Password is invalid";
							}
							else
							{
								$Email=$_POST['Email'];
								$Password=$_POST['Password'];	
								$db = new DB_Functions();
								$user = $db->getSingleUser($Email,$Password);
								$rows = mysql_num_rows($user);


								if ($rows == 1) {
									$row = mysql_fetch_array($user);
									if($row["Active"] == '1'){
										$_SESSION['login_user']=$Email;
										$_SESSION['login_name']=$row["Name"];
										header("location: profile.php");
									}
									else{
										echo('<span style="color:red">User Disabled<span>');
									} 
								} else {
									echo('<span style="color:red">Username or Password Incorrect<span>');
								}
							}
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/moment.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="js/util.js"></script>
<script type="text/javascript" src="js/skel.min.js"></script>
</html>



