<?php
	include 'inc/header.php';
	include 'inc/slider.php';

?>

<!-- Bootstrap link -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<!-- Bootstrap link -->

<?php
	$db     = new Database();
	$format = new Format();
?>
	

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
<!-- Pagination -->
	<?php
		$per_page = 3;
		if (isset($_GET['page'])) {
			$page = $_GET['page'];
		} else {
			$page = 1;
		}

		$start_from = ($page-1)*$per_page;
	?>
<!-- Pagination -->

			<?php
				$query = "SELECT * FROM `blog_post` LIMIT $start_from, $per_page";
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
<!-- Pagination -->
<?php
	$query = "SELECT * FROM `blog_post`";
	$result = $db->select($query);
	$total_rows = mysqli_num_rows($result);
	$total_pages = ceil($total_rows/$per_page);
?>
<div class="row justify-content-center">
<?php
echo "<ul class=\" pagination d-inline-block\"><li class=\"page-item\"><a class=\"page-link\" href='index.php?page=1'>".'First Page'."</a></li></ul>";


for ($i=1; $i <= $total_pages; $i++) { 
	echo "<ul class=\" pagination d-inline-block\"><li class=\"page-item\"><a class=\"page-link\"  href='index.php?page=$i'>".$i."</a></li></ul>";
}
echo "<ul class=\" pagination d-inline-block\"><li class=\"page-item\"><a class=\"page-link\" href='index.php?page=$total_pages'>".'Last Page'."</a></li></ul>";

?>
</div>
<!-- Pagination -->

<?php
	} else{
		header("location: 404.php");
	}
?>

<?php
	include 'inc/sidebar.php';
	include 'inc/footer.php';
?>