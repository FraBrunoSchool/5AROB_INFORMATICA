<!DOCTYPE html>
<html lang="en">
<head>
    <title>MyClassroom | Docente</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="../../index.html">
            <img src="../../img/logo.png" alt="..." width="150px" height="25px"/>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="docente_page.php">Upload Verifiche</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="risultati_verifiche.php">Risultati Verifiche<span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                <?php
                    session_start();
                    echo('<a class="badge badge-dark">' . $_SESSION['nome'] . '</a>');
                    session_abort();
                ?>
                </li>
            </ul>
        </div>
    </nav>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Titolo Del Documento</th>
        <th scope="col">Nome Alunno</th>
        <th scope="col">Cognome Alunno</th>
        <th scope="col">Voto</th>
        </tr>
    </thead>
    <tbody>
    <?php
        session_start();							
        $servername = "localhost";
        $username = "root";
        $password = "";
        $con = new PDO("mysql:host=$servername;dbname=db_myclassroom", $username, $password);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $verifica=$_REQUEST["verifica"];
        $_SESSION['verifica'] = $verifica;
        $istruzione = "SELECT F.id_file, F.id_verifica AS id,  V.titolo_documento AS file_veri, F.titolo_documento AS file_stud, F.voto, A.* FROM verifiche V, files F, alunni A WHERE F.id_verifica=V.id_verifica AND F.id_verifica = $verifica AND F.id_alunno=A.id_alunno";
        $stmt = $con->prepare($istruzione);
        $stmt->execute();  //eseguo la query
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo('<tr>');
            echo('<th scope="row">' . $row['id'] . '</th>');
            echo('<td><a href="http://localhost/Elaborato/Portale_MyClassroom/Uploads/' . $row['id'] . '_' . $row['file_veri'] . '/' . $row['file_stud']. '" target="_blank" >' . $row['file_stud'] . '</a></td>');
            echo('<td>' . $row['nome'] . '</td>');
            echo('<td>' . $row['cognome'] . '</td>');
            if($row['voto'] == null){
                echo('<td><form action="add_voto.php" method = "POST" enctype = "multipart/form-data"><input style="width:100px" type="text" id="exampleFormControlInput1" placeholder="Voto" name="voto"><button class="btn btn-primary btn-sm" type="submit" value="' . $row['id_file'] . '" name="btn_file">Add</button></form><td>');
            }else{
                echo('<td>' . $row['voto'] . '</td>');
            }
            }
        $con = NULL;    
    ?>
    </tbody>
    </table>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>