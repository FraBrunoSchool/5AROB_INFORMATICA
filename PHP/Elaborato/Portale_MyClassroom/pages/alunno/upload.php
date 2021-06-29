<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Upload</title>
</head>

<body>
	<h1>Esito upload</h1>
    <?php
		session_start();
		if ($_FILES["file"]["error"] == UPLOAD_ERR_OK) {
			$fileRicevuto=$_FILES["file"];
			$servername = "localhost";
			$username = "root";
			$password = "";
			try{
				$con = new PDO("mysql:host=$servername;dbname=db_myclassroom", $username, $password);
				$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				// query per trovare cartella
				$id_verifica=$_REQUEST["btn_consegna"];
				$id_alunno = $_SESSION['id_alunno'];
				$nome = $_SESSION['nome'];
				$cognome = $_SESSION['cognome'];
				$command = $con->prepare("SELECT titolo_documento FROM verifiche WHERE id_verifica=$id_verifica");
				$command->execute();
				$row = $command->fetch(PDO::FETCH_ASSOC);
				$titolo_documento_verifica = $row['titolo_documento'];
				$target_file = "../../Uploads/" . $id_verifica . '_' . $titolo_documento_verifica . "/" . basename($id_alunno . '_' . $nome . '_' . $cognome . '.pdf');
				if(file_exists($target_file)){
					echo("Attenzione il file esiste già.<br>");
					header("location: alunno_page.php");
					$con = NULL; //chiudo connessione
				}else{
					$command = $con->prepare("INSERT INTO files (titolo_documento, id_alunno, id_verifica) VALUES (:titolo_documento, :id_alunno, :id_verifica)");
					$id_alunno = $_SESSION['id_alunno'];
					$nome = $_SESSION['nome'];
					$cognome = $_SESSION['cognome'];
					$titolo_documento = $id_alunno . '_' . $nome . '_' . $cognome . '.pdf';
					$command->bindParam(":titolo_documento", $titolo_documento, PDO::PARAM_STR);
					$command->bindParam(":id_alunno", $id_alunno, PDO::PARAM_INT);
					$command->bindParam(":id_verifica", $id_verifica, PDO::PARAM_INT);					
					$command->execute();
					echo("I dati contenuti nel file sono stati caricati correttamente nel DB.<br><br>");
					$con = NULL; //chiudo connessione
				}
				
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
			header("location: alunno_page.php");  //renderizza alla home
		}
		session_abort()
    ?>
</body>

</html>