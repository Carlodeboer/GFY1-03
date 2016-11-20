<?php
// gelieve hier alle functies te plaatsen ;)

// werkt nog niet, is alleen een begin
function create($pdo, $naam, $weeknr){
	$stmt = $pdo->prepare("INSERT INTO klantenbestand VALUES (?,?)");
	$stmt->execute(array($naam, $weeknr));
}
function read($pdo){
	$stmt = $pdo->prepare("SELECT * FROM klantenbestand");
	$stmt->execute();
	while ($row = $stmt->fetch()){
		$voornaam = $row["voornaam"];
		print "<p>".$voornaam."</p><br>";
	}
}
// werkt nog niet, is alleen een begin
function update($pdo, $veld, $waarde, $nieuweWaarde){
	$stmt = $pdo->prepare("UPDATE klantenbestand WHERE ? = ? SET ? = ?");
	$stmt->execute(array($veld, $waarde, $veld, $nieuweWaarde));
}
// werkt nog niet, is alleen een begin
function delete($pdo, $naam, $weeknr){
	$stmt = $pdo->prepare("DELETE FROM klantenbestand VALUES naam = ? AND weeknr = ?");
	$stmt->execute(array($naam, $weeknr));
}
?>
