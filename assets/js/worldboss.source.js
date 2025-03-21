$(function () {

	$('#worldboss-updatetime').html("No data available from server");

	// Override DisplayBoss stream server function
	function DisplayBoss() {

		const sid = (typeof wcx === 'undefined') ? parseInt($('[game-display="worldserver"]').attr('display-server')) : wcx;

		let data = {}

		$.ajax({
			url: `https://stream.rfocp.net/@/stream/boss`,
			dataType: 'JSON',
			async: false,
			success: function (response) {
				data = response.data[sid]
				time = response.time
			}
		});

		$('#loader-worldboss').addClass('d-none');

		const milliseconds$ = time * 1000 // 1575909015000
		const dateObject$ = new Date(milliseconds$)
		const humanDateFormat$ = dateObject$.toLocaleString() //2019-12-9 10:30:15

		var i = 0;
		var n = 0;

		for (const [key1, value1] of Object.entries(data)) {

			if ($(`#pitboss-status > #map-${key1}-tab`).length === 0) {
				$(`#pitboss-status`).append(`<a class="nav-link ${key1} map-title" id="map-${key1}-tab" data-toggle="pill" href="#map-${key1}" role="tab" aria-controls="map-${key1}" aria-selected="true">${value1.name}</a>`)
			}

			if ($(`#pitboss-statusContent > #map-${key1}`).length === 0) {
				$(`#pitboss-statusContent`).append(`<div class="tab-pane fade p-0" id="map-${key1}" role="tabpanel" aria-labelledby="map-${key1}-tab">${key1}</div>`)
			}

			i++;
			n++;

		}

		let showAllMap$ = '';

		for (const [key1, value1] of Object.entries(data)) {

			let worldBossDisplay$ = '';

			worldBossDisplay$ += `<div class='divider'><h4 class='divider-text text-center map-title ${key1}'><i>${value1.name}</i></h4></div>`;

			worldBossDisplay$ += `<div class='row mb-3'>`;

			for (const [key2, value2] of Object.entries(value1.data)) {

				live$ = (!value2.live) ? `<strong class="text-danger">Dead</strong>` : `<strong class="text-success">Alive</strong>`;
				border$ = (!value2.live) ? 'danger' : 'success';
				worldBossDisplay$ += `<div class="col-6" id="${key2}_${value2.code}"><div class="card border-${border$} m-1"><p class="m-0 text-center">${value2.name}</p><p class="m-0 text-center boss-status">${live$}</div></div>`;

			}

			worldBossDisplay$ += `</div>`;

			showAllMap$ += worldBossDisplay$;


			if ($(`#pitboss-statusContent > #map-${key1}`).length) {
				$(`#pitboss-statusContent > #map-${key1}`).html(worldBossDisplay$);
			}

		}


		$('#show-all-map').html(showAllMap$);

		// $('#worldboss-display').html(worldBossDisplay$);
		$('#worldboss-updatetime').html(humanDateFormat$);


	}

	// Override DisplayBoss stream server function

	DisplayBoss()
	setInterval(DisplayBoss, 10000);
});