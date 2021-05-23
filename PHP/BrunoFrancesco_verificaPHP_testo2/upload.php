<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>PHP scraper - parte 1</title>
</head>

<body>
	<h1>Esito upload</h1>
    <?php
		if ($_FILES["csvFile"]["error"] == UPLOAD_ERR_OK) {
			$fileRicevuto=$_FILES["csvFile"];
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
					$con = new PDO("mysql:host=$servername;dbname=agenzia", $username, $password);
					$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);				
					$command = $con->prepare("INSERT INTO utenti (nome, sesso, eta, altezza, peso, nickname, password) VALUES (:nome, :sesso, :eta, :altezza, :peso, :nickname, :password)");
					$users = file( $_FILES["csvFile"]["tmp_name"], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
					foreach ($users as $user) { 
						$esploso = explode(",", $user);   
						$command->bindParam(":nome", $esploso[0], PDO::PARAM_STR);
						$command->bindParam(":sesso", $esploso[1], PDO::PARAM_STR);
						$command->bindParam(":eta", $esploso[2], PDO::PARAM_STR);
						$command->bindParam(":altezza", $esploso[3], PDO::PARAM_STR);
						$command->bindParam(":peso", $esploso[4], PDO::PARAM_STR);
						$command->bindParam(":nickname", $esploso[5], PDO::PARAM_STR);
						$command->bindParam(":password", $esploso[6], PDO::PARAM_STR);
						$command->execute();
					}
					echo("I dati contenuti nel file sono stati caricati correttamente nel DB.<br><br>");
					$con = NULL; //chiudo connessione
				} catch(PDOException $e) { 
					//controllo errori di connessione
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
</body>

</html>