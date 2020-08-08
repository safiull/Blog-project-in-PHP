<?php

	if (isset($_GET['page'])) {
        $pageid = $_GET['page'];
        $query = "SELECT * FROM `pages` WHERE `id` = '$pageid'";
        $result = $db->select($query);
        while ($row = $result->fetch_assoc()) {
        ?>
          	<title><?= $row['name']." - ".TITLE; ?></title>
        <?php  
        }
    } elseif (isset($_GET['id'])) {
    	$postid = $_GET['id'];
        $query = "SELECT * FROM `blog_post` WHERE `id` = '$postid'";
        $result = $db->select($query);
        while ($row = $result->fetch_assoc()) {
        ?>
          	<title><?= $row['title']." - ".TITLE; ?></title>
        <?php  
        }
    } else {
    	?>
        <title><?= $format->title()." - ".TITLE; ?></title>

        <?php
    }

?>
	
	<meta name="language" content="English">
	<meta name="description" content="It is a website about education">
	<meta name="author" content="Delowar">
<?php
	if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM `blog_post` WHERE `id`='$id'";
        $result = $db->select($query);
        if ($result) {
        	while ($row = $result->fetch_assoc()) {
        ?>
	        <meta name="keywords" content="<?= $row['tags']; ?>">
	    <?php  
	        }
    	} 
    } else {
	    	?>

	    	<meta name="keywords" content="<?= KEYWORDS; ?>">

        <?php
	}
         

?>