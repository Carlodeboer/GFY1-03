<?php
// gelieve hier alle functies te plaatsen ;)
function toon($pdo){
	$stmt = $pdo->prepare("SELECT * FROM klantenbestand");
	$stmt->execute();
	while ($row = $stmt->fetch()){
		$voornaam = $row["voornaam"];
		print "<p>".$voornaam."</p><br>";
	}
}
?>
