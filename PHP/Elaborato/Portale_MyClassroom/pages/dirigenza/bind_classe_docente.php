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
        $id_classe=$_POST["id_classe"];
        $id_docente=$_POST["id_docente"];

        $con = new PDO("mysql:host=$servername;dbname=db_myclassroom", $username);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $con->prepare("INSERT INTO docentidelleclassi (id_classe, id_docente) VALUES  (:id_classe, :id_docente)");
        $stmt -> bindParam(":id_classe", $id_classe, PDO::PARAM_STR);
        $stmt -> bindParam(":id_docente", $id_docente, PDO::PARAM_INT);
        $stmt -> execute();
        header("location: form_bind_classe_docente.php");
        $con = NULL;
    }catch(PDOException $e) { //controllo errori di connessione
        echo "Error: Failed to connect to DB: " . $e->getMessage();
        die();
    }
    
    ?>
    
</body>

</html>