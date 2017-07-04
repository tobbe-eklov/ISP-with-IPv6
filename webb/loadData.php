<?php
	require_once "lang.php";

	$conn = new mysqli("localhost", "dbuser", "yourpassword", "yourdatabase") or die("cannot connect");
	$conn->query("SET NAMES utf8");

	$today = date("Y-m-d");
	isset($_GET['date']) ? $date = $_GET['date'] : $date = $today;

	$date = $conn->real_escape_string($date);

	$query = "SELECT aiDomain, aiDns6, aiErrdns6, aiMx6, aiErrmx6, aiWww6, aiErrwww6 FROM ispIpv6 ".
	"WHERE aiInsDate LIKE '$date%'";
	$ipResults = $conn->query($query);
	
	$query = "SELECT COUNT(aId) FROM isp";
	$countResult = $conn->query($query);
	
	$ispCount = mysqli_fetch_row($countResult)[0];
	
	$www = "";
	$mx = "";
	$dns = "";
	$allOk = "";
	
	$wwwCount = 0;
	$mxCount = 0;
	$dnsCount = 0;
	$okCount = 0;

	while($line = mysqli_fetch_array($ipResults, MYSQLI_ASSOC)) {
		$count = 0;
		if($line['aiDns6'] == 1) {
			$dnsCount++;
			if($line['aiErrdns6'] == 0) {
					$dns = $dns . '<div class="dom"><a href="http://www.'. $line['aiDomain'] .'">'. $line['aiDomain'] .'</a></div>';
					$count++;
				}
			else
				$dns = $dns . '<div class="errDom">'. $line['aiDomain'] .'</div>';
		}
		if($line['aiMx6'] == 1) {
			$mxCount++;
			if($line['aiErrmx6'] == 0) {
					$mx = $mx . '<div class="dom"><a href="http://www.'. $line['aiDomain'] .'">'. $line['aiDomain'] .'</a></div>';
					$count++;
				}
			else
				$mx = $mx . '<div class="errDom">'. $line['aiDomain'] .'</div>';
		}
		if($line['aiWww6'] == 1) {
			$wwwCount++;
			if($line['aiErrwww6'] == 0) {
					$www = $www . '<div class="dom"><a href="http://www.'. $line['aiDomain'] .'">'. $line['aiDomain'] .'</a></div>';
					$count++;
				}
			else
				$www = $www . '<div class="errDom">'. $line['aiDomain'] .'</div>';
		}
		if($count == 3) {
			$allOk = $allOk . '<div class="okDom"><a href="http://www.'. $line['aiDomain'] .'">'. $line['aiDomain'] .'</a></div>';
			$okCount++;
		}
	}

	$data = '<h2>'. getTranslatedItem("WORKING_AAAA") .'</h2>'.
	'<div class="subContainer">'.
	'	<b>'. $okCount . getTranslatedItem("OF") . $ispCount . getTranslatedItem("DOMAINS") .'<br></b>'.
	'	'. $allOk .
	'</div>'.	
	'<h2>'. getTranslatedItem("AUTHORITIES_WITH_WWW") .'</h2>'.
	'<div class="subContainer">'.
	'	<b>'. $wwwCount .' of '. $ispCount .getTranslatedItem("DOMAINS") .'<br></b>'.
	'	'. $www .
	'</div>'.
	'<h2>'. getTranslatedItem("AUTHORITIES_WITH_MX") .'</h2>'.
	'<div class="subContainer">'.
	'	<b>'. $mxCount .' of '. $ispCount .getTranslatedItem("DOMAINS") .'<br></b>'.
	'	'. $mx .
	'</div>'.
	'<h2>'. getTranslatedItem("AUTHORITIES_WITH_DNS") .'</h2>'.
	'<div class="subContainer">'.
	'	<b>'. $dnsCount .' of '. $ispCount .getTranslatedItem("DOMAINS") .'<br></b>'.
	'	'. $dns .
	'</div>';

	echo $data;
	$conn->close();
?>
