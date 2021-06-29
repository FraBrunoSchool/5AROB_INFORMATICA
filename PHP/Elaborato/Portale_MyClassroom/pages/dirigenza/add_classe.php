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
        $num=$_POST["num"];
        $id_docente=$_POST["id_docente"];

        $con = new PDO("mysql:host=$servername;dbname=db_myclassroom", $username);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $con->prepare("SELECT id_classe FROM classi WHERE id_classe = :id");
        $stmt -> bindParam(":id", $id, PDO::PARAM_INT);
        $stmt -> execute();
        $result = $stmt -> fetch(PDO::FETCH_ASSOC);
        if($result == ""){
            $stmt = $con->prepare("INSERT INTO classi (id_classe, num_alunni, id_docente_coord) VALUES  (:id_classe, :num_alunni, :id_docente_coord)");
            $stmt -> bindParam(":id_classe", $id, PDO::PARAM_STR);
            $stmt -> bindParam(":num_alunni", $num, PDO::PARAM_INT);
            $stmt -> bindParam(":id_docente_coord", $id_docente, PDO::PARAM_INT);
            $stmt -> execute();
            $stmt = $con->prepare("COMMIT;");
            $stmt -> execute();
            $stmt = $con->prepare("INSERT INTO docentidelleclassi (id_classe, id_docente) VALUES  (:id_classe, :id_docente)");
            $stmt -> bindParam(":id_classe", $id, PDO::PARAM_STR);
            $stmt -> bindParam(":id_docente", $id_docente, PDO::PARAM_INT);
            $stmt -> execute();
            header("location: form_add_classe.php");
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