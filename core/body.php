
<body>
	<!-- <div class="stars"></div> -->
	<?php include_once 'menu.php'; ?>

	<!--<div class="container">-->
	<!--	<div class="center-countdown"><h2 class="center-countdown-2">OBT Countdown</h2></div>-->
	<!--	<div id="countdown" class='countdown'></div>-->
	<!--</div>-->
	<div class="container">
	
		<div class="clear-top"></div>

		<!-- news data -->

		<div class="row">
			<div class="col-3 position-relative" game-display="worldserver" display-server="0">
				<div class="box-shadow style-left d-block">
					<div class="sidebar-block">
						<div class="register-block"><a title="<?= $config['website_title']; ?> &rarr; Register" href="<?= $config['gamecp_link']; ?>"><span>Register Account</span>Play FREE!</a></div>
						<div class="p-block">
							<h5 class="heading">SERVER STATUS</h5>
							<div class="loader center custom" id="loader-on">
								<div class="loader-inner line-scale">
									<div></div>
									<div></div>
									<div></div>
									<div></div>
									<div></div>
								</div>
							</div>
							<div id="servercheck" class='d-none'>
								<span>
									<span class="fadeIn" id="logincheck"><span class="server-conn-status offline"></span> LOGIN</span>
								</span>
								<span class="float-right">
									<span class="fadeIn" id="worldcheck"><span class="server-conn-status offline"></span> WORLD</span>
								</span>
							</div>
							<div id='totalon' class="d-none">
								<p class="mt-2 mb-0">TOTAL ONLINE:<span class="float-right" id="totalon-text">0</span></p>
							</div>
							<div id='world-lastupdate' class='mb-2'></div>
						</div>
					</div>
					<div class="sidebar-block-light p-block">
						<h5 class="heading">CHIP WAR STATUS</h5>
						<div class="loader center custom" id="loader-cw">
							<div class="loader-inner line-scale">
								<div></div>
								<div></div>
								<div></div>
								<div></div>
								<div></div>
							</div>
						</div>
						<div id='cwstatus' class="d-none">
							<div class='fadeIn'>
								<table class='table w-100 table-borderless'>
									<tr>
										<td width='30'><img src='./assets/img/race/acc.png' class='img-unset'></td>
										<td class='cw-progress-bar'>
											<div class='progress rounded-0 m-0'>
												<div class='progress-bar progress-bar-striped progress-bar-animated bg-success' role='progressbar' id="chip-acc" aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width: 0%'>
													<div class='progress-bar-text'>0%</div>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td width='30'><img src='./assets/img/race/bcc.png' class='img-unset'></td>
										<td class='cw-progress-bar'>
											<div class='progress rounded-0 m-0'>
												<div class='progress-bar progress-bar-striped progress-bar-animated bg-success' role='progressbar' id="chip-bcc" aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width: 0%'>
													<div class='progress-bar-text'>0%</div>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td width='30'><img src='./assets/img/race/ccc.png' class='img-unset'></td>
										<td class='cw-progress-bar'>
											<div class='progress rounded-0 m-0'>
												<div class='progress-bar progress-bar-striped progress-bar-animated bg-success' role='progressbar' id="chip-ccc" aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width: 0%'>
													<div class='progress-bar-text'>0%</div>
												</div>
											</div>
										</td>
									</tr>
								</table>
								<p class='m-0' id="cw-race-status"><span id="cw-race-win">Win: </span><span class='float-right' id="cw-race-lose">Loser: </span></p>
								<p class='m-0' id="cw-chipbreaker">Chip-Breaker: <span class='float-right'></span></p>
							</div>
						</div>
					</div>
					<div class="sidebar-block p-block">
						<h5 class="heading">CHIP WAR TIME</h5>
						<p class="m-0 px-2">1st CW	<span class="float-right" id="1st_cw"></span></p>
						<p class="m-0 px-2">2nd CW	<span class="float-right" id="2nd_cw"></span></p>
						<p class="m-0 px-2">3rd CW	<span class="float-right" id="3rd_cw"></span></p>
					</div>
					<div class="sidebar-block-light p-block d-none">
						<div class="top-kill-img text-center mb-2 mx-auto"><div class="text-bg">LATEST KILL</div></div>
						<div class="loader center custom" id="loader-lk">
							<div class="loader-inner line-scale">
								<div></div>
								<div></div>
								<div></div>
								<div></div>
								<div></div>
							</div>
						</div>
						<div id="latestkill">
							<table class="table d-none w-100" id="widget-latestkill">
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
					<div class="sidebar-block p-block">
						<div class="title text-bg">TOP KILL</div>
						<div class="top-kill-img mt-2 text-center mb-2 mx-auto"></div>
						<div class="loader center custom" id="loader-tk">
							<div class="loader-inner line-scale">
								<div></div>
								<div></div>
								<div></div>
								<div></div>
								<div></div>
							</div>
						</div>
						<div id="topkill">
							<table class="d-none w-100" id="widget-topkill">
								<thead>
									<tr>
										<th class="cell-center">#</th>
										<th>Nickname</th>
										<th class="cell-center">Kill</th>
										<th class="cell-center">Death</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>