<?php
    include "inc/header.php";
    include "inc/sidebar.php";
?>
        <div class="grid_10">
    		<div class="box round first grid">
                <h2>Update Social Media</h2>
<?php
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $facebook   = $format->validation($_POST['facebook']);
        $twitter    = $format->validation($_POST['twitter']);
        $linkedin   = $format->validation($_POST['linkedin']);
        $googleplus = $format->validation($_POST['googleplus']);

        $facebook   = mysqli_real_escape_string($db->link, $facebook);
        $twitter    = mysqli_real_escape_string($db->link, $twitter);
        $linkedin   = mysqli_real_escape_string($db->link, $linkedin);
        $googleplus = mysqli_real_escape_string($db->link, $googleplus);

        if ($facebook == '' || $twitter == '' || $linkedin == '' || $googleplus == '') {
            echo "<span style='color: red'>Field must not be empty</span>";
        } else {
            $query = "UPDATE `social_links` SET `facebook`='$facebook',`twitter`='$twitter',`linkedin`='$linkedin',`google+`='$googleplus' WHERE `id` = '1'";
            $update = $db->update($query);
            if ($update) {
                echo "<span style='color: green;>Data updated successfully.</span>";
            } else {
                echo "<span style='color: red'>Data updated not successfully.</span>";
            }
        }
}
?>
                <div class="block">
<?php
    $query  = "SELECT * FROM `social_links`";
    $result = $db->select($query);
    if ($result) {
        $row    = $result->fetch_assoc();


?>              
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Facebook</label>
                            </td>
                            <td>
                                <input type="text" value="<?= $row['facebook'] ?>" name="facebook"  class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Twitter</label>
                            </td>
                            <td>
                                <input type="text" name="twitter" value="<?= $row['twitter'] ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>LinkedIn</label>
                            </td>
                            <td>
                                <input type="text" name="linkedin" value="<?= $row['linkedin'] ?>"  class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>Google Plus</label>
                            </td>
                            <td>
                                <input type="text" name="googleplus" value="<?= $row['google+'] ?>"  class="medium" />
                            </td>
                        </tr>
<?php
    }

?>						
						 <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php
    include "inc/footer.php";
?>
