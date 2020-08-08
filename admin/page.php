<?php
    include "inc/header.php";
    include "inc/sidebar.php";
?>

<style>
    .delete{
        border: 1px solid #ddd;
        cursor: pointer;
        font-size: 20px;
        padding: 5px 10px;
        background: #d16619;
        margin-left: 20px;
    }
    .delete a{
        font-weight: normal;
        color: #000;
    }
</style>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Post</h2>
<?php
    if (!isset($_GET['pageid']) || $_GET['pageid'] == NULL) {
        header("location: index.php");
    } else {
        $pageid = $_GET['pageid'];
    }
?>


<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = mysqli_real_escape_string($db->link, $_POST['name']);
        $body = mysqli_real_escape_string($db->link, $_POST['body']);

        

if ($name == '' || $body == '') {
    echo "<span style='color: red'>Field must not be empty</span>";
} else{
    $query = "UPDATE `pages` SET `name`='$name', `body`='$body' WHERE `id` = '$pageid'";
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
                    <?php
                        $query  = "SELECT * FROM `pages` WHERE `id`= '$pageid'";
                        $result = $db->select($query);
                        if ($result) {
                            while ($row = $result->fetch_assoc()) {
                                
                            
                    ?>                        
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" value="<?= $row['name'] ?>" name="name" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea name="body" class="tinymce">
                                    <?= $row['body'] ?>
                                </textarea>
                            </td>
                        </tr>
 
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                                <span class="delete"><a onclick="return confirm('Are you sure you want to delete this data?')"href="deletepage.php?pageid=<?= $row['id'] ?>">Delete Page</a></span>
                            </td>
                        </tr>
<?php } } ?>
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
