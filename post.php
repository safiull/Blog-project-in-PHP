<?php
	include "inc/header.php";

	if (!isset($_GET['id']) || $_GET['id'] == NULL) {
		header("location: 404.php");
	} else {
		$id = $_GET['id'];
	}
?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<?php
				$query = "SELECT * FROM `blog_post` WHERE `id`='$id'";
				$post  = $db->select($query);
				if ($post) {
					while ($row = $post->fetch_assoc()) {
				
			?>
			<div class="about">
				<h2><?= $row['title'] ?></h2>
				<h4><?= date("d/M/Y :- g:i a", strtotime($row['datetime'])) ?>, By <a href="#"><?= $row['author'] ?></a></h4>
				<img src="admin/<?= $row['image']; ?>" alt="post image"/>
				<?= $row['body']; ?>
				
				<div class="relatedpost clear">
					<h2>Related articles</h2>
					<?php
						$category_id = $row['id'];
						$ralated_query = "SELECT * FROM `blog_post` WHERE `category` = '$category_id' ORDER BY rand() LIMIT 6";
						$ralated_post  = $db->select($ralated_query);
						if ($ralated_post) {
							while ($rresult = $ralated_post->fetch_assoc()) {
						
					?>
					
					<a href="post.php?id=<?= $rresult['id'] ?>">
						<img src="admin/<?= $rresult['image']; ?>" alt="post image"/>
					</a>
					<?php
						}
					} else {
						echo "Relatade Post isn't available.";
					}
					?>
				</div>
				<?php
					}
				} else {
					header("location: 404.php");
				}
				?>
	</div>

<?php
	include 'inc/sidebar.php';
	include 'inc/footer.php';
?>

