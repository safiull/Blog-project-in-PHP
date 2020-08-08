<?php
	include 'inc/header.php';

?>

<?php
    if (!isset($_GET['page']) || $_GET['page'] == NULL) {
        header("location: 404.php");
    } else {
        $page = $_GET['page'];
    }
?>

<?php
    $query  = "SELECT * FROM `pages` WHERE `id`= '$page'";
    $result = $db->select($query);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            
        
?>  
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2><?= $row['name']; ?></h2>
				
				<?= $row['body']; ?>
	</div>
		
<?php
		}
	} else {
		header("location: 404.php");
	}
	include 'inc/sidebar.php';
	include 'inc/footer.php';
?>
