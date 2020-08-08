<?php
	include "inc/header.php";
?>

<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$fname = $format->validation($_POST['firstname']);
		$lname = $format->validation($_POST['lastname']);
		$email = $format->validation($_POST['email']);
		$body = $format->validation($_POST['body']);

        $fname = mysqli_real_escape_string($db->link, $fname);
        $lname = mysqli_real_escape_string($db->link, $lname);
        $email = mysqli_real_escape_string($db->link, $email);
        $body  = mysqli_real_escape_string($db->link, $body);

        $error = "";
        if (empty($fname)) {
        	$error = "First name field must not be empty";
        } elseif (empty($lname)) {
        	$error = "Last name field must not be empty";
        } elseif (empty($email)) {
        	$error = "Email field must not be empty";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
        	$error = "Invalid email";
        } elseif (empty($body)) {
        	$error = "Body field must not be empty";
        } else {
        	$query = "INSERT INTO `contact_form`(`fname`, `lname`, `email`, `body`) VALUES ('$fname', '$lname', '$email', '$body')";
		    $inserted_rows = $db->insert($query);
		        if ($inserted_rows) {
		            $msg = "Message sent successfully";
		        } else {
		            $error = "Message not sent !";
		        }
        }

    }
?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2>Contact us</h2>
				<?php
					if (isset($error)) {
						echo '<span style="color: red">'.$error.'</span>';
					} 
					if (isset($msg)) {
						echo '<span style="color: green">'.$msg.'</span>';
					}
				?>
			<form action="" method="post">
				<table>
				<tr>
					<td>Your First Name:</td>
					<td>
					<input type="text" name="firstname" placeholder="Enter first name">
					</td>
				</tr>
				<tr>
					<td>Your Last Name:</td>
					<td>
					<input type="text" name="lastname" placeholder="Enter Last name" />
					</td>
				</tr>
				
				<tr>
					<td>Your Email Address:</td>
					<td>
					<input type="text" name="email" placeholder="Enter Email Address" />
					</td>
				</tr>
				<tr>
					<td>Your Message:</td>
					<td>
					<textarea name="body"></textarea>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
					<input type="submit" name="submit" value="Submit"/>
					</td>
				</tr>
		</table>
	<form>				
 </div>

		</div>
		<div class="sidebar clear">
			<div class="samesidebar clear">
				<h2>Latest articles</h2>
					<ul>
						<li><a href="#">Category One</a></li>
						<li><a href="#">Category Two</a></li>
						<li><a href="#">Category Three</a></li>
						<li><a href="#">Category Four</a></li>
						<li><a href="#">Category Five</a></li>						
					</ul>
			</div>
			<div class="samesidebar clear">
				<h2>Popular articles</h2>
					<div class="popular clear">
						<h3><a href="#">Post title will be go here..</a></h3>
						<a href="#"><img src="images/post1.jpg" alt="post image"/></a>
						<p>Sidebar text will be go here.Sidebar text will be go here.Sidebar text will be go here.Sidebar text will be go here.</p>	
					</div>
					
					<div class="popular clear">
						<h3><a href="#">Post title will be go here..</a></h3>
						<a href="#"><img src="images/post1.jpg" alt="post image"/></a>
						<p>Sidebar text will be go here.Sidebar text will be go here.Sidebar text will be go here.Sidebar text will be go here.</p>	
					</div>
					
					<div class="popular clear">
						<h3><a href="#">Post title will be go here..</a></h3>
						<a href="#"><img src="images/post1.jpg" alt="post image"/></a>
						<p>Sidebar text will be go here.Sidebar text will be go here.Sidebar text will be go here.Sidebar text will be go here.</p>	
					</div>
					
					<div class="popular clear">
						<h3><a href="#">Post title will be go here..</a></h3>
						<a href="#"><img src="images/post1.jpg" alt="post image"/></a>
						<p>Sidebar text will be go here.Sidebar text will be go here.Sidebar text will be go here.Sidebar text will be go here.</p>	
					</div>
	
			</div>
			
		</div>
	</div>

	<div class="footersection templete clear">
	  <div class="footermenu clear">
		<ul>
			<li><a href="#">Home</a></li>
			<li><a href="#">About</a></li>
			<li><a href="#">Contact</a></li>
			<li><a href="#">Privacy</a></li>
		</ul>
	  </div>
	  <p>&copy; Copyright Training with live project.</p>
	</div>
    <div class="fixedicon clear">
		<a href="http://www.facebook.com"><img src="images/fb.png" alt="Facebook"/></a>
		<a href="http://www.twitter.com"><img src="images/tw.png" alt="Twitter"/></a>
		<a href="http://www.google.com"><img src="images/gl.png" alt="GooglePlus"/></a>
		<a href="http://www.linkedin.com"><img src="images/in.png" alt="LinkedIn"/></a>
	</div>
</body>
</html>