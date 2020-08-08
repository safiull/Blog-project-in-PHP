<div class="slidersection templete clear">
        <div id="slider">
	    <?php

	        $query = "SELECT * FROM `slider`";
	        $result = $db->select($query);	
	        while ($row = mysqli_fetch_assoc($result)) {
	            
	        
	    ?>
            <a href="#"><img src="admin/<?= $row['slider']; ?>" alt="nature 1" title="<?= $row['title']; ?>" /></a>
        <?php
        	}
        ?>
        </div>

</div>