<div class="col-9 row pr-0">
<div class="box-shadow style-right position-relative block-right-page content-block d-block c-block container p-3">
	<h5 class="heading">SERVER INFORMATION</h5>
	<div class="panel-group" id="accordion">
		<div id="nav-server-info-accordion">
		<?php
		$firstItem = true;
		
		try {
			$limit = 10; // Total collardion are displayed in 1 page.
			$adjacents = 2; // How may adjacent page links should be shown on each side of the current page link.
		
			//before: $total_results=mysql_num_rows($result);
			$execute = $db->query("SELECT COUNT(*) FROM blog_posts WHERE postCat='server-info' AND isDelete = 'false'");
			$total_results = $execute->fetchColumn();
			$pages = ceil($total_results / $limit);//total pages we going to have
		
			if(isset($_GET['page']) && $_GET['page'] != "") {
				$page = $_GET['page'];
				$offset = $limit * ($page-1);
				} else {
				$page = 1;
				$offset = 0;
				}
			$stmt = $db->query('SELECT * FROM blog_posts WHERE postCat="server-info" AND isDelete = "false" ORDER BY postOrder DESC limit ' .$offset. ', ' .$limit. '');
			if ($total_results == 0) {
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
					
					<div id="collardion<?php echo $row['postID']; ?>" aria-labelledby="collardion<?php echo $row['postID']; ?>" data-parent="#nav-server-info-accordion"  class="a-color panel-collapse collapse <?php echo ($firstItem ? 'show' : ''); ?>">
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

		<?php if($pages > 1) { ?>
			<ul class="pagination">
			<!-- Link of the first page -->
			<li class='page-item <?php ($page <= 1 ? print 'disabled' : '')?>'>
				<a title="<?= $config['website_title']; ?> &raquo; International Private Server" class='page-link' href='?page=1'>First</a>
			</li>
			<!-- Link of the previous page
			<li class='page-item <#?php ($page <= 1 ? print 'disabled' : '')?>'>
				<a class='page-link' href='?page=<#?php ($page>1 ? print($page-1) : print 1)?>'><</a>
			</li>-->
			<!-- Links of the pages with page number -->
			<?php for($i=$start; $i<=$end; $i++) { ?>
			<li class='page-item <?php ($i == $page ? print 'active' : '')?>'>
				<a title="<?= $config['website_title']; ?> &raquo; International Private Server" class='page-link' href='?page=<?php echo $i;?>'><?php echo $i;?></a>
			</li>
			<?php } ?>
			<!-- Link of the next page
			<li class='page-item <#?php ($page >= $total_pages ? print 'disabled' : '')?>'>
				<a class='page-link' href='?page=<#?php ($page < $total_pages ? print($page+1) : print $total_pages)?>'>></a>
			</li>-->
			<!-- Link of the last page -->
			<li class='page-item <?php ($page >= $pages ? print 'disabled' : '')?>'>
				<a title="<?= $config['website_title']; ?> &raquo; International Private Server" class='page-link' href='?page=<?php echo $pages;?>'>Last                     
				</a>
			</li>
			</ul>
		<?php }						
		?>
		</div>
	</div>
</div>
</div>