<?php
    include "inc/header.php";
    include "inc/sidebar.php";
?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Post</h2>
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

if ($title == '' || $category == '' || $body == '' || $tags == '' || $author == '' || $file_name == '') {
    echo "<span style='color: red'>Field must not be empty</span>";
} elseif ($file_size >1048567) {
    echo "<span class='error'>Image Size should be less then 1MB!
     </span>";
} elseif (in_array($file_ext, $permited) === false) {
    echo "<span class='error'>You can upload only:-"
     .implode(', ', $permited)."</span>";
} else{
    move_uploaded_file($file_temp, $uploaded_image);
    $query = "INSERT INTO `blog_post`(`category`, `title`, `body`, `image`, `author`, `tags`, `userid`) 
        VALUES ('$category', '$title', '$body', '$uploaded_image', '$author', '$tags', '$userid')";
    $inserted_rows = $db->insert($query);
        if ($inserted_rows) {
            echo "<span style='font-weight-bold' class='success'>Data Inserted Successfully.</span>";
        } else {
            echo "<span class='error'>Image Not Inserted !</span>";
        }
    }
}

?>
                <div class="block">               
                 <form action="" method="POST" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" placeholder="Enter Post Title..." class="medium" name="title" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="category">
                                    <option>SElECT</option>
<?php
    $query = "SELECT * FROM `blog_category`";
    $result = $db->select($query);
    if ($result) {
        while ($category = $result->fetch_assoc()) {
            


?>
                                    <option value="<?= $category['id']; ?>"><?= $category['name']; ?></option>
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
                                <input name="image" type="file" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea name="body" class="tinymce"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name="tags" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" name="author" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="hidden" value="<?= Session::get('userId') ?>" name="userid" />
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
