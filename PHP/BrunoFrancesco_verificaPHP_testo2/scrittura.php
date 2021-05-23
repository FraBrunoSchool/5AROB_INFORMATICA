<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Scrittura file PHP</title>
</head>

<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
try {
	//connessione al DB con PDO
	$con = new PDO("mysql:host=$servername;dbname=agenzia", $username, $password);
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	//apro il file in scrittura
	try {
		$myfile = fopen("output.csv", "w") or die("Unable to open file!");  		
		echo "File creato.<br>";
	} catch (Exception $e) {
		echo $e->getMessage();
	}

	//prendo il numero di righe
	$stmt2 = $con->prepare("SELECT COUNT(*) AS rowcount FROM abbinamenti");
	$stmt2->execute();
	$num = $stmt2->fetch(PDO::FETCH_ASSOC);	//alternativa FETCH_NUM e poi isare $num[0]
	
	echo "Numero di righe:" . $num['rowcount'] . "<br>";

	$stmt1 = $con->prepare('SELECT abbinamenti.id, utenti1.id AS idFemmina, utenti1.nome AS nomeFemmina, utenti2.id AS idMaschi, utenti2.nome AS nomeMaschio, abbinamenti.giudizio1 AS giudizioDiFemminaSuCoppia, abbinamenti.giudizio2 AS giudizioDiMaschioSuCoppia, abbinamenti.scartato FROM abbinamenti, utenti AS utenti1, utenti AS utenti2 WHERE  (abbinamenti.idUtente1 = utenti1.id) AND (abbinamenti.idUtente2 = utenti2.id)');
    $stmt1->execute();  //eseguo la query
	
	while($row = $stmt1->fetch(PDO::FETCH_ASSOC)){  //ciclo per ogni riga
		$nome1 = trim($row['nomeFemmina']);
		$nome2 = trim($row['nomeMaschio']);
		$giudizio1 = trim($row['giudizioDiFemminaSuCoppia']);
		$giudizio2 = trim($row['giudizioDiMaschioSuCoppia']);
		$scartato = trim($row['scartato']);
		fwrite($myfile, $nome1 . ", " . $nome2 . "," . $giudizio1 . "," . $giudizio2 . "," . $scartato . "\n");  //scrivo linea sul file
	}

	fclose($myfile);	//chiudo file
	$con = NULL; //chiudo connessione
	echo "<br>Connessioni terminate.<br>";

} catch (PDOException $e){
	die("Errore nella connessione PDO: " . $e->getMessage());
} catch (Exception $e){
	die("Errore: " . $e->getMessage());
}

?>
</body>