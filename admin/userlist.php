<?php
    include "inc/header.php";
    include "inc/sidebar.php";
?>

<style>
	p,address{
		padding: 0;
		margin: 0;
	}
</style>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>

<?php
    if (isset($_GET['deluser'])) {
    	$deluser = $_GET['deluser'];

    	
    	$query = "DELETE FROM `blog_user` WHERE `id` = '$deluser'";
	    $deletedata = $db->delete($query);
	    if ($deletedata) {
	        echo "<span style='color: green; font-weight: bold;'>Data deleted successfully.</span>";
	        echo '<script>window.location = "userlist.php"</script>';
	    } else {
	        echo "<span style='color: red'>Data is not inserted successfully</span>";
	    }
    }

    
?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Username</th>
							<th>Name</th>
							<th>E-mail</th>
							<th>Details</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$query = "SELECT * FROM `blog_user` ORDER BY id DESC";
						$result = $db->select($query);
						if ($result) {
							$i = 0;
							while ($row = $result->fetch_assoc()) {
							    $i++;
						
					?>
						<tr class="odd gradeX">
							<td><?= $i ?></td>
							<td><?= $row['username']; ?></td>
							<td><?= $row['name']; ?></td>
							<td><?= $row['email']; ?></td>
							<td><?= $format->textShorten($row['details'], 30); ?></td>
							<td><a href="editcat.php?catid=<?= $row['id']; ?>">View</a>
							<?php
								if ($_SESSION['userRole'] == '0') { ?>
									|| <a onclick="return confirm('Are you sure to delete this data?');" href="?deluser=<?= $row['id']; ?>">Delete</a></td>
							<?php
								}
							?>
						</tr>
					<?php
						}
					}
					?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<?php
    include "inc/footer.php";
?>

<script type="text/javascript">

    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
