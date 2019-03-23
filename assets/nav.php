<nav>
	<ul>
		<?php
			if(isset($_SESSION["user"])) {
				echo("<li class=\"item\">
						<a class=\"btn\" id=\"home\" href=\"#home\"><span class=\"fa fa-home\"></span>accueil</a>
					</li>
					<li class=\"item\">
						<a class=\"btn\"><span class=\"fa fa-map\"></span>map</a>
						<ul>
							<li><a id=\"map\" href=\"#map\">visualisation</a></li>
							<li><a id=\"pos\" href=\"#pos\">position</a></li>
						</ul>
					</li>");
			}
		?>
		<li class="item">
			<?php
				if(isset($_SESSION["user"])) {
					echo("<a class=\"btn\"><span class=\"fa fa-user\"></span>profile</a>
						<ul>
							<li><a href=\"?logout\">déconnexion</a></li>
						</ul>");
				}
			?>
		</li>
	</ul>
</nav>
