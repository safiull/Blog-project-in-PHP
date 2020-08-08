<?php
    include "inc/header.php";
    include "inc/sidebar.php";
?>

<!-- Select all data for edit start -->
<?php
    if (!isset($_GET['sliderid']) || $_GET['sliderid'] == NULL) {
        header("location: sliderlist.php");
    } else {
        $sliderid = $_GET['sliderid'];
    }
?>



        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Edit Slider</h2>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title    = mysqli_real_escape_string($db->link, $_POST['title']);

        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['slider']['name'];
        $file_size = $_FILES['slider']['size'];
        $file_temp = $_FILES['slider']['tmp_name'];

        $div            = explode('.', $file_name);
        $file_ext       = strtolower(end($div));
        $unique_image   = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "upload/slider/".$unique_image;

if ($title == '') {
    echo "<span style='color: red'>Field must not be empty</span>";
} else {
    if (!empty($file_name)) {
        if ($file_size >2048567) {
            echo "<span class='error'>Image Size should be less then 1MB!
             </span>";
        } elseif (in_array($file_ext, $permited) === false) {
            echo "<span class='error'>You can upload only:-"
             .implode(', ', $permited)."</span>";
        } else{

            move_uploaded_file($file_temp, $uploaded_image);
            $query = "UPDATE `slider` SET `title`='$title',`slider`='$uploaded_image' WHERE `id` = '$sliderid'";
            $updated_row = $db->update($query);
                if ($updated_row) {
                    echo "<span style='font-weight-bold' class='success'>Slider Updated Successfully..</span>";
                } else {
                    echo "<span class='error'>Slider Not Updated ! !</span>";
                }
            }
    } else {
        $query = "UPDATE `slider` SET `title`='$title' WHERE `id` = '$sliderid'";
        $updated_row = $db->update($query);
            if ($updated_row) {
                echo "<span style='font-weight-bold' class='success'>Slider Updated Successfully.</span>";
            } else {
                echo "<span class='error'>Slider Not Updated !</span>";
            }
    }
    }
}

?>



                <div class="block">        
<?php

    $query  = "SELECT * FROM `slider` WHERE `id` = '$sliderid'";
    $result = $db->select($query);
    
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            

?>
<!-- Select all data for edit end -->       
                 <form action="" method="POST" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" class="medium" name="title" value="<?= $row['title']; ?>" />
                            </td>
                        </tr>
                   
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <img src="<?= $row['slider']; ?>" width="200px" height="100px" /><br>
                                <input name="slider" type="file" />
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
<?php

    }
}

?>
                </div>
            </div>
        </div>




<?php
    include "inc/footer.php";
?>
