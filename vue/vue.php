<?php

require_once PATH_MODELE."/Villes.php";
 
 class Vue
 {	private $villes;

 	function __construct(){
 		$villes = $_SESSION["villes"];
 	}
 	
 	function jeu()
 	{	

 		
 		?>
 		<html>
 		<head>
 			<meta charset="UTF-8">
 			<meta content="html/text">
 			<link rel="stylesheet" type="text/css" href="source/page.css" media="all"/>
 		</head>
 		<body>
 		
 			<div class="grid">
 				<?php

 				for ($x=0; $x < 7; $x++) { 
 					for ($y=0; $y < 7; $y++) { 
 						?>
 						<div><?php 
 						if ($villes.existe($x,$y)) {
 							echo "ville";
 						} else {echo " ";}?></div>
 						<?php
 					}
 				}
 				?>
 			</div>

 		</body>
 		</html>
 		<?php
 	}
 }