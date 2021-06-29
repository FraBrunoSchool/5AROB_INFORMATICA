<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Voto</title>
</head>

<body>
	<h1>Esito upload</h1>
    <?php
		session_start();
        $servername = "localhost";
        $username = "root";
        $password = "";
        try{
            $con = new PDO("mysql:host=$servername;dbname=db_myclassroom", $username, $password);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $voto=$_REQUEST["voto"];
            $id_file=$_REQUEST["btn_file"];
            $command = $con->prepare("UPDATE files SET voto=$voto WHERE id_file=$id_file");
            $command->execute();
        } catch(PDOException $e) { 
            //controllo errori di connessione
            echo "Error: Failed to connect to DB: " . $e->getMessage();
            die();
        }            
        header("location: risultati_verifiche.php");
    ?>
</body>