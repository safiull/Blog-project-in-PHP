<?php
    include "inc/header.php";
    include "inc/sidebar.php";
?>

<?php
    if (!isset($_GET['pageid']) || $_GET['pageid'] == NULL) {
        header("location: index.php");
    } else {
        $pageid = $_GET['pageid'];
        $query  = "DELETE FROM `pages` WHERE `id` = '$pageid'";
        $result = $db->delete($query);
    	if ($result) {
    		echo "<script>alert('Data deleted successfully.')</script>";
    		echo "<script>window.location = 'index.php';</script>";
    	} else {
    		echo "<script>alert('Data not deleted !')</script>";
    		echo "<script>window.location = 'index.php';</script>";
    	}
    }
?>