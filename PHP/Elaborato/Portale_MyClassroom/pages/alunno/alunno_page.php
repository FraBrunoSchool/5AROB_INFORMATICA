<!DOCTYPE html>
<html lang="en">
<head>
    <title>MyClassroom | Alunno</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
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
            <li class="nav-item active">
                <a class="nav-link" href="alunno_page.php">Verifiche<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="i_miei_voti.php">I miei voti</a>
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
    <h2 align="center">Le Tue Verifiche</h2>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Titolo Del Documento</th>
        <th scope="col">Data e Ora Di Scadenza</th>
        <th scope="col">Nome Docente</th>
        <th scope="col">Cognome Docente</th>
        <th scope="col">Materia</th>
        <th scope="col">Argomento</th>
        <th scope="col">Consegna</th>
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
        $classe = $_SESSION['classe'];
        $id_alunno = $_SESSION['id_alunno'];
        $istruzione = "SELECT V.id_verifica, V.titolo_documento, V.data_ora_scadenza, D.nome, D.cognome, M.nome_materia, A.descr FROM verifiche V, docenti D, materie M, argomenti A WHERE D.id_docente=V.id_docente AND V.id_materia=M.id_materia AND V.id_argomento=A.id_argomento AND V.id_classe = '" . $classe . "' ORDER BY V.id_verifica DESC";
        $stmt = $con->prepare($istruzione);
        $stmt->execute();  //eseguo la query
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo('<tr>');
            echo('<th scope="row">' . $row['id_verifica'] . '</th>');
            echo('<td><a href="http://localhost/Elaborato/Portale_MyClassroom/Uploads/' . $row['id_verifica'] . '_' . $row['titolo_documento'] . '/' . $row['titolo_documento']. '" target="_blank" >' . $row['titolo_documento'] . '</a></td>');
            echo('<td>' . $row['data_ora_scadenza'] . '</td>');
            echo('<td>' . $row['nome'] . '</td>');
            echo('<td>' . $row['cognome'] . '</td>');
            echo('<td>' . $row['nome_materia'] . '</td>');
            echo('<td>' . $row['descr'] . '</td>');
            // controllo se ha già consegnato
            $con_cons = new PDO("mysql:host=$servername;dbname=db_myclassroom", $username, $password);
            $con_cons->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $id_verifica = $row['id_verifica'];
            $istruzione_cons = "SELECT * FROM files WHERE id_verifica=$id_verifica AND id_alunno=$id_alunno";
            $stmt_cons = $con_cons->prepare($istruzione_cons);
            $stmt_cons->execute();
            $totale = $stmt_cons->rowCount();
            if($totale!=0){
                echo('<td>Consegnato</td>');
            }else{
                echo('<td><form action="consegna_verifica.php" method = "POST" enctype = "multipart/form-data"><button type="submit" class="btn btn-primary" value="' . $row['id_verifica'] . '" name="btn_consegna">Submit</button></form>');
            }
            $con_cons= NULL;
            echo('</tr>');
        }
        $con = NULL;
        session_abort();
    ?>
    </tbody>
    </table>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>