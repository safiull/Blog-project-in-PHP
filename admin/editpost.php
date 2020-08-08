<?php
    include "inc/header.php";
    include "inc/sidebar.php";
?>

<!-- Select all data for edit start -->
<?php
    if (!isset($_GET['postid']) || $_GET['postid'] == NULL) {
        header("location: postlist.php");
    } else {
        $postid = $_GET['postid'];
    }
?>



        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Post</h2>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title    = mysqli_real_escape_string($db->link, $_POST['title']);
        $category = mysqli_real_escape_string($db->link, $_POST['category']);
        $body     = mysqli_real_escape_string($db->link, $_POST['body']);
        $tags     = mysqli_real_escape_string($db->link, $_POST['tags']);
        $author   = mysqli_real_escape_string($db->link, $_POST['author']);
        $userid   = mysqli_real_escape_string($db->link, $_POST['userid']);

        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div            = explode('.', $file_name);
        $file_ext       = strtolower(end($div));
        $unique_image   = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "upload/".$unique_image;

if ($title == '' || $category == '' || $body == '' || $tags == '' || $author == '') {
    echo "<span style='color: red'>Field must not be empty</span>";
} else {
    if (!empty($file_name)) {
        if ($file_size >1048567) {
            echo "<span class='error'>Image Size should be less then 1MB!
             </span>";
        } elseif (in_array($file_ext, $permited) === false) {
            echo "<span class='error'>You can upload only:-"
             .implode(', ', $permited)."</span>";
        } else{

            move_uploaded_file($file_temp, $uploaded_image);
            $query = "UPDATE `blog_post` SET `category`= '$category',`title`='$title',`body`='$body',`image`='$uploaded_image', `author`='$author',`tags`='$tags',`userid`='$userid' WHERE `id` = '$postid'";
            $updated_row = $db->update($query);
                if ($updated_row) {
                    echo "<span style='font-weight-bold' class='success'>Data Updated Successfully..</span>";
                } else {
                    echo "<span class='error'>Data Not Updated ! !</span>";
                }
            }
    } else {
        $query = "UPDATE `blog_post` SET `category`= '$category',`title`='$title',`body`='$body', `author`='$author',`tags`='$tags',`userid`='$userid' WHERE `id` = '$postid'";
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



                <div class="block">        
<?php

    $query  = "SELECT * FROM `blog_post` WHERE `id` = '$postid' ORDER BY id DESC";
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
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="category" >
                                    <option>Select Category</option>
<?php
    $query = "SELECT * FROM `blog_category`";
    $result = $db->select($query);
    if ($result) {
        while ($category = $result->fetch_assoc()) {
            


?>
                                    <option
                                    <?php
                                        if ($row['category'] == $category['id']) { ?>
                                           selected="selected" 
                                    <?php } ?> value="<?= $row['id']; ?>"><?= $category['name']; ?></option>
<?php
        }
    }
?>
                                </select>
                            </td>
                        </tr>
                   
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <img src="<?= $row['image']; ?>" width="200px" height="100px" /><br>
                                <input name="image" type="file" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea name="body" class="tinymce">
                                    <?= $row['body']; ?>
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input value="<?= $row['tags']; ?>" type="text" name="tags" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input value="<?= $row['author']; ?>" type="text" name="author" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input value="<?= Session::get('userId'); ?>" type="hidden" name="userid" />
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

<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>


<?php
    include "inc/footer.php";
?>
