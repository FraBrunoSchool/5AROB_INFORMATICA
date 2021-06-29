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
        $chkMaterie=$_REQUEST["chkMaterie"];

        $con = new PDO("mysql:host=$servername;dbname=db_myclassroom", $username);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $con->prepare("SELECT id_docente FROM docenti WHERE id_docente = :id");
        $stmt -> bindParam(":id", $id, PDO::PARAM_INT);
        $stmt -> execute();
        $result = $stmt -> fetch(PDO::FETCH_ASSOC);
        if($result == ""){
            $stmt = $con->prepare("INSERT INTO docenti (id_docente, password, nome, cognome, data_nascita, luogo_nascita, email) VALUES  (:id_docente, :password, :nome, :cognome, :data_nascita, :luogo_nascita, :email)");
            $stmt -> bindParam(":id_docente", $id, PDO::PARAM_INT);
            $stmt -> bindParam(":password", $psw, PDO::PARAM_STR);
            $stmt -> bindParam(":nome", $nome, PDO::PARAM_STR);
            $stmt -> bindParam(":cognome", $cognome, PDO::PARAM_STR);
            $stmt -> bindParam(":data_nascita", $data, PDO::PARAM_STR);
            $stmt -> bindParam(":luogo_nascita", $luogo, PDO::PARAM_STR);
            $stmt -> bindParam(":email", $email, PDO::PARAM_STR);
            $stmt -> execute();
            $stmt = $con->prepare("INSERT INTO docentiinsegnanomaterie (id_docente, id_materia) VALUES (:id_docente, :id_materia)");
            foreach ($chkMaterie as $valore){
                $stmt -> bindParam(":id_docente", $id, PDO::PARAM_INT);
                $stmt -> bindParam(":id_materia", $valore, PDO::PARAM_INT);
                $stmt -> execute();
            }
            header("location: form_add_docente.php");
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