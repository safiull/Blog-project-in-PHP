<?php
    include "inc/header.php";
    include "inc/sidebar.php";
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Copyright Text</h2>
                <div class="block copyblock"> 
<?php
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $copyright   = $format->validation($_POST['copyright']);
        $copyright   = mysqli_real_escape_string($db->link, $copyright);

        if ($copyright == '') {
            echo "<span style='color: red'>Field must not be empty</span>";
        } else {
            $query = "UPDATE `copyright` SET `copyright`='$copyright' WHERE `id` = '1'";
            $update = $db->update($query);
            if ($update) {
                echo "<span style='color: green'>Data updated successfully.</span>";
            } else {
                echo "<span style='color: red'>Data updated not successfully.</span>";
            }
        }
}
?>

<?php
    $query  = "SELECT * FROM `copyright`";
    $result = $db->select($query);
    if ($result) {
        $row    = $result->fetch_assoc();


?>  
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?= $row['copyright']; ?>" name="copyright" class="large" />
                            </td>
                        </tr>
<?php } ?>						
						 <tr> 
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

