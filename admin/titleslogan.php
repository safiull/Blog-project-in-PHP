<?php
    include "inc/header.php";
    include "inc/sidebar.php";
?>



<style>
    .leftside{
        width: 70%;
        float: left;
    }
    .rightside{
        width: 30%;
        float: left;
    }
    .rightside img{
        width: 170px;
        height: 160px;
    }
</style>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Site Title and Description</h2>
<?php
    $query  = "SELECT * FROM `title_slogan` WHERE `id` = 1";
    $result = $db->select($query);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
                 

?>

<?php
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title  = $format->validation($_POST['title']);
        $slogan = $format->validation($_POST['slogan']);

        $title  = mysqli_real_escape_string($db->link, $title);
        $slogan = mysqli_real_escape_string($db->link, $slogan);

        $file_type = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $get_extension  = explode('.', $file_name);
        $file_extension = strtolower(end($get_extension));
        $final_name     = "logo".'.'.$file_extension;
        $upload_image   = "upload/".$final_name;



        if ($title == '' || $slogan == '') {
            echo "<span style='color: red'>Field must not be empty</span>";
        } else {
            if (!empty($file_name)) {
                if ($file_size > 1048567) {
                    echo "<span class='error'>Image Size should be less then 1MB!
                    </span>";
                } elseif (in_array($file_extension, $file_type) === false) {
                    echo "<span class='error'>You can upload only:-"
                    .implode(', ', $file_type)." File.</span>";
                } else {

                    move_uploaded_file($file_temp, $upload_image);
                    $query = "UPDATE `title_slogan` SET `title`='$title', `slogan`='$slogan', `logo`='$upload_image' WHERE `id` = 1";
                    $updated_row = $db->update($query);
                    
                        if ($updated_row) {
                            echo "<span style='font-weight-bold' class='success'>Data Updated Successfully..</span>";
                        } else {
                            echo "<span class='error'>Data Not Updated ! !</span>";
                        }
                }
            } else {
                $query = "UPDATE `title_slogan` SET `title`='$title',`slogan`='$slogan' WHERE `id` = 1";
                $updated_row = $db->update($query);
                if ($updated_row) {
                    echo "<span style='font-weight-bold' class='success'>Data Updated Successfully.</span>";
                } else {
                    echo "<span class='error'>Data Not Updated !</span>";
                }
            }
        }
    }

?>
        <div class="block sloginblock">  
            <div class="leftside">
                <form action="" method="POST" enctype="multipart/form-data">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Website Title</label>
                            </td>
                            <td>
                                <input type="text" value="<?= $row['title'] ?>"  name="title" class="medium" />
                            </td>
                        </tr>
        				 <tr>
                            <td>
                                <label>Website Slogan</label>
                            </td>
                            <td>
                                <input type="text" value="<?= $row['slogan'] ?>" name="slogan" class="medium" />
                            </td>
                        </tr>
        				<tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <input name="image" type="file" />
                            </td>
                        </tr>
        				
        				 <tr>
                            <td>
                            </td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="rightside">
                <img src="<?= $row['logo'] ?>">
            </div>
        </div>

<?php }  } ?>

    </div>
</div>
<?php
    include "inc/footer.php";
?>
