<?php
    include "inc/header.php";
    include "inc/sidebar.php";

    $role = $_SESSION['userRole'];
    if (!$role == '0') {
        echo "<script>window.location = 'index.php'</script>";
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock">
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $format->validation($_POST['username']);
        $password = $format->validation(md5($_POST['password']));
        $email    = $format->validation($_POST['email']);
        $role     = $format->validation($_POST['role']);

        $username = mysqli_real_escape_string($db->link, $username);
        $password = mysqli_real_escape_string($db->link, $password);
        $email    = mysqli_real_escape_string($db->link, $email);
        $role     = mysqli_real_escape_string($db->link, $role);

        if (empty($username) || empty($password) || empty($role) || empty($email)) {
            echo "<span style='color: red'>Field must not be empty.</span>";
        } else {
            $query  = "SELECT * FROM `blog_user` WHERE `email` = '$email' LIMIT 1";
            $result = $db->select($query); 
            if ($result != false) {
                echo "<span style='color: red'>This email already exists</span>";
            } else {
                $query = "INSERT INTO `blog_user`(`username`, `password`, `email`, `role`) VALUES ('$username', '$password', '$email', '$role')";
                $result = $db->insert($query);

                if ($result) {
                    echo "<span style='color: green'>User created successfully.</span>";
                } else {
                    echo "<span style='color: red'>User not created</span>";
                }
            }
        }
    }
?>
                 <form action="" method="POST">
                    <table class="form">                    
                        <tr>
                            <td>Username</td>
                            <td>
                                <input type="text" placeholder="Enter Category Name..." class="medium" name="username" />
                            </td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td>
                                <input type="text" placeholder="Enter Category Name..." class="medium" name="password" />
                            </td>
                        </tr>
                        <tr>
                            <td>E-mail</td>
                            <td>
                                <input type="text" placeholder="Enter Category Name..." class="medium" name="email" />
                            </td>
                        </tr>
                        <tr>
                            <td>Role</td>
                            <td>
                                <select name="role">
                                    <option>Select User Role</option>
                                    <option value="0">Admin</option>
                                    <option value="1">Author</option>
                                    <option value="2">Editor</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Create" />
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
