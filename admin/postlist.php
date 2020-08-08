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
							<th width="3%">No.</th>
							<th width="10%">Post Title</th>
							<th width="19%">Description</th>
							<th width="10%">Category</th>
							<th width="10%">Image</th>
							<th width="10%">Author</th>
							<th width="10%">Tags</th>
							<th width="10%">Date</th>
							<th width="19%">Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$query = "SELECT `blog_post`.*, `blog_category`.name 
							FROM `blog_post`
							INNER JOIN `blog_category`
							ON `blog_post`.`category` = `blog_category`.`id` ORDER BY `blog_post`.`title` DESC";

						$result = $db->select($query);
						$i = 0;
						if ($result) {
							while ($row = $result->fetch_assoc()) {
								$i++;
						
					?>
						<tr class="odd gradeX">
							<td><?= $i ?></td>
							<td><?= $row['title']; ?></td>
							<td><?= $format->textShorten($row['body'], 50); ?></td>
							<td><?= $row['name']; ?></td>
							<td><img src="<?= $row['image']; ?>" alt="post image" height="40px" width="60px" /></td>
							<td><?= $row['author']; ?></td>
							<td><?= $row['tags']; ?></td>
							<td><?= date("d/M/Y :- g:i a", strtotime($row['datetime'])); ?></td>
							<td>
								<a href="editpost.php?postid=<?= $row['id']; ?>">View</a>
							<?php
								if ($row['userId'] == Session::get("userId") || $_SESSION['userRole'] == '0') { ?>
									 
									|| <a href="editpost.php?postid=<?= $row['id']; ?>">Edit</a> 
									|| <a onclick="return confirm('Are you sure to delete this data?');" href="deletepost.php?postid=<?= $row['id']; ?>">Delete</a>
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

