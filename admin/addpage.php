<?php
    include "inc/header.php";
    include "inc/sidebar.php";
?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Post</h2>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = mysqli_real_escape_string($db->link, $_POST['name']);
        $body = mysqli_real_escape_string($db->link, $_POST['body']);

        

if ($name == '' || $body == '') {
    echo "<span style='color: red'>Field must not be empty</span>";
} else{
    $query = "INSERT INTO `pages`(`name`, `body`) 
        VALUES ('$name', '$body')";
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
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" placeholder="Enter Page name..." class="medium" name="name" />
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
