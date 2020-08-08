<?php
    include "inc/header.php";
    include "inc/sidebar.php";
?>

<?php
    if (isset($_GET['seenid'])) {
        $seenid = $_GET['seenid'];

        // update status
		$query = "UPDATE `contact_form` SET `status`= '1' WHERE `id`= '$seenid'";
		$result = $db->update($query);
		if ($result) {
			echo "<script>window.location = 'inbox.php';</script>";
		}
		// update status end.
    }
?>

<?php
    if (isset($_GET['delid'])) {
        $delid = $_GET['delid'];

        // delete seen message status
		$query = "DELETE FROM `contact_form` WHERE `id` = '$delid'";
		$result = $db->update($query);
		// delete seen message end.
		if ($result) {
			echo "<script>window.location = 'inbox.php';</script>";
            echo "<span style='color: green'>Data deleted successfully.</span>";
        } else {
            echo "<span style='color: red'>Somthing went wrong.</span>";
        }
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<td>01</td>
							<td>Name</td>
							<td>E-mail</td>
							<td>Message</td>
							<td>Date</td>
							<td>Action</td>
						</tr>
					</thead>
					<tbody>
					<?php
						$query = "SELECT * FROM `contact_form` WHERE `status`= '0' ORDER BY `id` DESC";

						$result = $db->select($query);
						$i = 0;
						if ($result) {
							while ($row = $result->fetch_assoc()) {
								$i++;
						
					?>
						<tr class="odd gradeX">
							<td><?= $i; ?></td>
							<td><?= $row['fname'].' '.$row['lname']; ?></td>
							<td><?= $row['email']; ?></td>
							<td><?= $format->textShorten($row['body'], 50); ?></td>
							<td><?= date("d/M/Y :- g:i a", strtotime($row['time'])); ?></td>
							<td><a href="viewmsg.php?msgid=<?= $row['id']; ?>">View</a> || <a href="rplymsg.php?msgid=<?= $row['id']; ?>">Reply</a> || <a onclick="return confirm('Message seen successfully !')" href="?seenid=<?= $row['id']; ?>">Seen</a></td>
						</tr>
					<?php
							}
						}
					?>						
					</tbody>
				</table>
               </div>
            </div>

            <div class="box round first grid">
                <h2>Seen Box</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<td>01</td>
							<td>Name</td>
							<td>E-mail</td>
							<td>Message</td>
							<td>Date</td>
							<td>Action</td>
						</tr>
					</thead>
					<tbody>
					<?php
						$query = "SELECT * FROM `contact_form` WHERE `status`= '1' ORDER BY `id` DESC";

						$result = $db->select($query);
						$i = 0;
						if ($result) {
							while ($row = $result->fetch_assoc()) {
								$i++;
						
					?>
						<tr class="odd gradeX">
							<td><?= $i; ?></td>
							<td><?= $row['fname'].' '.$row['lname']; ?></td>
							<td><?= $row['email']; ?></td>
							<td><?= $format->textShorten($row['body'], 50); ?></td>
							<td><?= date("d/M/Y :- g:i a", strtotime($row['time'])); ?></td>
							<td><a onclick="return confirm('Are you sure to delete this data')" href="?delid=<?= $row['id']; ?>">Delete</a></td>
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
