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
			$titolo_documento=$_REQUEST["titolo"] . ".pdf";
            $target_file = "../../Uploads/" . basename($titolo_documento);
            if(file_exists($target_file))
                echo("Attenzione il file esiste già.<br>");
            else
            {
                $servername = "localhost";
	            $username = "root";
	            $password = "";
				try{
					$con = new PDO("mysql:host=$servername;dbname=db_myclassroom", $username, $password);
					$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$command = $con->prepare("INSERT INTO verifiche (titolo_documento, data_ora_scadenza, id_docente, id_materia , id_argomento , id_classe) VALUES (:titolo_documento, :data_ora_scadenza, :id_docente, :id_materia, :id_argomento, :id_classe)");
					$data_ora_scadenza=$_REQUEST["data"];
					$materia=$_REQUEST["materia"];
					$argomento=$_REQUEST["argomento"];
					$id_classe=$_REQUEST["classe"];
					$id_docente = intval($_SESSION['id_docente']);
					$command->bindParam(":titolo_documento", $titolo_documento, PDO::PARAM_STR);
					$command->bindParam(":data_ora_scadenza", $data_ora_scadenza, PDO::PARAM_STR);
					$command->bindParam(":id_docente", $id_docente, PDO::PARAM_INT);					
					$command->bindParam(":id_materia", $materia, PDO::PARAM_INT);
					$command->bindParam(":id_argomento", $argomento, PDO::PARAM_INT);
					$command->bindParam(":id_classe", $id_classe, PDO::PARAM_STR);
					$command->execute();
					$command = $con->prepare("SELECT id_verifica FROM verifiche WHERE titolo_documento='$titolo_documento' AND data_ora_scadenza='$data_ora_scadenza' AND id_docente=$id_docente AND id_materia=$materia AND id_argomento=$argomento AND id_classe='$id_classe'");
        			$command->execute();
					$row = $command->fetch(PDO::FETCH_ASSOC);
					$id_verifica = $row['id_verifica'];
					$path = '../../Uploads/' . $id_verifica . '_' . $titolo_documento;
					if(!mkdir($path)) {
						echo 'La cartella è stata creata';
					}
					$target_file = "../../Uploads/" . $id_verifica . '_' . $titolo_documento . "/" . basename($titolo_documento);
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
				header("location: docente_page.php");  //renderizza alla home
			}
        }
		session_abort()
    ?>
</body>

</html>