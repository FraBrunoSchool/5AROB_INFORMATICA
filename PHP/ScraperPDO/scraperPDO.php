<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>PHP scraper - parte 2</title>
</head>

<body>
<?php
require_once './Pos/RemoteConnector.php';
require_once './Pos/LIB_parse.php';
try {
	$totali = 0;
	$servername = "localhost";
	$username = "root";
	$password = "";
	$con = new PDO("mysql:host=$servername;dbname=db_scraping", $username, $password);
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt1 = $con->prepare("SELECT * FROM inputurl WHERE protocollo = 'http';");
	$stmt1->execute();  //eseguo la query
	$num = $stmt1->rowCount();
	//var_dump($row); echo "Numero di URL: $num <hr>";
	if($num==0){
		die("La tabella degli URL su cui fare scraping è vuota !");
	}else{
		while($row = $stmt1->fetch(PDO::FETCH_ASSOC)){
			$output = new Pos_RemoteConnector($row['URL']);
			$idURL = $row['idURL'];
			$protocol = "http";
			if (strlen($output)) {
				$output = tidy_html($output);
				$body = remove($output, "<html>", "</head>");
				$body = str_replace('"', "'", $body); //trasformo tutte le virgolette in singole
				$links = parse_array($body, "<a HREF='", ">");
				//$links = parse_array($body, "<a HREF='", "'>");
				//$links = parse_array($body, "<a HREF='", " "); 
				$link = ""; $istruzione = ""; $salvati = 0;
				//var_dump($links);
				echo "<br>Numero link totali reperiti: " . count($links) . "<br>";
				for ($x = 0; $x < count($links); $x++){
					$link = (String) $links[$x];
					//echo "Link: '" . $links[$x] . "'<br>";
					//echo "Link: '" . $link . "'<br>";
					$link = str_replace("'", "", $link); //tolgo tutte le virgolette rimaste
					//echo "DEBUG $link senza virgolette.";
					$value = get_attribute($link, "HREF");
					if (substr($value, 0, 4) == "http") {
						//echo "DEBUG prima: $value <br>";
						$value = filter_var($value, FILTER_SANITIZE_STRING); 
						$value = trim($value);
						if (strlen($value) > 255) $value = substr($value, 0, 255);
						$value = utf8_encode($value);
						//echo "DEBUG dopo: $value <br>";
						//$istruzione = "INSERT INTO dati (URLestratto, idURLorigine, protocollo) VALUES ('" .$value . "', $, '" .  . "');";
						//echo "DEBUG SQL: $istruzione <br>";
						$istruzione = "INSERT INTO dati (URLestratto, idURLorigine, protocollo) VALUES ('$value', '$idURL', '$protocol')";
						// $con_url->prepare();
						$stmt2 = $con->prepare($istruzione);
						$stmt2->execute();
						$salvati++;
					}
				}
				echo "<br>Numero link totali salvati: $salvati<hr>";
				$totali += $salvati;
			}
		}
	}
	echo "<br>Totale link salvati su DB: $totali";
	//$stmt->closeCursor();
	$con = NULL; //chiudo connessione
} catch (Exception $e) {
	echo "Errore PDO durante esecuzione di: <br>$istruzione<hr>";
	echo $e->getMessage();
	die();
}
?>
</body>