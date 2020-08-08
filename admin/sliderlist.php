<?php
    include "inc/header.php";
    include "inc/sidebar.php";
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>
                <div class="block">  
                    <table border="1" class="data display datatable" id="example">
					<thead>
						<tr>
							<th>No.</th>
							<th>Slider Title</th>
							<th>Slider Image</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$query = "SELECT * FROM `slider`";

						$result = $db->select($query);
						$i = 0;
						if ($result) {
							while ($row = $result->fetch_assoc()) {
								$i++;
						
					?>
						<tr class="odd gradeX">
							<td><?= $i ?></td>
							<td><?= $row['title']; ?></td>
							<td><img src="<?= $row['slider']; ?>" alt="post image" height="40px" width="60px" /></td>
							<td>
							<?php
								if ($_SESSION['userRole'] == '0') { ?>
									 
									<a href="editslider.php?sliderid=<?= $row['id']; ?>">Edit</a> 
									|| <a onclick="return confirm('Are you sure to delete this data?');" href="deleteslider.php?sliderid=<?= $row['id']; ?>">Delete</a>
							<?php		
								}

							?>
							</td>
						</tr>

					<?php } } ?>

					</tbody>
				</table>
	
               </div>
            </div>
        </div>
        
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php
    include "inc/footer.php";
?>

