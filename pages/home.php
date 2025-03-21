<!-- 2nd Column -->
<div class="col-9 d-block pr-0 row">
	<div class="box-shadow style-right position-relative position-relative">
		<!-- MU Core Slider -->
		<div class="slider">
			<div class="next"> </div>
			<div class="prev"> </div>
			<div class="slides">
				<div class="slide active">
					<img src="<?php echo $config['slider_img_1']; ?>" alt="<?= $config['website_title']; ?> &raquo; International Private Server">
				</div>
				<div class="slide">
					<img src="<?php echo $config['slider_img_2']; ?>" alt="<?= $config['website_title']; ?> &raquo; International Private Server">
				</div>
				<div class="slide">
					<img src="<?php echo $config['slider_img_3']; ?>" alt="<?= $config['website_title']; ?> &raquo; International Private Server">
				</div>
			</div>
			<div class="navigation">
			<div class="dot active"></div><div class="dot"></div><div class="dot"></div></div>
		</div>
	</div>

	<div class="col-12 mt-3 p-3 box-shadow block-left-page">

		<nav>
			<div class="nav nav-tabs" id="nav-tab" role="tablist">
				<a class="nav-link rounded-0 active" id="nav-news-tab" data-toggle="tab" href="#nav-news" role="tab" aria-controls="nav-news" aria-selected="true">NEWS</a>
				<a class="nav-link rounded-0 " id="nav-event-tab" data-toggle="tab" href="#nav-event" role="tab" aria-controls="nav-event" aria-selected="false">EVENTS</a>
			</div>
		</nav>
		<div class="tab-content" id="nav-tabContent">
			<div class="tab-pane fade show active" id="nav-news" role="tabpanel" aria-labelledby="nav-news-tab">
				<div class="panel-group accordion" id="accordion" role="tablist" aria-multiselectable="true">
					<div id="nav-news-accordion">
						<?php
						$firstItem = true;

						try {
							$stmt = $db->query('SELECT * FROM blog_posts WHERE  (postCat="events" OR postCat="news") AND isDelete = "false" ORDER BY postID DESC');
							if ($stmt->rowCount() == 0) {
								?>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a class="accordion-toggle" data-toggle="collapse" data-target="#collapseNews" aria-expanded="true" aria-controls="collapseNews">
												<h5 class="h2-accordion">No Data</h5>
											</a>
										</h4>
									</div>
									<div id="collapseNews" class="a-color panel-collapse collapse <?php echo ($firstItem ? 'show' : ''); ?>">
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
											<a class="accordion-toggle <?php echo (!$firstItem ? 'collapsed' : ''); ?>" data-toggle="collapse" data-target="#News<?php echo $row['postID']; ?>" href="#News<?php echo $row['postID']; ?>" aria-expanded="<?php echo ($firstItem ? 'true' : 'false');?>">
												<h2 class="h2-accordion"><?php echo $row['postTitle']; ?><span class="float-right mr-2"><small><?php echo date("jS M Y",strtotime($row['postDate'])); ?></small></span></h2>
											</a>
										</h4>
									</div>
									
									<div id="News<?php echo $row['postID']; ?>" aria-labelledby="News<?php echo $row['postID']; ?>" data-parent="#nav-news-accordion"  class="a-color panel-collapse collapse <?php echo ($firstItem ? 'show' : ''); ?>">
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
			<div class="tab-pane fade" id="nav-event" role="tabpanel" aria-labelledby="nav-event-tab">
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					<div id="nav-event-accordion">
					<?php
					$firstItem = true;

					try {
						$stmt = $db->query('SELECT * FROM blog_posts WHERE postCat="events" AND isDelete = "false" ORDER BY postID DESC');
						if ($stmt->rowCount() == 0) {
							?>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a class="accordion-toggle" data-toggle="collapse" data-target="#collapseEvent" aria-expanded="true" aria-controls="collapseEvent">
											<h5 class="h2-accordion">No Data</h5>
										</a>
									</h4>
								</div>
								<div id="collapseEvent" data-parent="#nav-event-accordion" class="a-color panel-collapse collapse <?php echo ($firstItem ? 'show' : ''); ?>">
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
										<a class="accordion-toggle <?php echo (!$firstItem ? 'collapsed' : ''); ?>" data-toggle="collapse" data-target="#Event<?php echo $row['postID']; ?>" aria-expanded="true" aria-controls="Event<?php echo $row['postID']; ?>">
										<h2 class="h2-accordion"><?php echo $row['postTitle']; ?><span class="float-right"><small><?php echo date("jS M Y",strtotime($row['postDate'])); ?></small></span></h2>
										</a>
									</h4>
								</div>
								
								<div id="Event<?php echo $row['postID']; ?>" aria-labelledby="Event<?php echo $row['postID']; ?>" data-parent="#nav-event-accordion"  class="a-color panel-collapse collapse <?php echo ($firstItem ? 'show' : ''); ?>">
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
					}?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>