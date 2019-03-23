<?php
	/**
	 * Author   : BEDOS Sebastien
	 * File     : callback.php
	 * Date     : 18/03/2019
	 * Location : /php/
	 */
	
	require("./bdd_access.php");
	parse_str($_SERVER["QUERY_STRING"]);
	date_default_timezone_set("Europe/Paris");
	
	$handle = fopen("../donnee.csv", "a+");
	
	if(isset($id) && isset($data)) {
		$data = array(
			"time" => time(),
			"lat" => 10*$data[2]+$data[3]+.1*$data[4]+.01*$data[5]+.001*$data[6]+.0001*$data[7],
			"long" => 100*$data[8]+10*$data[9]+$data[10]+.1*$data[11]+.01*$data[12]+.001*$data[13]+.0001*$data[14],
			"latOrient" => $data[count($data)-2],
			"longOrient" => $data[count($data)-1]
		);
		
		if($data["latOrient"] === 2) { $data["lat"] *= -1; }
		if($data["longOrient"] === 2) { $data["long"] *= -1; }
		
		fputcsv($handle, array($data["time"], $data["lat"], $data["long"]));
		$bdd->query("INSERT INTO `position`(`datehe`, `latitude`, `longitude`, `latOrient`, `longOrient`) VALUES ({$data["time"]}, {$data["lat"]}, {$data["long"]}, {$data["latOrient"]}, {$data["longOrient"]})");
	}
	else { fputcsv($handle, array("ERR", "ERR", "ERR")); }
	
	fclose($handle);
	echo("$id<br />
		{$data["time"]}<br />
		{$data["lat"]}<br />
		{$data["long"]}");
	
	/**
	 * END
	 */
?>
