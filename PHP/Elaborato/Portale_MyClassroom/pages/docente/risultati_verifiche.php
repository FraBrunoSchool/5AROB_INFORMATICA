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
                ?>
                </li>
            </ul>
        </div>
    </nav>

    <div class="card" style="margin-left: 20%; margin-right: 20%; margin-top: 5%">
        <div class="card-body">
            <form action="visualizzazione_risultati.php" method = "POST" enctype = "multipart/form-data">
                <div class="form-group">
                    <label for="inputState">Seleziona la verifica di cui vuoi vedere le consegne</label>
                    <select id="inputState" class="form-control" name="verifica">
                    <?php
                        session_start();							
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $con = new PDO("mysql:host=$servername;dbname=db_myclassroom", $username, $password);
                        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $istruzione = "SELECT * FROM verifiche WHERE id_docente = :id";
                        $stmt = $con->prepare($istruzione);
                        $id = intval($_SESSION['id_docente']);
                        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                        $stmt->execute();  //eseguo la query
                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                            echo('<option value="' . $row['id_verifica'] . '">' . $row['titolo_documento'] . ' - ' . $row['id_classe'] . '</option>');
                        }
                        $con = NULL;
                        session_abort();
                    ?> 
                    </select>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>