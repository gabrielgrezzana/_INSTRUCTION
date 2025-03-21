<?php
switch($view) {
	case 'home'				: $title = "{$config['website_title']}"; break;
	case 'server-info'		: $title = "Server Rate - {$config['website_title']}"; break;
	case 'rules'			: $title = "Rules - {$config['website_title']}"; break;
	case 'download'			: $title = "Download - {$config['website_title']}"; break;
	case 'combine'			: $title = "Combine Guide - {$config['website_title']}"; break;
	case 'quest'			: $title = "Daily Quest - {$config['website_title']}"; break;
	case 'referral'			: $title = "Referral Code - {$config['website_title']}"; break;
	case 'donation'			: $title = "Donation - {$config['website_title']}"; break;
	case 'worldboss'		: $title = "World Boss Status - {$config['website_title']}"; break;
	case 'patchlogs'		: $title = "Patch Logs - {$config['website_title']}"; break;
	case 'contact'			: $title = "Contact Us - {$config['website_title']}"; break;
	case 'rekber-groubfb'	: $title = "Rekber & Group FB - {$config['website_title']}"; break;
	case 'top-player'		: $title = "Top Rank - {$config['website_title']}"; break;
	default					: $title = "{$config['website_title']}"; break;
}