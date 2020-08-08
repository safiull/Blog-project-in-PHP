<?php 

    include "inc/header.php";


if (!isset($_GET['postid']) || $_GET['postid'] == NULL) {
    header("location: postlist.php");
} else {
    $postid = $_GET['postid'];

    $query = "SELECT * FROM `blog_post` WHERE `id`='$postid'";
    $result = $db->select($query);
    if ($result) {
    	while ($row = $result->fetch_assoc()) {
    	    $selected_img = $row['image'];
    	    unlink($selected_img);
    	}
    	
    }

    $query = "DELETE FROM `blog_post` WHERE `id` = '$postid'";
	$deletepost = $db->delete($query);
	if ($deletepost) {
		echo "<script>alert('Data deleted successfully.')</script>";
	    header("location: postlist.php");
	} else {
		echo "<script>alert('Data not deleted successfully.')</script>";
	    header("location: postlist.php");
	}
}

