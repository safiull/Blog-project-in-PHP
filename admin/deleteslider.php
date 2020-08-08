<?php 

    include "inc/header.php";


if (!isset($_GET['sliderid']) || $_GET['sliderid'] == NULL) {
    header("location: sliderlist.php");
} else {
    $sliderid = $_GET['sliderid'];

    $query = "SELECT * FROM `slider` WHERE `id`='$sliderid'";
    $result = $db->select($query);
    if ($result) {
    	while ($row = $result->fetch_assoc()) {
    	    $selected_img = $row['slider'];
    	    unlink($selected_img);
    	}
    	
    }

    $query = "DELETE FROM `slider` WHERE `id` = '$sliderid'";
	$deletepost = $db->delete($query);
	if ($deletepost) {
		echo "<script>alert('Data deleted successfully.')</script>";
	    header("location: sliderlist.php");
	} else {
		echo "<script>alert('Data not deleted successfully.')</script>";
	    header("location: sliderlist.php");
	}
}

