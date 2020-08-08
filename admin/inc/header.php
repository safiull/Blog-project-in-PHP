<?php
    include '../lib/Session.php';
    Session::checkSession();

?>


<?php
    include '../config/config.php';
    include '../lib/Database.php';
    include '../helpers/format.php';
?>
<?php
    $db     = new Database();
    $format = new Format();
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title> Admin</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
    <link href="css/table/demo_page.css" rel="stylesheet" type="text/css" />
    <!-- BEGIN: load jquery -->
    <script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.sortable.min.js" type="text/javascript"></script>
    <script src="js/table/jquery.dataTables.min.js" type="text/javascript"></script>
    <!-- END: load jquery -->
    <script type="text/javascript" src="js/table/table.js"></script>
    <script src="js/setup.js" type="text/javascript"></script>
	 <script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
		    setSidebarHeight();
        });
    </script>

</head>
<body>
    <div class="container_12">
        <div class="grid_12 header-repeat">
            <div id="branding">
                <div class="floatleft logo">
                    <img src="img/livelogo.png" alt="Logo" />
				</div>
                <div class="floatleft middle">
                    <h1>HONEST IT</h1>
                    <p>www.honest-it.com</p>
                </div>
                <?php
                    if (isset($_GET['action']) AND $_GET['action'] ==  'logout'){
                        Session::destroy();
                    }
                ?>
                <div class="floatright">
                    <div class="floatleft">
                        <img src="img/img-profile.jpg" alt="Profile Pic" /></div>
                    <div class="floatleft marginleft10">
                        <ul class="inline-ul floatleft">
                            <li>Hello Admin</li>
                        <?php

                        ?>
                            <li><a href="?action=logout">Logout</a></li>
                        </ul>
                    </div>
                </div>
                <div class="clear">
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
                <div class="grid_12">
            <ul class="nav main">
                <li class="ic-dashboard"><a href="index.php"><span>Dashboard</span></a> </li>
                <li class="ic-dashboard"><a href="theme.php"><span>Themes</span></a> </li>
                <li class="ic-form-style"><a href="profile.php"><span>User Profile</span></a></li>
                <li class="ic-typography"><a href="changepassword.php"><span>Change Password</span></a></li>
                <li class="ic-grid-tables"><a href="inbox.php"><span>Inbox
                <?php
                    $query = "SELECT * FROM `contact_form` WHERE `status`= '0' ORDER BY `id` DESC";
                    $new_msg = $db->select($query);
                    if ($new_msg) {
                        $countmsg = mysqli_num_rows($new_msg);
                        echo "<sup style='color:white; border-radius:30px; background:red;'>($countmsg)<sup>";
                    } else {
                        echo "<sup style='color:white; border-radius:30px; background:green;'>(0)<sup>";
                    }
                    
                ?>
                </span></a></li>
            <?php 
                
                if ($_SESSION['userRole'] == '0') { ?>
                    <li class="ic-charts"><a href="adduser.php"><span>Add User</span></a></li>
            <?php
                }
            ?>
                
                <li class="ic-charts"><a href="userlist.php"><span>User List</span></a></li>
            </ul>
        </div>