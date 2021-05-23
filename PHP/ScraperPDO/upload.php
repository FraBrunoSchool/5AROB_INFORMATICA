<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>PHP scraper - parte 1</title>
</head>

<body>
	<h1>Esito upload</h1>
    <?php
		//print_r($_FILES); //$_FILE contiene i file ricevuti e tutte le loro informazioni
		if ($_FILES["txtFile"]["error"] == UPLOAD_ERR_OK) {
			$fileRicevuto=$_FILES["txtFile"];
            //$fileRicevuto["name"] restituisce il path completo del file ricevuto
            //basename restituisce il vero nome contenuto dopo l'ultimo slash
            //$target_file rappresenta il percorso dove salvare il file sul server
            $target_file = "Uploads/" . basename($fileRicevuto["name"]);
            $size=$fileRicevuto["size"];
            $mimeType=$fileRicevuto["type"];
            echo("Nome file: $target_file<br>");
            echo("Dimensione: $size<br>");
            echo("MIME type: $mimeType<br><br>");
            if(file_exists($target_file))
                echo("Attenzione il file esiste già.<br>");
            else
            {
                $servername = "localhost";
	            $username = "root";
	            $password = "";
				try{
					$con = new PDO("mysql:host=$servername;dbname=db_scraping", $username, $password);
					$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);				
					$command = $con->prepare("INSERT INTO inputurl (protocollo, URL) VALUES (:prot, :line)");
					$urls = file( $_FILES["txtFile"]["tmp_name"], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
					//var_dump($urls);
					foreach ($urls as $linea) {
						//$protocollo = split(trim($linea), ":")[0];   
						$protocollo = "http";
						echo "$protocollo <br>"; 
						$command->bindParam(":prot", $protocollo, PDO::PARAM_STR);
						$command->bindParam(":line", $linea, PDO::PARAM_STR);
						$command->execute();
						/*
						if ($command->execute())
							echo " Il url $linea &egrave; stato aggiunto al database.<br>";
						else
							echo " Errore: il url $linea NON &egrave; stato aggiunto al database.<br>";
						*/
					}
					echo("I dati contenuti nel file sono stati caricati correttamente nel DB.<br><br>");
					//$stmt->closeCursor();
					$con = NULL; //chiudo connessione
				} catch(PDOException $e) { //controllo errori di connessione
					echo "Error: Failed to connect to DB: " . $e->getMessage();
					die();
				}
				//move_uploaded_file esegue la copia fisica del file sul server
				//il primo parametro rappresenta il puntatore al file ricevuto
				//il secondo parametro rappresenta il percorso dove salvare il file
				move_uploaded_file($fileRicevuto["tmp_name"], $target_file);
				echo "<br>Il file uploadato ora si trova nella sottodirectory Upload.<br><hr>";
				//oppure eliminare il file una volta caricati i dati
				//unlink($fileRicevuto["tmp_name"]);
			}
        }
    ?>
    <a href="upload.html">INDEX</a>
</body>

</html>