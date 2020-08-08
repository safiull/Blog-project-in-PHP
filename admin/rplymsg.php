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
        $to      = mysqli_real_escape_string($db->link, $_POST['to']);
        $from    = mysqli_real_escape_string($db->link, $_POST['from']);
        $subject = mysqli_real_escape_string($db->link, $_POST['subject']);
        $body    = mysqli_real_escape_string($db->link, $_POST['body']);

        $sendMail = mail($to, $subject, $body, $from);

        if ($sendMail) {
            echo "<span style='color: green'>Data deleted successfully.</span>";
        } else {
            echo "<span style='color: red'>Somthing went wrong.</span>";
        }
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
                                <label>To</label>
                            </td>
                            <td>
                                <input readonly="" name="to" type="text" value="<?= $row['email'] ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>From</label>
                            </td>
                            <td>
                                <input name="from" placeholder="Your email" type="text" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Subject</label>
                            </td>
                            <td>
                                <input name="subject" type="text" class="medium" />
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
