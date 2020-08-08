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
        $category = $_POST['category'];
        $category = mysqli_real_escape_string($db->link, $category);

        if (empty($category)) {
            echo "<span style='color: red'>Field must not be empty</span>";
        } else {
            $query = "INSERT INTO `blog_category`(`name`) VALUES ('$category')";
            $result = $db->insert($query);

            if ($result) {
                echo "<span style='color: green'>Category is inserted successfully</span>";
            } else {
                echo "<span style='color: red'>Category is not inserted successfully</span>";
            }
        }

        
    }
?>
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" placeholder="Enter Category Name..." class="medium" name="category" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
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
