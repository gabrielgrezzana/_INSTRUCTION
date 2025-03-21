let wcx = parseInt($('[game-display="worldserver"]').attr('display-server'));

$(function() {

	DisplaySS();
	TopKill();

});

function raceIcon (id) {
	if (id == 0 || id == 1) {
		return '<img class="icon-race bellato"></img>';
	} else if (id == 2 || id == 3) {
		return '<img class="icon-race cora"></img>';
	} else if (id == 4) {
		return '<img class="icon-race accretia"></img>';
	}
}

setInterval(DisplaySS, 10000);
setInterval(TopKill, 30000);

async function DisplaySS () {

	let data = {}

	$.ajax({
		url: `https://stream.rfocp.net/@/channel/${_sax}/world`,
			dataType: 'JSON',
			async: false,
			success: function (response) {
				data = response.data[wcx]
				time = response.time
			}
	});

	$('#loader-cw').addClass('d-none');
	$('#loader-on').addClass('d-none');
	
	$("[display-server='"+wcx+"'] #stream-gamestatistics-totaluser").html(data.totaluser);
	$("[display-server='"+wcx+"'] #stream-gamestatistics-totalchar").html(data.totalchar);
	$("[display-server='"+wcx+"'] #stream-gamestatistics-bellato").html(data.B_Num);
	$("[display-server='"+wcx+"'] #stream-gamestatistics-cora").html(data.C_Num);
	$("[display-server='"+wcx+"'] #stream-gamestatistics-accretia").html(data.A_Num);

	$("[display-server='"+wcx+"'] #totalon #totalon-text").html(data.UserNum);
	$("[display-server='"+wcx+"'] #totalon, [display-server='"+wcx+"'] #servercheck").removeClass('d-none');
	
	if (data.login) {
		$("[display-server='"+wcx+"'] #servercheck #logincheck > .server-conn-status").addClass('online').removeClass('offline');
	} else if (data.login == 'close') {
		$("[display-server='"+wcx+"'] #servercheck #logincheck > .server-conn-status").addClass('offline').removeClass('online');
	}
	if (data.world) {
		$("[display-server='"+wcx+"'] #servercheck #worldcheck > .server-conn-status").addClass('online').removeClass('offline');
	} else if (data.world == 'close') {
		$("[display-server='"+wcx+"'] #servercheck #worldcheck > .server-conn-status").addClass('offline').removeClass('online');
	}

	$("[display-server='"+wcx+"'] #cwstatus").removeClass('d-none');
	
	$("[display-server='"+wcx+"'] .progress-bar.totalon").css({"width": ""+data.UserNum/10+"%"});

	$("[display-server='"+wcx+"'] .progress-bar#chip-acc > .progress-bar-text").html(Math.floor(data.CWHP_A) + "%");
	$("[display-server='"+wcx+"'] .progress-bar#chip-acc").css({"width": ""+data.CWHP_A+"%"}).attr("aria-valuenow", data.CWHP_A);
	
	$("[display-server='"+wcx+"'] .progress-bar#chip-bcc > .progress-bar-text").html(Math.floor(data.CWHP_B) + "%");
	$("[display-server='"+wcx+"'] .progress-bar#chip-bcc").css({"width": ""+data.CWHP_B+"%"}).attr("aria-valuenow", data.CWHP_B);
	
	$("[display-server='"+wcx+"'] .progress-bar#chip-ccc > .progress-bar-text").html(Math.floor(data.CWHP_C) + "%");
	$("[display-server='"+wcx+"'] .progress-bar#chip-ccc").css({"width": ""+data.CWHP_C+"%"}).attr("aria-valuenow", data.CWHP_C);
	
	if (data.chipbreaker) {
		$("[display-server='"+wcx+"'] #cw-chipbreaker > span").html(data.chipbreaker);
	} else {
		$("[display-server='"+wcx+"'] #cw-chipbreaker > span").html("<i class='text-danger'>CB Failed</i>");
	}

	// User online
	if (data.UserNum > 350) {
		$("[display-server='"+wcx+"'] .progress-bar.totalon").addClass('bg-danger').removeClass('bg-success bg-warning'); $("[display-server='"+wcx+"'] .server-status").addClass('text-danger').html('OVER');
	} else if (data.UserNum > 150) {
		$("[display-server='"+wcx+"'] .progress-bar.totalon").addClass('bg-warning').removeClass('bg-success bg-danger'); $("[display-server='"+wcx+"'] .server-status").addClass('text-warning').html('BUSY');
	} else {
		$("[display-server='"+wcx+"'] .progress-bar.totalon").addClass('bg-success').removeClass('bg-warning bg-danger'); $("[display-server='"+wcx+"'] .server-status").addClass('text-success').html('GOOD');
	}

	if ((new Date().getTime() - (time * 1000)) > (3600 * 1000)) {
		$("[display-server='"+wcx+"'] #world-lastupdate").html('<small class="float-right text-white-50">last update: '+ new Date(time * 1000).toLocaleString() +'</small>');
	}
	
	// Accretia
	if (data.CWHP_A > 10 && data.CWHP_A < 30) {
		$("[display-server='"+wcx+"'] .progress-bar#chip-acc").addClass("bg-warning").removeClass('bg-success bg-danger');
	} else if (data.CWHP_A <= 10) {
		$("[display-server='"+wcx+"'] .progress-bar#chip-acc").addClass("bg-danger").removeClass('bg-success bg-warning');
	} else {
		$("[display-server='"+wcx+"'] .progress-bar#chip-acc").addClass("bg-success").removeClass('bg-warning bg-danger');
	}

	// Bellato
	if (data.CWHP_B > 10 && data.CWHP_B < 30) {
		$("[display-server='"+wcx+"'] .progress-bar#chip-bcc").addClass("bg-warning").removeClass('bg-success bg-danger')
	} else if (data.CWHP_B <= 10) {
		$("[display-server='"+wcx+"'] .progress-bar#chip-bcc").addClass("bg-danger").removeClass('bg-success bg-warning');
	} else {
		$("[display-server='"+wcx+"'] .progress-bar#chip-bcc").addClass("bg-success").removeClass('bg-warning bg-danger');
	}

	// Cora
	if (data.CWHP_C > 10 && data.CWHP_C < 30) {
		$("[display-server='"+wcx+"'] .progress-bar#chip-ccc").addClass("bg-warning").removeClass('bg-success bg-danger');
	} else if (data.CWHP_C <= 10) {
		$("[display-server='"+wcx+"'] .progress-bar#chip-ccc").addClass("bg-danger").removeClass('bg-success bg-warning');
	} else {
		$("[display-server='"+wcx+"'] .progress-bar#chip-ccc").addClass("bg-success").removeClass('bg-warning bg-danger');
	}
	
	if (data.winrace == 0) {
		$("[display-server='"+wcx+"'] #cw-race-status > #cw-race-win").html("Win: <span class='text-success'>Bellato</span>");
	} else if (data.winrace == 1) {
		$("[display-server='"+wcx+"'] #cw-race-status > #cw-race-win").html("Win: <span class='text-success'>Cora</span>");
	} else if (data.winrace == 2) {
		$("[display-server='"+wcx+"'] #cw-race-status > #cw-race-win").html("Win: <span class='text-success'>Accretia</span>");
	} else {
		$("[display-server='"+wcx+"'] #cw-race-status > #cw-race-win").html("Win: <span class='text-warning'>Failed</span>");
	}
	if (data.loserace == 0) {
		$("[display-server='"+wcx+"'] #cw-race-status > #cw-race-lose").html("Lose: <span class='text-danger'>Bellato</span>");
	} else if (data.loserace == 1) {
		$("[display-server='"+wcx+"'] #cw-race-status > #cw-race-lose").html("Lose: <span class='text-danger'>Cora</span>");
	} else if (data.loserace == 2) {
		$("[display-server='"+wcx+"'] #cw-race-status > #cw-race-lose").html("Lose: <span span class='text-danger'>Accretia</span>");
	} else {
		$("[display-server='"+wcx+"'] #cw-race-status > #cw-race-lose").html("Lose: <span class='text-warning'>Failed</span>");
	}
	
}

function DisplayTopKill (data) {
	
	$('#loader-tk').addClass('d-none');
	$('#widget-topkill').removeClass('d-none').addClass('fadeIn');

	let topkill = "";
	if (data.length > 0) {
		for (i = 0; i < data.length; ++i) {
			var irank = i + 1;
			topkill += 	"<tr>" +
								"<td class='text-center'>" + irank + "</td>" +
								"<td>" + raceIcon(data[i]["Race"]) + "<span class='ml-1'>" + data[i]["Name"] + "</span></td>" +
								"<td class='text-center'>" + data[i]["Kill"] + "</td>" +
								"<td class='text-center'>" + data[i]["Death"] + "</td>" +
						"</tr>";
		}
	} else {
		topkill += 	"<tr>" +
							"<td class='text-center' colspan='4'>Empty data</td>" +
					"</tr>";
	}
	$('table#widget-topkill tbody').html(topkill);
}

async function TopKill () {
	
	let data = {}

	$.ajax({
			url: `https://stream.rfocp.net/@/channel/${_sax}/topkill`,
			dataType: 'JSON',
			async: false,
			success: function (response) {
				data = response.data[wcx]
			}
	});

	DisplayTopKill(data);
}