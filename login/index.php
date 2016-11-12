<?php 
    session_start();
    if (isset($_SESSION['user'])) {
        echo "<script>window.location='../'</script>";
        exit();
    }
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf8">
	<title>登陆</title>
	<!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="../css/login.css"/>
</head>
<body>

	<div class="container">
		<div class="row login">
			<div class="content col s12">
				<div class="login-box z-depth-2">
					<div class="row option">
						<div class="logo-login-img deep-purple-text text-darken-4">工大二手工坊</div>
					</div>

					<div class="row option">
						<div class="">
							<span style="font-size: 16px;font-weight: 400;" class="">Welcome</span>
						</div>
					</div>

					<form action="../action/action.php?action=login" method="post">
						<div class="row">
							<label for="username" style="float: left !important;">用户名</label>
							<input type="text" name="username" placeholder="Username"></input>
						</div>
						<div class="row">
							<label for="password" style="float: left !important;">密码</label>
							<input type="password" name="password" placeholder="Password"></input>
						</div>
						<div class="row">
							<button type="submit" class="lime darken-3 btn btn-primary">登陆</button>
						</div>
						<div class="row" style="">
							<a href="#" class="legend" >
								忘记密码？
							</a>
						</div>
						<div class="row">
							<a href="../signup" class="legend">
								注册
							</a>
						</div>
					</form> 

				</div>
			</div>
		</div>
	</div>




	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>