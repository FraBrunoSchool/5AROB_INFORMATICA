<!DOCTYPE html>
<html lang="en">
<head>
    <title>MyClassroom | Dirigenza</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="img/login.png"/>
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
                <a class="nav-link" href="dirigenza_page.php">Add Dirigenza</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="form_add_classe.php">Add Classe</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="form_add_docente.php">Add Docente</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="form_add_studente.php">Add Studente</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="form_bind_classe_docente.php">Bind Classe-Docente</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="query.php">Query<span class="sr-only">(current)</span></a>
            </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                <?php
                    session_start();
                    echo('<a class="badge badge-dark">' . $_SESSION['nome'] . '</a>');
                    //echo();
                    session_abort();
                ?>
                </li>
            </ul>
        </div>
    </nav>
    <br><br>
    <h4 align="center">I 5 studenti con la media voti più alta della scuola</h4>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Nome Alunno</th>
        <th scope="col">Cognome Alunno</th>
        <th scope="col">Classe</th>
        <th scope="col">Media</th>
        </tr>
    </thead>
    <tbody>
    <?php						
        $servername = "localhost";
        $username = "root";
        $password = "";
        $con = new PDO("mysql:host=$servername;dbname=db_myclassroom", $username, $password);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $istruzione = "SELECT A.*, avg(F.voto) AS 'Media' FROM alunni A, files F WHERE A.id_alunno=F.id_alunno GROUP BY A.id_alunno HAVING avg(F.voto) = (SELECT MAX(val) FROM (SELECT avg(F.voto) AS val FROM files F GROUP BY F.id_alunno) subQuery) LIMIT 5";
        $stmt = $con->prepare($istruzione);
        $stmt->execute();  //eseguo la query
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo('<tr>');
            echo('<th scope="row">' . $row['id_alunno'] . '</th>');
            echo('<td>' . $row['nome'] . '</td>');
            echo('<td>' . $row['cognome'] . '</td>');
            echo('<td>' . $row['id_classe'] . '</td>');
            echo('<td>' . $row['Media'] . '</td>');
        }
        $con = NULL;    
    ?>
    </tbody>
    </table>
    <br><br>
    <h4 align="center">Gli argomenti delle 5 verifiche andate peggio nella classe 5arob</h4>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Argomento</th>
        <th scope="col">Media</th>
        </tr>
    </thead>
    <tbody>
    <?php						
        $servername = "localhost";
        $username = "root";
        $password = "";
        $con = new PDO("mysql:host=$servername;dbname=db_myclassroom", $username, $password);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $istruzione = "SELECT V.id_verifica, A.descr, avg(F.voto) AS 'Media' FROM files F, argomenti A, verifiche V WHERE F.id_verifica = V.id_verifica AND V.id_argomento = A.id_argomento AND V.id_classe='5arob' GROUP BY F.id_verifica HAVING avg(F.voto) = (SELECT MIN(val) FROM (SELECT avg(F.voto) AS val FROM files F, argomenti A, verifiche V WHERE F.id_verifica = V.id_verifica AND V.id_argomento = A.id_argomento AND V.id_classe='5arob' GROUP BY F.id_verifica) subQuery) LIMIT 5";
        $stmt = $con->prepare($istruzione);
        $stmt->execute();  //eseguo la query
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo('<tr>');
            echo('<th scope="row">' . $row['id_verifica'] . '</th>');
            echo('<td>' . $row['descr'] . '</td>');
            echo('<td>' . $row['Media'] . '</td>');
        }
        $con = NULL;    
    ?>
    </tbody>
    </table>
    <br><br>
    <h4 align="center">Le 5 classi con la media peggiore della scuola per quanto riguarda la materia italiano.</h4>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Classe</th>
        <th scope="col">Media</th>
        </tr>
    </thead>
    <tbody>
    <?php						
        $servername = "localhost";
        $username = "root";
        $password = "";
        $con = new PDO("mysql:host=$servername;dbname=db_myclassroom", $username, $password);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $istruzione = "SELECT V.id_classe, avg(F.voto) AS 'Media' FROM files F, materie M, verifiche V WHERE F.id_verifica = V.id_verifica AND V.id_materia = M.id_materia AND M.nome_materia LIKE 'italiano' GROUP BY V.id_classe HAVING avg(F.voto) = (SELECT MIN(val) FROM (SELECT avg(F.voto) AS val FROM files F, materie M, verifiche V WHERE F.id_verifica = V.id_verifica AND V.id_materia = M.id_materia AND M.nome_materia LIKE 'italiano'GROUP BY V.id_classe) subQuery)LIMIT 5";
        $stmt = $con->prepare($istruzione);
        $stmt->execute();  //eseguo la query
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo('<tr>');
            echo('<th scope="row"></th>');
            echo('<td>' . $row['id_classe'] . '</td>');
            echo('<td>' . $row['Media'] . '</td>');
        }
        $con = NULL;    
    ?>
    </tbody>
    </table>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>