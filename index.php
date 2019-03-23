<!DOCTYPE html>
<!--
	Author     : CARDINAL Florian
	File       : index.php
	Last Modif : 11/03/2019
	Location   : /
-->
<?php
	require("./php/bdd_access.php");
	
	if(isset($_GET["logout"])) {
		unset($_SESSION["user"]);
		session_destroy();
		header("location: ./");
	}
?>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="description" content="GPS by BTS SN (EC) - 2019 [ANDRIEU Laurent, BEDOS Sebastien, CARDINAL Florian]">
		<title>GPS 2019 | BTS SN EC</title>
		<link rel="icon" type="image/png" href="./img/icon.png" />
		<link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css" />
		<link rel="stylesheet" type="text/css" href="./css/style.css" />
		<script language="JavaScript" type="text/javascript" src="./js/jquery.min.js"></script>
		<script language="JavaScript" type="text/javascript" src="./js/loader.min.js"></script>
		<script language="JavaScript" type="text/javascript" src="./js/particles.min.js"></script>
		<script language="JavaScript" type="text/javascript" src="./js/app.js"></script>
		<script language="JavaScript" type="text/javascript" src="./js/script.js"></script>
	</head>
	<body>
		<div id="particlesJs"></div>
		<div id="popup"></div>
		<?php
			require("./assets/nav.php");
			require("./assets/header.html");
			require("./assets/section.html");
			require("./assets/footer.html");
		?>
	</body>
</html>
<!-- END -->
