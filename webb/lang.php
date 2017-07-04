<?php

	$langText = array(
		"MONTH_NAMES_LONG" => array("'Januari','Februari','Mars','April','Maj','Juni','Juli','Augusti','September','Oktober','November','December'","'January','February','March','April','May','June','July','August','September','October','November','December'"),
		"MONTH_NAMES_SHORT" => array("'Jan','Feb','Mar','Apr','Maj','Jun','Jul','Aug','Sep','Okt','Nov','Dec'", "'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'"),
		"DAY_NAMES_SHORT" => array("'S&ouml;', 'M&aring', 'Ti', 'On', 'To', 'Fr', 'L&ouml;'", "'Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'"),

		"TITLE" => array("ISP med IPv6", "ISP with IPv6"),
		"SITE_DESCRIPTION" => array("<b>ISPmedipv6.se</b> är en oberoende hemsida som försöker hitta ISP'er som är tillgängliga via <a href=http://en.wikipedia.org/wiki/IPv6><b>IPv6</b></a>.<br>Denna sida uppdateras en eller flera gånger per dag.<br>", "<b>ISPermedipv6.se</b> is an independent website that tries to find out ISP's who have enabled some service with <a href=http://en.wikipedia.org/wiki/IPv6><b>IPv6</b></a>.<br>This page will automatically update one or more times per day.<br>"),
		"DOMAINS_WITH_PROBLEMS" => array("Domäner markerade i rött har problem med IPv6.", "Domains marked with red have problems with IPv6."),
		"WORKING_AAAA" => array("ISPer med fungerade AAAA i web, dns och mail", "ISP with working AAAA in web, dns and mail"),
		"AUTHORITIES_WITH_WWW" => array("ISPer med AAAA i deras WWW och domännamn", "ISP with AAAA in its www and domain name"),
		"AUTHORITIES_WITH_MX" => array("ISPer med AAAA i deras MX", "ISP with AAAA in its MX record"),
		"AUTHORITIES_WITH_DNS" => array("ISPer med AAAA på någon av deras DNS-servrar", "ISP with AAAA on some of their DNS servers"),
		"DOMAINS" => array(" domäner", " domains"),
		"OF" => array(" av ", " of ")
	);


	function getTranslatedItem($strKey){
		global $langText;

		$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

		$arrIndex = 0;
		switch($lang){
			case 'sv' : $arrIndex=0; break;
			case 'en' : $arrIndex=1; break;
			default : $arrIndex=1; break;
		}


		if( isset($langText[$strKey]) ){
			if( isset($langText[$strKey][$arrIndex]) ){
				return $langText[$strKey][$arrIndex];
			}
		}

		return "[MISSING: " . $strKey .  ":" . $arrIndex . "]";
	}

?>
