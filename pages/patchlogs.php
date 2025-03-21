<div class="col-9 row pr-0">
	<div class="box-shadow style-right position-relative block-right-page content-block d-block c-block container p-3">
		<h5 class="heading">PATCH LOGS</h5>
		<div class="main">
			<?php
				$firstItem = true;
				
				try {
					$stmt = $db->query("SELECT * FROM blog_patchlogs WHERE isDelete = '0' ORDER BY patchDate DESC");
					$total_results = $stmt->rowCount();
					if ($total_results < 1) {
						echo "No patch logs available.";
					} else {
						echo "<ul class='extl_tmtimeline'>";
						while($row = $stmt->fetch()){
							$label = ($firstItem) ? 'label-star' : 'label-history';
							$patchDate = date('j, F Y', strtotime($row['patchDate']));
							echo "<li class='position-relative'>
										<time class='extl_tmtime' datetime='{$row['patchDate']}'><span>{$patchDate}</span></time>
										<span class='extl_tmicon {$label}'></span>
										<div class='extl_tmlabel'>
											{$row['patchText']}
										</div>
									</li>";
							$firstItem = false;
						}
						echo "</ul>";
					}
							
				} catch(PDOException $e) {
						echo $e->getMessage();
				}
				?>
		</div>
	</div>
</div>