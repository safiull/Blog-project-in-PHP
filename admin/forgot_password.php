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
				$email = $format->validation($_POST['email']);
				// milicial code diye jate attack korete na pare.
				// ekhane 2ta paramateer na dile error asbe
				$email = mysqli_real_escape_string($db->link, $email);
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
		        	echo "<span style='color: red'>Invalid email address.</span>";
		        } else {
		        	$query = "SELECT * FROM `blog_user` WHERE `email` = '$email' LIMIT 1";
					$result = $db->select($query);
					if ($result != false) {
						while ($row = $result->fetch_assoc()) {
						    $userId = $row['id'];
						    $username = $row['username'];
						}
						// for get some word from email.(0,3)
						$text = substr($email, 0,3);
						// generate a random number in 10000 to 99999!
						$rand = rand(10000, 99999);
						$newpassword = '$text$rand';
						$password = md5($newpassword);
						$query = "UPDATE `blog_user` SET `password`= '$password' WHERE `id` = '$userId'";
            			$result = $db->update($query);

            			$to      = "$email";
            			$from    = "honestit@gmail.com";
            			$header  = "From: $from\n";
            			$header .= "MIME-Version: 1.0" . "\r\n";
            			$header .= "Content-type: text/html; charset=UTF-8" . "\r\n";
            			$subject = "Your Password";
            			$message = "Your username is : ".$username."and password new passwrod is : ".$newpassword." Please visit our for login";

                
            			$sandMail = mail($to, $subject, $message, $header);
            			if ($sandMail) {
			                echo "<span style='color: green; font-weight: bold;'>Password Recovery successfully.</span>";
			            } else {
			                echo "<span style='color: red'>Password not recover!</span>";
			            }
					} else {
						echo "<span style='color: red'>Your email is incorrect please enter a valid email.</span>";
					}
		        }

				
			}
		?>
		<form action="" method="POST">
			<h1>Password Recovery</h1>
			<div>
				<input type="text" placeholder="Enter your email" required="" name="email"/>
			</div>
			<div>
				<input type="submit" value="Send Mail" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="login.php">Login</a>
		</div>
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>