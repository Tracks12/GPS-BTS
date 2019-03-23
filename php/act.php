<?php
	/**
	 * Author     : CARDINAL Florian
	 * File       : act.php
	 * Last Modif : 11/03/2019
	 * Location   : /php/
	 */
	
	require("./bdd_access.php");
	
	function isInput($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	if($_SERVER["REQUEST_METHOD"] === "POST") {
		if(isset($_GET["login"])) {
			$post = array(
				"value" => isInput($_POST["username"]),
				"error" => NULL,
				"passed" => true
			);
			$password = md5(isInput($_POST["password"]));
			
			$req = $bdd->query("SELECT `user`, `pass`, `priv` FROM `usr`");
			while($data = $req->fetch(PDO::FETCH_NUM)) {
				if(empty($password) || $password !== $data[1]) { $post["error"] = "mot de passe erroné !"; $post["passed"] = false; }
	 			if(empty($post["value"]) || $post["value"] !== $data[0]) { $post["error"] = "utilisateur inconnu !"; $post["passed"] = false; }
	 			if($post["passed"]) {
					$_SESSION = array(
						"user" => $data[0],
						"host" => $_SERVER["REMOTE_ADDR"],
						"prot" => $_SERVER["REQUEST_SCHEME"],
						"port" => $_SERVER["SERVER_PORT"],
						"time" => date("d/m/Y h:i:s"),
						"priv" => $data[2]
					);
					
					$bdd->query("UPDATE `usr` SET `host`='{$_SERVER["REMOTE_ADDR"]}', `port`={$_SERVER["SERVER_PORT"]}, `time`='{$_SESSION["time"]}' WHERE `user`='{$post["value"]}'");
					break;
				}
			} echo(json_encode($post));
		}
	}
	else if(isset($_SESSION["user"])) {
		switch(isInput($_GET["link"])) {
			case "map": echo("<h2>affichage carte</h2>
					<iframe src=\"http://umap.openstreetmap.fr/fr/map/anonymous-edit/302704:mlSUlk4wjHznxzvYWFsvJuuaH10\"></iframe>");
				break;
			case "pos": echo("<h2>tableau position</h2>
					<table>");
				echo("<tr>
						<th>dernière position</th>
						<th>latitude</th>
						<th>longitude</th>
					</tr>");
				$req = $bdd->query("SELECT * FROM `position`");
				while($data = $req->fetch(PDO::FETCH_NUM)) {
					echo("<tr>
							<td>".date('d/m/Y h:i:s', $data[1])."</td>
							<td>{$data[2]}</td>
							<td>{$data[3]}</td>
						</tr>");
				} echo("</table>");
				break;
			default: $table = array(
					array("utilisateur", "connexion", "hôte", "port", "protocole", "privilège"),
					array($_SESSION["user"], $_SESSION["time"], $_SESSION["host"], $_SESSION["port"], $_SESSION["prot"], $_SESSION["priv"])
				);
				
				echo("<h2>bienvenue</h2>
					<table>");
				
				for($i = 0; $i < count($table[0]); $i++) {
					echo("<tr>
							<td><h3>{$table[0][$i]}</h3></td>
							<td>{$table[1][$i]}</td>
						</tr>");
				}
				
				echo("</table>
					<a href=\"./?logout\"><span class=\"fa fa-sign-out\"></span> déconnexion</a>");
				break;
		} echo("<script>popup.close();</script>");
	}
	else {
		echo("<h2>authentification requise</h2><br />
			<a id=\"login\" href=\"#login\"><span class=\"fa fa-sign-in\"></span> connexion</a>
			<script>popup.close();</script>");
	}
	
	/**
	 * END
	 */
?>
