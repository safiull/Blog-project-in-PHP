<?php
    include "inc/header.php";
    include "inc/sidebar.php";
?>



        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>

<?php
    if (isset($_GET['delcat'])) {
    	$id = $_GET['delcat'];

    	
    	$query = "DELETE FROM `blog_category` WHERE `id` = '$id'";
	    $deletedata = $db->delete($query);
	    if ($deletedata) {
	        echo "<span style='color: green; font-weight: bold;'>Data deleted successfully.</span>";
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
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$query = "SELECT * FROM `blog_category` ORDER BY id DESC";
						$result = $db->select($query);
						if ($result) {
							$i = 0;
							while ($row = $result->fetch_assoc()) {
							    $i++;
						
					?>
						<tr class="odd gradeX">
							<td><?= $i ?></td>
							<td><?= $row['name']; ?></td>
							<td><a href="editcat.php?catid=<?= $row['id']; ?>">Edit</a>
							<?php
								if ($_SESSION['userRole'] == '0') { ?>
									|| <a onclick="return confirm('Are you sure to delete this data?');" href="?delcat=<?= $row['id']; ?>">Delete</a>
							<?php		
								}
							?>
							
							</td>
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
