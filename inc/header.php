<?php
	include 'config/config.php';
	include 'lib/Database.php';
	include 'helpers/format.php';
?>
<?php
	$db     = new Database();
	$format = new Format();
?>
<!DOCTYPE html>
<html>
<head>
	<?php
		include 'scripts/meta.php';
		include 'scripts/css.php';
		include 'scripts/js.php';
	?>	
	

</head>

<body>
	<div class="headersection templete clear">
		<a href="#">
			<div class="logo">
<?php
    $query  = "SELECT * FROM `title_slogan` WHERE `id` = 1";
    $result = $db->select($query);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
                 

?>
				<img src="admin/<?= $row['logo'] ?>" alt="Logo"/>
				<h2><?= $row['title'] ?></h2>
				<p style="margin-left: 88px; margin-top: -13px;"><?= $row['slogan'] ?></p>
<?php } } ?>
			</div>
		</a>
		<div class="social clear">
			<div class="icon clear">
<?php
    $query  = "SELECT * FROM `social_links`";
    $result = $db->select($query);
    if ($result) {
        while ($row  = $result->fetch_assoc()) {
            
?>  
				<a href="<?= $row['facebook'] ?>" target="_blank"><i class="fa fa-facebook"></i></a>
				<a href="<?= $row['twitter'] ?>" target="_blank"><i class="fa fa-twitter"></i></a>
				<a href="<?= $row['linkedin'] ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
				<a href="<?= $row['google+'] ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
<?php } } ?>
			</div>
			<div class="searchbtn clear">
			<form action="search.php" method="GET">
				<input type="text" name="search" placeholder="Search keyword..."/>
				<input type="submit" name="submit" value="Search"/>
			</form>
			</div>
		</div>
	</div>
<div class="navsection templete">
<?php
	// for get main path
	$path = $_SERVER['SCRIPT_FILENAME'];
	$currentPage = basename($path, '.php');
?>
	<ul>
		<li><a
		<?php
			if ($currentPage == 'index') {
				echo 'id="active"';
			}
		?>
		 href="index.php">Home</a></li>

		<?php
            $query  = "SELECT * FROM `pages`";
            $result = $db->select($query);
            if ($result) {
                while ($row = $result->fetch_assoc()) {
          
        ?> 
                <li><a
				<?php
					if (isset($_GET['page']) && $_GET['page'] == $row['id']) {
						echo 'id="active"';
					}
				?>
                 href="page.php?page=<?= $row['id']; ?>"><?= $row['name']; ?></a></li>
            <?php } } ?>
		<li><a
		<?php
			if ($currentPage == 'contact_us') {
				echo 'id="active"';
			}
		?>
		 href="contact_us.php">Contact</a></li>
	</ul>
</div>