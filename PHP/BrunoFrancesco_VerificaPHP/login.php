<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secret page</title>
    
</head>
<body>
    <?php

        if(isset($_POST["nick"]) && isset($_POST["pwd"])){
            $usr = $_POST["nick"];
            $pwd = $_POST["pwd"];
			$con = new mysqli('localhost','root','','db_agenziamatrimoniale');
			if ($con->connect_error)
				die("Error: Failed to connect to DB: ".$con->connect_errno . " - ". $con->connect_error);    
			$sql="SELECT nickname, pwd, amministratore FROM utenti WHERE nickname = '$usr' && pwd = '$pwd'";   //cerco nome utente e password
			$ok = $con->query($sql);
            
            
            if($ok){
                $record = $ok->fetch_assoc();
                session_start();
                $_SESSION['utente'] = $record['nickname'];
                if($record['amministratore']==1){
                    header('location: /BrunoFrancesco_VerificaPHP/amministratore.php');
                }else{
                    header('location: /BrunoFrancesco_VerificaPHP/utente.php');
                }
                
            } else { 
                echo("<label style='color:red'>Password o Username non validi</label>");
            }
                
            $con->close();
        }else{
            echo("<label style='color:red'>Inserisci username e password</label>");
        }

    ?>
</body>