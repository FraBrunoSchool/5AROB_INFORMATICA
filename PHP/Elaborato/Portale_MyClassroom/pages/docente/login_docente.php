<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="img/login.png"/>
</head>
<body>
    <?php
	    $servername = "localhost";
		$username = "root";
		$password = "";
        if(isset($_POST["cod_utente"]) && isset($_POST["pwd"])){
            //prendo le credenziali
            $usr = $_POST["cod_utente"];
            $pwd = $_POST["pwd"];
            //connessione al db
			try {				
				$con = new PDO("mysql:host=$servername;dbname=db_myclassroom", $username, $password);
				$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$istruzione="SELECT * FROM docenti WHERE id_docente = '" . $usr . "' AND password = '" . $pwd . "';";
				$stmt = $con->prepare($istruzione);
				$stmt->execute();  //eseguo la query
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$totale = $stmt->rowCount();
				if($totale==0){
					die("Password o Username non validi");
				}else{
					//AVVIO SESSIONE
					session_start();							
					$_SESSION['id_docente'] = $row['id_docente'];
					$_SESSION['nome'] = $row['nome'];
					$_SESSION['cognome'] = $row['cognome'];
					header("location: docente_page.php");  //renderizza alla home		
				}
				$con = NULL; //chiudo connessione
			} catch(PDOException $e) { //controllo errori di connessione
				echo "Error: Failed to connect to DB: " . $e->getMessage();
				die();
			}
        }else{
            echo("<label style='color:red'>Inserisci username e password</label>");
        }
    ?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>