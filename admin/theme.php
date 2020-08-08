<?php
    include "inc/header.php";
    include "inc/sidebar.php";
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock">
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $theme = mysqli_real_escape_string($db->link, $_POST['theme']);

            $query = "UPDATE `themes` SET `theme`= '$theme' WHERE `id` = '1'";
            $result = $db->update($query);

            if ($result) {
                echo "<span style='color: green; font-weight: bold;'>Category updated successfully</span>";
            } else {
                echo "<span style='color: red'>Category is not inserted successfully</span>";
            }


        
    }
?>  

                 <form action="" method="POST">
                    <table class="form">
                    <?php

                    $query = "SELECT * FROM `themes` WHERE `id` = '1'";
                    $result = $db->select($query);	
                    while ($row = mysqli_fetch_assoc($result)) {
                        
                    
                    ?>


                        <tr>
                            <td>
                                <input <?php if ($row['theme'] == 'default') { echo "checked"; } ?> type="radio" name="theme" value="default"> Default <br>
                                <input <?php if ($row['theme'] == 'green') { echo "checked"; } ?> type="radio" name="theme" value="green"> Green <br>
                                <input <?php if ($row['theme'] == 'red') { echo "checked"; } ?> type="radio" name="theme" value="red"> Red
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input class="btn" type="submit" name="update" value="Change Theme">
                            </td>
                        </tr>

                    <?php } ?>

                    </table>
                </form>
                </div>
            </div>
        </div>
<?php
    include "inc/footer.php";
?>
