
</div>
		<div class="sidebar clear">
			<div class="samesidebar clear">
				<h2>Categories</h2>
					<ul>
					<?php
						$query = "SELECT * FROM `blog_category`";
						$ca1tegory  = $db->select($query);
						if ($ca1tegory) {
							while ($row = $ca1tegory->fetch_assoc()) {
						
					?>
						<li><a href="posts.php?category=<?= $row['id']; ?>"><?= $row['name']; ?></a></li>

					<?php
						}
					} else {
					?>
						<li>No category found</li>
					<?php
					}
					?>				
					</ul>
			</div>
			
			<div class="samesidebar clear">
				<h2>Latest articles</h2>
				<?php
					$query = "SELECT * FROM `blog_post` LIMIT 5";
					$post  = $db->select($query);
					if ($post) {
						while ($row = $post->fetch_assoc()) {
				?>
					<div class="popular clear">
						<h3><a href="post.php?id=<?= $row['id'] ?>"><?= $row['title'] ?></h3>
						<a href="post.php?id=<?= $row['id'] ?>"><img src="admin/<?= $row['image']; ?>" alt="post image"/></a>
						<?= $format->textShorten($row['body'], 100); ?>	
					</div>
				<?php
					}
				} else{
						header("location: 404.php");
				}
				?>
			</div>
