<?php  

// DB Info
require_once '/kunden/klaeranlagen-vergleich.de/solaranlagen-portal.de/php_inc/db_config.php';

$systeme = array(
				0=>"DWA-Zertifiziert",
				1=>"RWN",
				2=>"Antragsstellung",
				3=>"Planung",
				4=>"Wartung ",
				5=>"Montage",
				6=>"Priv. Sachverst.",
				7=>"Dichtheitspr",
				);


// Get parameters from URL
$center_lat = $_GET["lat"];
$center_lng = $_GET["lng"];
$radius = $_GET["radius"];
$map_cat = $_GET["cat"];
// $leistung_kat = array(0=>"Planung",1=>"Antragstellung",2=>"Montage",3=>"Wartung",4=>"privater Sachverständiger",5=>"Dichtheitsprüfung");
$sort = $_GET["sort"];


// mode 1 = nach Distanz, 2 Nach Datum
if ($sort == 1) {$sort = "distance";} else {$sort = "RAND()";}

// Start XML file, create parent node
$dom = new DOMDocument("1.0","utf-8");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

// Opens a connection to a mySQL server
$connection=mysql_connect ($db14['ip'] , $db14['user'], $db14['pass']);
if (!$connection) {
  die("Not connected : " . mysql_error());
}
mysql_set_charset('utf8',$connection);
// Set the active mySQL database
$db_selected = mysql_select_db($db14['database'], $connection);
if (!$db_selected) {
  die ("Can\'t use db : " . mysql_error());
}
if ($map_cat == 0) { $where = " "; } else {$where = "WHERE a.filter_systemart LIKE '%" . $map_cat . "%' "; }

// Search the rows in the markers table
$squery = "SELECT DISTINCT  a.AdresseID AS id, a.id AS kundennummer, a.firma, a.tel, a.fax, a.email, a.mobil, a.homepage, a.strasse, a.breite, a.laenge,  a.nr,  a.plz, a.ort, ROUND(( 6371 * acos( cos( radians('%s') ) * cos( radians( a.breite ) ) * cos( radians( a.laenge ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( a.breite ) ) ) ) , 1) 	AS distance 
	FROM firmenvz_kv AS a WHERE 
	HAVING distance < '%s' 
	ORDER BY $sort 
	LIMIT 0 , 30";
$query = sprintf($squery,
	mysql_real_escape_string($center_lat),
	mysql_real_escape_string($center_lng),
	mysql_real_escape_string($center_lat),
	mysql_real_escape_string($radius)
	);
	
$query = str_replace("WHERE",$where,$query);

$result = mysql_query($query);
if (!$result) {
  die("Invalid query: " . mysql_error());
}


// Opens a connection to a mySQL server
$connection=mysql_connect ($db36['ip'] , $db36['user'], $db36['pass']);
if (!$connection) {
  die("Not connected : " . mysql_error());
}
mysql_set_charset('utf8',$connection);
// Set the active mySQL database
$db_selected = mysql_select_db($db36['database'], $connection);
if (!$db_selected) {
  die ("Can\'t use db : " . mysql_error());
}

//header("Content-type: text/xml");
// Iterate through the rows, adding XML nodes for each
// !!! AUF UTF8-CODIERUNG ACHTEN ... sonst wird die xml nicht ausgegeben!
while ($row = @mysql_fetch_assoc($result)){
//	$userid = $row['id'];
	$alias = mysql_query("SELECT oldurl 
	FROM jos_5__sh404sef_urls WHERE newurl LIKE '%Itemid=86&id=" . $row['kundennummer'] ."%'");
	$row['alias'] = mysql_fetch_row($alias);
 	$json[] = $row;
}
echo json_encode( $json );
//var_dump($json);
?>