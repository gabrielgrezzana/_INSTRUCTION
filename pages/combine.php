<div class="col-9 row pr-0">
<div class="box-shadow style-right position-relative block-right-page content-block d-block c-block container p-3">
	<h5 class="heading">COMBINE</h5>
	<div class="panel-group" id="accordion">
		<div id="nav-collardion-accordion">
		<?php
		$firstItem = true;
		
		try {
			$stmt = $db->query('SELECT * FROM blog_posts WHERE postCat="combine" AND isDelete = "false" ORDER BY postOrder DESC');
			if ($stmt->rowCount() == 0) {
				?>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseDefault">
								<h5 class="h2-accordion">No Data</h5>
							</a>
						</h4>
					</div>
					
					<div id="collapseDefault" class="a-color panel-collapse collapse <?php echo ($firstItem ? 'in show' : ''); ?>">
						<div class="panel-body">
						No Data
						</div>
					</div>
				</div>
				<div style="padding-bottom: 10px;"></div>
				<?php
			}
			else {
				while($row = $stmt->fetch()){
				?>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a class="accordion-toggle <?php echo (!$firstItem ? 'collapsed' : ''); ?>" data-toggle="collapse" data-target="#collardion<?php echo $row['postID']; ?>" href="#collardion<?php echo $row['postID']; ?>" aria-expanded="<?php echo ($firstItem ? 'true' : 'false');?>">
								<h2 class="h2-accordion"><?php echo $row['postTitle']; ?></h2>
							</a>
						</h4>
					</div>
					
					<div id="collardion<?php echo $row['postID']; ?>" aria-labelledby="collardion<?php echo $row['postID']; ?>" data-parent="#nav-collardion-accordion"  class="a-color panel-collapse collapse <?php echo ($firstItem ? 'show' : ''); ?>">
						<div class="panel-body">
						<h3 class="h3-accordion"><?php echo $row['postCont']; ?></h3>
						</div>
					</div>
				</div>
				<div style="padding-bottom: 10px;"></div>
				<?php
					$firstItem = false;
				}
			}
					
		} catch(PDOException $e) {
				echo $e->getMessage();
		}
		?>
		</div>
	</div>
</div>
</div>