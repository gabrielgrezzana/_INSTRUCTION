$(function () {

	DisplayLeaderboardInit();

});

setInterval(DisplayLeaderboardInit, 30000);


async function DisplayLeaderboardInit() {


	const sid = (typeof wcx === 'undefined') ? parseInt($('[game-display="worldserver"]').attr('display-server')) : wcx;

	let data = {}

	$.ajax({
		url: `https://stream.rfocp.net/@/stream/leaderboard`,
		dataType: 'JSON',
		async: false,
		success: function (response) {
			data = response.data[sid]
		}
	});

	DisplayLeaderboard(data[0], 'top-cpt');
	DisplayLeaderboard(data[1], 'top-pvp');
	DisplayLeaderboard(data[2], 'top-money');
	DisplayLeaderboard(data[3], 'top-gold');
	DisplayLeaderboard(data[4], 'top-goldpoints');
	DisplayLeaderboard(data[5], 'top-guild');
}

function DisplayLeaderboard(data, id) {

	if (id === 'top-cpt') {
		let top_cpt = "";
		if (data.length > 0) {
			for (i = 0; i < data.length; ++i) {
				var irank = i + 1;
				top_cpt += "<tr class='fadeIn'>" +
					"<td class='text-center'>" + irank + "</td>" +
					"<td>" + data[i]["Name"] + "</td>" +
					"<td class='text-center'>" + raceIcon(data[i]["Race"]) + "</td>" +
					"<td>" + classIcon(data[i]["Class"]) + " " + className(data[i]["Class"]) + "</td>" +
					"<td class='text-center'>" + data[i]["CharLevel"] + "</td>" +
					"<td class='text-center'>" + Math.round(data[i]["PvpPoint"]).toLocaleString('en-US') + "</td>" +
					"<td>" + ((data[i]["GuildName"] && typeof data[i]["GuildName"] === 'string') ? data[i]["GuildName"] : '*') + "</td>" +
					"</tr>";
			}
		} else {
			top_cpt += "<tr class='fadeIn'>" +
				"<td class='text-center' colspan='7'>Empty data</td>" +
				"</tr>";
		}
		$('#top-cpt > #cpt-result tbody').html(top_cpt);

	} else if (id === 'top-pvp') {
		let top_pvp = "";
		if (data.length > 0) {
			for (i = 0; i < data.length; ++i) {
				var irank = i + 1;
				top_pvp += "<tr class='fadeIn'>" +
					"<td class='text-center'>" + irank + "</td>" +
					"<td>" + data[i]["Name"] + "</td>" +
					"<td class='text-center'>" + raceIcon(data[i]["Race"]) + "</td>" +
					"<td>" + classIcon(data[i]["Class"]) + " " + className(data[i]["Class"]) + "</td>" +
					"<td class='text-center'>" + data[i]["CharLevel"] + "</td>" +
					"<td class='text-center'>" + Math.round(data[i]["PvpCash"]).toLocaleString('en-US') + "</td>" +
					"<td>" + ((data[i]["GuildName"] && typeof data[i]["GuildName"] === 'string') ? data[i]["GuildName"] : '*') + "</td>" +
					"</tr>";
			}
		} else {
			top_pvp += "<tr class='fadeIn'>" +
				"<td class='text-center' colspan='7'>Empty data</td>" +
				"</tr>";
		}
		$('#top-pvp > #pvp-result tbody').html(top_pvp);

	} else if (id === 'top-money') {
		let top_money = "";
		if (data.length > 0) {
			for (i = 0; i < data.length; ++i) {
				var irank = i + 1;
				top_money += "<tr class='fadeIn'>" +
					"<td class='text-center'>" + irank + "</td>" +
					"<td>" + data[i]["Name"] + "</td>" +
					"<td class='text-center'>" + raceIcon(data[i]["Race"]) + "</td>" +
					"<td>" + classIcon(data[i]["Class"]) + " " + className(data[i]["Class"]) + "</td>" +
					"<td class='text-center'>" + data[i]["CharLevel"] + "</td>" +
					"<td class='text-center'>" + Math.round(data[i]["Dalant"]).toLocaleString('en-US') + "</td>" +
					"<td>" + ((data[i]["GuildName"] && typeof data[i]["GuildName"] === 'string') ? data[i]["GuildName"] : '*') + "</td>" +
					"</tr>";
			}
		} else {
			top_money += "<tr class='fadeIn'>" +
				"<td class='text-center' colspan='7'>Empty data</td>" +
				"</tr>";
		}
		$('#top-money > #money-result tbody').html(top_money);

	} else if (id === 'top-gold') {
		let top_gold = "";
		if (data.length > 0) {
			for (i = 0; i < data.length; ++i) {
				var irank = i + 1;
				top_gold += "<tr class='fadeIn'>" +
					"<td class='text-center'>" + irank + "</td>" +
					"<td>" + data[i]["Name"] + "</td>" +
					"<td class='text-center'>" + raceIcon(data[i]["Race"]) + "</td>" +
					"<td>" + classIcon(data[i]["Class"]) + " " + className(data[i]["Class"]) + "</td>" +
					"<td class='text-center'>" + data[i]["CharLevel"] + "</td>" +
					"<td class='text-center'>" + Math.round(data[i]["Gold"]).toLocaleString('en-US') + "</td>" +
					"<td>" + ((data[i]["GuildName"] && typeof data[i]["GuildName"] === 'string') ? data[i]["GuildName"] : '*') + "</td>" +
					"</tr>";
			}
		} else {
			top_gold += "<tr class='fadeIn'>" +
				"<td class='text-center' colspan='7'>Empty data</td>" +
				"</tr>";
		}
		$('#top-gold > #gold-result tbody').html(top_gold);

	} else if (id === 'top-goldpoints') {
		let top_goldpoints = "";
		if (data.length > 0) {
			for (i = 0; i < data.length; ++i) {
				var irank = i + 1;
				top_goldpoints += "<tr class='fadeIn'>" +
					"<td class='text-center'>" + irank + "</td>" +
					"<td>" + data[i]["Name"] + "</td>" +
					"<td class='text-center'>" + raceIcon(data[i]["Race"]) + "</td>" +
					"<td>" + classIcon(data[i]["Class"]) + " " + className(data[i]["Class"]) + "</td>" +
					"<td class='text-center'>" + data[i]["CharLevel"] + "</td>" +
					"<td class='text-center'>" + Math.round(data[i]["ActionPoint_2"]).toLocaleString('en-US') + "</td>" +
					"<td>" + ((data[i]["GuildName"] && typeof data[i]["GuildName"] === 'string') ? data[i]["GuildName"] : '*') + "</td>" +
					"</tr>";
			}
		} else {
			top_goldpoints += "<tr class='fadeIn'>" +
				"<td class='text-center' colspan='7'>Empty data</td>" +
				"</tr>";
		}
		$('#top-goldpoint > #goldpoint-result tbody').html(top_goldpoints);

	} else if (id === 'top-guild') {
		let top_guild = "";
		if (data.length > 0) {
			for (i = 0; i < data.length; ++i) {
				var irank = i + 1;
				top_guild += "<tr class='fadeIn'>" +
					"<td class='text-center'>" + irank + "</td>" +
					"<td>" + data[i]["GuildName"] + "</td>" +
					"<td class='text-center'>" + data[i]["Grade"] + "</td>" +
					"<td class='text-center'>" + raceIcon(data[i]["Race"]) + "</td>" +
					"<td>" + data[i]["Name"] + "</td>" +
					"<td class='text-center'>" + data[i]["MemberCount"] + "</td>" +
					"<td class='text-center'>" + data[i]["CreateDate"] + "</td>" +
					"</tr>";
			}
		} else {
			top_guild += "<tr class='fadeIn'>" +
				"<td class='text-center' colspan='7'>Empty data</td>" +
				"</tr>";
		}
		$('#top-guild > #guild-result tbody').html(top_guild);

	}

}

function raceIcon(id) {
	if (id === 0 || id === 1) {
		return '<img class="icon-race bellato"></img>';
	} else if (id === 2 || id === 3) {
		return '<img class="icon-race cora"></img>';
	} else if (id === 4) {
		return '<img class="icon-race accretia"></img>';
	}
}

function classIcon(id) {
	return `<img class='mr-1 icon-class ${id}'>`;
}

function className(id) {
	var classArray = {
		BWB0: "Warrior",
		BRB0: "Ranger",
		BFB0: "Spiritualist",
		BSB0: "Specialist",
		BWS1: "Berseker",
		BWF1: "Commando",
		BWF2: "Miller",
		BRF1: "Desperado",
		BRF2: "Sniper",
		BFF1: "Cypher",
		BFF2: "Chandra",
		BSF1: "Driver",
		BSF2: "Craftman",
		BWS2: "Armsman",
		BWS3: "Shield Miller",
		BRS1: "Hidden Soldier",
		BRS2: "Sentinel",
		BRS3: "Infiltrator",
		BFS1: "Wizard",
		BFS2: "Astraler",
		BFS3: "Holy Chandra",
		BSS1: "Mental Smith",
		BSS2: "Armor Rider",
		CWB0: "Warrior",
		CRB0: "Ranger",
		CFB0: "Spiritualist",
		CSB0: "Specialist",
		CWF1: "Champion",
		CWF2: "Knight",
		CRF1: "Archer",
		CRF2: "Hunter",
		CFF1: "Caster",
		CFF2: "Summoner",
		CSF1: "Craftman",
		CWS1: "Templar",
		CWS2: "Guardian",
		CWS3: "Black Knight",
		CRS1: "Adventurer",
		CRS2: "Stealer",
		CRS3: "Assassin",
		CFS1: "Warlock",
		CFS2: "Dark Priest",
		CFS3: "Grazier",
		CSS1: "Artist",
		AWB0: "Warrior",
		ARB0: "Ranger",
		ASB0: "Specialist",
		AWF1: "Destroyer",
		AWF2: "Gladius",
		ARF1: "Gunner",
		ARF2: "Scouter",
		ASF1: "Engineer",
		AWS1: "Punisher",
		AWS2: "Assaulter",
		AWS3: "Mercenary",
		ARS1: "Striker",
		ARS2: "Dementer",
		ARS3: "Phantom Shadow",
		ASS1: "Scientist",
		ASS2: "Battle Leader",
		BWT1: "Arthurian",
		BWT2: "Arslan",
		BWT3: "Stromsade",
		BRT1: "Mountjoy",
		BRT2: "Levant",
		BRT3: "Vows",
		BFT1: "Aeon",
		BFT2: "Accolade",
		BFT3: "Saint",
		BST1: "Baroque",
		BST2: "Pioneer",
		CWT1: "Hero",
		CWT2: "Scutum",
		CWT3: "Warden",
		CRT1: "Apache",
		CRT2: "Marksman",
		CRT3: "Baronet",
		CFT1: "Witch",
		CFT2: "Aviz",
		CFT3: "Shaman",
		AWT1: "Predator",
		AWT2: "Slaughter",
		AWT3: "Alcantra",
		ART1: "Devastron",
		ART2: "Destier",
		ART3: "Saboteur",
		AST1: "Inventer",
		AST2: "Commander"
	}

	return classArray[id];
}