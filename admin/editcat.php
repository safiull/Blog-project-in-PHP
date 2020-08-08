<?php
    include "inc/header.php";
    include "inc/sidebar.php";
?>
<?php
    if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
        header("location: catlist.php");
    } else {
        $id = $_GET['catid'];
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock">
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $update_name = $_POST['update_name'];
        $update_name = mysqli_real_escape_string($db->link, $update_name);

        if (empty($update_name)) {
            echo "<span style='color: red'>Field must not be empty</span>";
        } else {
            $query = "UPDATE `blog_category` SET `name`= '$update_name' WHERE `id` = '$id'";
            $result = $db->update($query);

            if ($result) {
                echo "<span style='color: green; font-weight: bold;'>Category updated successfully</span>";
            } else {
                echo "<span style='color: red'>Category is not inserted successfully</span>";
            }
        }

        
    }
?>  

                 <form action="" method="POST">
                    <table class="form">
                    <?php

                    $query = "SELECT * FROM `blog_category` WHERE `id` = '$id' ORDER BY id DESC";
                    $result = $db->select($query);	
                    $row = mysqli_fetch_assoc($result);
                    ?>


                        <tr>
                            <td>
                                <input type="text" value="<?= $row['name']; ?>" class="medium" name="update_name" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input class="btn" type="submit" name="update" value="Update Category">
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
