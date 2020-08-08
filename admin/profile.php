<?php
    include "inc/header.php";
    include "inc/sidebar.php";

    $login_user_id = Session::get('userId');
?>

       <div class="grid_10">
		
            <div class="box round first grid">
                <h2>User Profile</h2>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name     = mysqli_real_escape_string($db->link, $_POST['name']);
        $username = mysqli_real_escape_string($db->link, $_POST['username']);
        $email    = mysqli_real_escape_string($db->link, $_POST['email']);
        $body     = mysqli_real_escape_string($db->link, $_POST['body']);
        

        $query = "UPDATE `blog_user` SET `username`='$username',`name`='$name', `email`='$email',`details`='$body' WHERE `id` = '$login_user_id'";
        $updated_row = $db->update($query);
        if ($updated_row) {
            echo "<span style='font-weight-bold' class='success'>Data Updated Successfully.</span>";
        } else {
            echo "<span class='error'>Data Not Updated !</span>";
        }
    }
?>



                <div class="block">        
<?php

    $query  = "SELECT * FROM `blog_user` WHERE `id` = '$login_user_id'";
    $result = $db->select($query);
    
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            

?>
<!-- Select all data for edit end -->       
                 <form action="" method="POST" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" class="medium" name="name" value="<?= $row['name']; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Username</label>
                            </td>
                            <td>
                                <input type="text" class="medium" name="username" value="<?= $row['username']; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>E-mail</label>
                            </td>
                            <td>
                                <input type="text" class="medium" name="email" value="<?= $row['email']; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Details</label>
                            </td>
                            <td>
                                <textarea name="body" class="tinymce">
                                    <?= $row['details']; ?>
                                </textarea>
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
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
