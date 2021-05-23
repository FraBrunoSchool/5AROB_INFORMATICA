<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secret page</title>
    
</head>
<body>
    <?php

        if(isset($_POST["usr"]) && isset($_POST["pwd"])){

            //prendo le credenziali
            $usr = $_POST["usr"];
            $pwd = $_POST["pwd"];

            //connessione al db
			$con = new mysqli('localhost','root','','db_credenziali');
			if ($con->connect_error)    //controllo errori di connessione
				die("Error: Failed to connect to DB: ".$con->connect_errno . " - ". $con->connect_error);
                
                    
			$sql="SELECT email, pswd FROM dati_persone WHERE email = '$usr' && pswd = '$pwd'";   //cerco nome utente e password
			$ok = $con->query($sql);    //eseguo la query
            
            
            if($ok){   //l'utente esiste e le credenziali sono corrette
                $record = $ok->fetch_assoc();
                //AVVIO SESSIONE
                session_start();
                //copio il nome utente 
                $_SESSION['utente'] = $record['email'];
                header('location: /verificaphp/welcome.php');
            } else {    //messaggio di errore
                echo("<label style='color:red'>Password o Username non validi</label>");
            }
                
            $con->close();
        }else{
            echo("<label style='color:red'>Inserisci username e password</label>");
        }

    ?>
</body>
</html>