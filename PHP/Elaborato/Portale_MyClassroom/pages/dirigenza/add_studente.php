<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Iscrizione</title>
</head>

<body>
  <h1>Benvenuto</h1>
    <h3>I tuoi dati sono stati inseriti</h3>
    <?php
    $servername = "localhost";
    $username = "root";
    try{
        $id=$_POST["id"];
        $psw=$_POST["psw"];
        $nome=$_POST["nome"];
        $cognome=$_POST["cognome"];
        $data=$_POST["data"];
        $luogo=$_POST["luogo"];
        $email=$_POST["email"];
        $classe=$_POST["classe"];

        $con = new PDO("mysql:host=$servername;dbname=db_myclassroom", $username);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $con->prepare("SELECT id_alunno FROM alunni WHERE id_alunno = :id");
        $stmt -> bindParam(":id", $id, PDO::PARAM_INT);
        $stmt -> execute();
        $result = $stmt -> fetch(PDO::FETCH_ASSOC);
        if($result == ""){
            $stmt = $con->prepare("INSERT INTO alunni (id_alunno, password, nome, cognome, data_nascita, luogo_nascita, email, id_classe ) VALUES  (:id_alunno, :password, :nome, :cognome, :data_nascita, :luogo_nascita, :email, :id_classe)");
            $stmt -> bindParam(":id_alunno", $id, PDO::PARAM_INT);
            $stmt -> bindParam(":password", $psw, PDO::PARAM_STR);
            $stmt -> bindParam(":nome", $nome, PDO::PARAM_STR);
            $stmt -> bindParam(":cognome", $cognome, PDO::PARAM_STR);
            $stmt -> bindParam(":data_nascita", $data, PDO::PARAM_STR);
            $stmt -> bindParam(":luogo_nascita", $luogo, PDO::PARAM_STR);
            $stmt -> bindParam(":email", $email, PDO::PARAM_STR);
            $stmt -> bindParam(":id_classe", $classe, PDO::PARAM_STR);
            $stmt -> execute();
            header("location: form_add_studente.php");
        }else{
            echo("Non è stato possibile inserire l'utente");
        }
        $con = NULL;
    }catch(PDOException $e) { //controllo errori di connessione
        echo "Error: Failed to connect to DB: " . $e->getMessage();
        die();
    }
    
    ?>
    
</body>

</html>