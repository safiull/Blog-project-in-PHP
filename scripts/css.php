<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">	
<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="style.css">

<?php
	$query = "SELECT * FROM `themes` WHERE `id` = '1'";
    $result = $db->select($query);	
    while ($row = mysqli_fetch_assoc($result)) {
    	if ($row['theme'] == 'default') { ?>
			<link rel="stylesheet" href="themes/default.css">
		<?php
		} elseif ($row['theme'] == 'green') { ?>
			<link rel="stylesheet" href="themes/green.css">
		<?php
		} elseif ($row['theme'] == 'red') { ?>
			<link rel="stylesheet" href="themes/red.css">
		<?php	
		}
    }
	
	
?>