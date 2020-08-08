<?php
	include 'inc/header.php';


	if (!isset($_GET['search']) || $_GET['search'] == NULL) {
		header("location: 404.php");
	} else {
		$search = $_GET['search'];
	}

?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<?php
				$query = "SELECT * FROM `blog_post` WHERE `title` LIKE '%$search%' OR `body` LIKE '%$search%' OR `author` LIKE '%$search%'";
				$post  = $db->select($query);
				if ($post) {
					while ($row = $post->fetch_assoc()) {
				
			?>
			<div class="samepost clear">
				<h2><a href="post.php?id=<?= $row['id'] ?>"><?= $row['title'] ?></a></h2>
				<h4><?= date("d/M/Y :- g:i a", strtotime($row['datetime'])) ?>, By <a href="#"><?= $row['author'] ?></a></h4>
				 <a href="post.php?id=<?= $row['id'] ?>"><img src="admin/<?= $row['image']; ?>" alt="post image"/></a>
				<?= $format->textShorten($row['body']); ?>
				<div class="readmore clear">
					<a href="post.php?id=<?= $row['id'] ?>">Read More</a>
				</div>
			</div>
		
	
<?php
	} // while loop end
?>

<?php
	} else{
		header("location: 404.php");
	}
?>

<?php
	include 'inc/sidebar.php';
	include 'inc/footer.php';
?>