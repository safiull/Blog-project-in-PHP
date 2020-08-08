<?php
    include "inc/header.php";
    include "inc/sidebar.php";
?>

<?php
    if (!isset($_GET['msgid']) || $_GET['msgid'] == NULL) {
        header("location: inbox.php");
    } else {
        $msgid = $_GET['msgid'];
    }
?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>View Message</h2>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo "<script>window.location = 'inbox.php';</script>";
    }

?>
                <div class="block">               
                 <form action="" method="POST" enctype="multipart/form-data">
                    <table class="form">
                    <?php
                        $query = "SELECT * FROM `contact_form` WHERE `id`='$msgid'";

                        $result = $db->select($query);
                        if ($result) {
                            while ($row = $result->fetch_assoc()) {
                        
                    ?>                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input readonly="" type="text" value="<?= $row['fname']." ".$row['lname']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>E-mail</label>
                            </td>
                            <td>
                                <input readonly="" value="<?= $row['email']; ?>" type="text" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Date</label>
                            </td>
                            <td>
                                <input readonly="" value="<?= date("d/M/Y :- g:i a", strtotime($row['time'])); ?>" type="text" class="medium" />
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
                    <?php
                            }
                        }
                    ?>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Okk" />
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
