<!-- 2nd Column -->
<div class="col-9 box-shadow style-right">
		<!-- MU Core Slider -->
		<div class="slider">
			<div class="next"> </div>
			<div class="prev"> </div>
			<div class="slides">
				<div class="slide active">
					<img src="<?php echo $config['slider_img_1']; ?>" alt="<?= $config['website_title']; ?> &raquo; International Private Server">
					<div class="slider-text" style="background: rgba(0,0,0,0.5);">
						<h2 class="h2-slider"><?php echo $config['slider_header_1']; ?></h2>
						<h3 class="h3-slider"><?php echo $config['slider_desc_1']; ?></h3>
					</div>
				</div>
				<div class="slide">
					<img src="<?php echo $config['slider_img_2']; ?>" alt="<?= $config['website_title']; ?> &raquo; International Private Server">
					<div class="slider-text" style="background: rgba(0,0,0,0.5);">
						<h2 class="h2-slider"><?php echo $config['slider_header_2']; ?></h2>
						<h3 class="h3-slider"><?php echo $config['slider_desc_2']; ?></h3>
					</div>
				</div>
				<div class="slide">
					<img src="<?php echo $config['slider_img_3']; ?>" alt="<?= $config['website_title']; ?> &raquo; International Private Server">
					<div class="slider-text" style="background: rgba(0,0,0,0.5);">
						<h2 class="h2-slider"><?php echo $config['slider_header_3']; ?></h2>
						<h3 class="h3-slider"><?php echo $config['slider_desc_3']; ?></h3>
					</div>
				</div>
			</div>
			<div class="navigation">
			<div class="dot active"></div><div class="dot"></div><div class="dot"></div></div>
		</div>
</div>

<div class="col-9 box-shadow clear-top">		
		
		<div class="clear-top">
		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist">
		<?php
		try {
			$executeNe = $db->query("SELECT COUNT(*) FROM blog_posts WHERE postCat='news' AND isDelete = 'false'");
			$executeN = $db->query("SELECT COUNT(*) FROM blog_posts WHERE postCat='notice' AND isDelete = 'false'");
			$total_Ne = $executeNe->fetchColumn(); $total_N = $executeN->fetchColumn();
			$executeNe->closeCursor(); $executeN->closeCursor();
		} catch(PDOException $e) { echo $e->getMessage(); }		
		?>
			<li role="presentation"><a title="<? if ($total_Ne > 0) { echo $total_Ne.' '; } ?><?= $config['website_title']; ?> News" href="./" role="tab">NEWS <? if ($total_Ne > 0) { echo '<span class="notification">'.$total_Ne .'</span>'; } ?></a></li>
			<li role="presentation" class="active"><a title="<?= $config['website_title']; ?> Events" href="./events" role="tab">EVENTS</a></li>
		</ul>
		
		<!-- Tab panes -->
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active">
				<!-- Accordion News -->
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				<?php
				$firstItem = true;

				try {
					$limit = 10; // Total news are displayed in 1 page.
					$adjacents = 2; // How may adjacent page links should be shown on each side of the current page link.
				 
					//before: $total_results=mysql_num_rows($result);
					$execute = $db->query("SELECT COUNT(*) FROM blog_posts WHERE postCat='events' AND isDelete = 'false'");
					$total_results = $execute->fetchColumn();
					$pages = ceil($total_results / $limit);//total pages we going to have
				 
					if(isset($_GET['page']) && $_GET['page'] != "") {
						$page = $_GET['page'];
						$offset = $limit * ($page-1);
						} else {
						$page = 1;
						$offset = 0;
						}
					$stmt = $db->query('SELECT * FROM blog_posts WHERE postCat="events" AND isDelete = "false" ORDER BY postOrder DESC limit ' .$offset. ', ' .$limit. '');
					if ($total_results == 0) {
						?>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseEvents">
							<h5 class="h2-accordion">No Data</h5>
									</a>
								</h4>
							</div>
							<div id="collapseEvents" class="a-color panel-collapse collapse <?php echo ($firstItem ? 'in show' : ''); ?>">
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
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $row['postID']; ?>">
									<h2 class="h2-accordion"><?php echo $row['postTitle']; ?></h2><span class="float-right"><small><?php echo date("jS M Y",strtotime($row['postDate'])); ?></small></span>
									</a>
								</h4>
							</div>
							
							<div id="collapse<?php echo $row['postID']; ?>" class="a-color panel-collapse collapse <?php echo ($firstItem ? 'in show' : ''); ?>">
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

				//Here we generates the range of the page numbers which will display.
				if($pages <= (1+($adjacents * 2))) {
					$start = 1;
					$end   = $pages;
				} else {
					if(($page - $adjacents) > 1) { 
						if(($page + $adjacents) < $pages) { 
							$start = ($page - $adjacents);				
							$end   = ($page + $adjacents);		   
							} else {				 
								$start = ($pages - (1+($adjacents*2)));  
								$end   = $pages;				   
							}
					} else {				   
					$start = 1;										  
					$end   = (1+($adjacents * 2));				 
					}
				}		
				?>
				</div>

				<?php if($pages > 1) { ?>
				<center>
					<ul class="pagination">
					   <!-- Link of the first page -->
					   <li class='page-item <?php ($page <= 1 ? print 'disabled' : '')?>'>
						 <a title="First Page" class='page-link' href='/events'>First</a>
					   </li>
					   <!-- Link of the previous page
					   <li class='page-item <#?php ($page <= 1 ? print 'disabled' : '')?>'>
						 <a class='page-link' href='?page=<#?php ($page>1 ? print($page-1) : print 1)?>'><</a>
					   </li>-->
					   <!-- Links of the pages with page number -->
					   <?php for($i=$start; $i<=$end; $i++) { ?>
					   <li class='page-item <?php ($i == $page ? print 'active' : '')?>'>
						 <a title="Page <?php echo $i;?>" class='page-link' href='/events/<?php echo $i;?>'><?php echo $i;?></a>
					   </li>
					   <?php } ?>
					   <!-- Link of the next page
					   <li class='page-item <#?php ($page >= $total_pages ? print 'disabled' : '')?>'>
						 <a class='page-link' href='?page=<#?php ($page < $total_pages ? print($page+1) : print $total_pages)?>'>></a>
					   </li>-->
					   <!-- Link of the last page -->
					   <li class='page-item <?php ($page >= $pages ? print 'disabled' : '')?>'>
						 <a title="Last Page" class='page-link' href='/events/<?php echo $pages;?>'>Last                     
						 </a>
					   </li>
					</ul>
				</center>
				<?php } else { ?>
				<center>
					<ul class="pagination">
					   <!-- Link of the first page -->
					   <li class='page-item disabled'>
						 <a title="First Page" class='page-link'>First</a>
					   </li>
					   <li class='page-item active'>
						 <a title="Page 1" class='page-link' href='events'>1</a>
					   </li>
					   <li class='page-item disabled'>
						 <a title="Last Page" class='page-link'>Last                     
						 </a>
					   </li>
					</ul>
				</center>
				<?php }						
				?>
				<!-- End of accordion news -->
			</div>
		</div>

	</div>
	</div>