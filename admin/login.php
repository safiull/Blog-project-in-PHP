<?php
	include '../lib/Session.php';
	Session::checkLogin();

	if (isset($SESSION['login'])) {
		header("location: index.php");
	}
?>

<?php
	include '../config/config.php';
	include '../lib/Database.php';
	include '../helpers/format.php';
?>
<?php
	$db     = new Database();
	$format = new Format();
?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<style type="text/css" media="screen">
		
</style>
<div class="container">
	<section id="content">
		<?php
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$username = $format->validation($_POST['username']);
				$password = $format->validation(md5($_POST['password']));

				// milicial code diye jate attack korete na pare.
				// ekhane 2ta paramateer na dile error asbe
				$username = mysqli_real_escape_string($db->link, $username);
				$password = mysqli_real_escape_string($db->link, $password);

				

				$query = "SELECT * FROM `blog_user` WHERE `username` = '$username' AND `password` = '$password'";
				$result = $db->select($query);
				if ($result != false) {
					$value = mysqli_fetch_array($result);
					$row   = mysqli_num_rows($result);
					if ($row > 0) {
						$_SESSION['userRole'] = $value['role'];
						Session::set("login", true);
						Session::set("username", $value['username']);
						Session::set("userId", $value['id']);
						header("Location: index.php");
					} else {
						echo "<span style='color: red'>Data not found</span>";
					}

				} else {
					echo "<span style='color: red'>Username or password not match</span>";
				}
			}
		?>
		<form action="" method="POST">
			<h1>Admin Login</h1>
			<div>
				<input type="text" placeholder="Username" required="" name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required="" name="password"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="forgot_password.php">Forgot password</a>
		</div><!-- button --><div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>