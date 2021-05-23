<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>PHP</title>
</head>

<body>
	<h1>Esito upload</h1>
    <?php
    require_once './Pos/RemoteConnector.php';
	require_once './Pos/LIB_parse.php';
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
                echo("I dati contenuti nel file sono stati caricati correttamente nel DB.<br><br>");
                $con = new PDO("mysql:host=$servername;dbname=db_scraping", $username, $password);
                $con_url = new PDO("mysql:host=$servername;dbname=db_scraping", $username, $password);
                $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $con_url->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);				
                $command = $con->prepare("INSERT INTO inputurl (URL, protocollo) VALUES (:line, :prot)");
				$urls = file( $_FILES["txtFile"]["tmp_name"], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
				//$command_url = $con_url->prepare("SELECT idURL, URL FROM inputurl WHERE protocollo = 'http' ");
                //var_dump($urls);
				foreach ($urls as $linea) {
                    //$protocollo = split(trim($linea), ":")[0];   
                    $protocollo = "http";
                    echo "$protocollo <br>"; 
					$command->bindParam(":prot", $protocollo, PDO::PARAM_STR);
					$command->bindParam(":line", $linea, PDO::PARAM_STR);
					if($command->execute())
					    echo " Il url $linea &egrave; stato aggiunto al database.<br>";
					else
						echo " Errore: il url $linea NON &egrave; stato aggiunto al database.<br>";
                    echo "<br>";
                    echo "<br>";
                    // ------------------------------------------------
                    // scraping
                    try {
                        $output = new Pos_RemoteConnector($linea);
                        if (strlen($output)) {
                            $output = tidy_html($output);
                            $title = return_between($output, "<title>", "</title>", EXCL);
                            echo "<h3>Titolo: </h3>" . $title . "<hr>";
                            
                            $head = remove($output, "<body", "</html>");
                            $body = remove($output, "<html>", "</head>");
                    
                            $imgs = parse_array($body, "<img SRC=", " ");
                            echo "<h3>File immagine usati nella pagina: </h3><br>";
                            $i=1;
                            foreach($imgs as $img){
                                $value = get_attribute($img, "SRC");
                                echo "N." . $i . ": " . $value . "<br>";
                                $i++;			
                            }
                            echo "<hr>";
                    
                            $links = parse_array($body, "<a HREF=", ">");
                            echo "<h3>Link esterni al sito trovati nella pagina: </h3><br>";
                            $i=1;
                            foreach($links as $link){
                                $value = get_attribute($link, "HREF");
                                if (substr($value, 0, 4) == "http") { 
                                    $command_url = $con_url->prepare("INSERT INTO dati (URLestratto, idURLorigine, protocollo) VALUES ('$value', '$link', 'http')");
						            $command_url->execute();
                                    echo "N." . $i . ": " . $value . "<br>";
                                    $i++;
                                }			
                            }
                            //echo "<hr>";
                            //print json_encode($links);
                        } else {
                            echo $output->getErrorMessage();
                        }
                    } catch (Exception $e) {
                        echo $e->getMessage();
                    }
                    //-------------------------------
                }
                $con=null;
                $con_url=null;
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
    <a href="index.html">INDEX</a>
</body>

</html>