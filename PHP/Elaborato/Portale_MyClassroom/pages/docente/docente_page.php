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
            <li class="nav-item active">
                <a class="nav-link" href="docente_page.php">Upload Verifiche<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="risultati_verifiche.php">Risultati Verifiche</a>
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
    <!-- upload verifica -->
    <div class="card" style="margin-left: 20%; margin-right: 20%; margin-top: 5%">
        <div class="card-body">
            <form action="upload.php" method = "POST" enctype = "multipart/form-data">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Titolo Della Verifica</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Titolo" name="titolo">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Data e Ora Di Scadenza Della Verifica</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="anno-mese-giorno-ora-min" name="data">
                </div>
                <div class="input-group mb-3" >
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile02" name="file" accept=".pdf">
                        <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text" id="inputGroupFileAddon02">Upload</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputState">Materia</label>
                    <select id="inputState" class="form-control" name="materia">
                    <?php
                        session_start();							
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $con = new PDO("mysql:host=$servername;dbname=db_myclassroom", $username, $password);
                        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $istruzione = "SELECT M.id_materia, M.nome_materia FROM materie M, docentiinsegnanomaterie D WHERE M.id_materia = D.id_materia AND id_docente = :id";
                        $stmt = $con->prepare($istruzione);
                        $id = intval($_SESSION['id_docente']);
                        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                        $stmt->execute();  //eseguo la query
                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                            echo('<option value="' . $row['id_materia'] . '">' . $row['nome_materia'] . '</option>');
                        }
                        $con = NULL;
                        session_abort();
                    ?> 
                    </select>
                </div>
                <div class="form-group">
                    <label for="inputState">Argomento</label>
                    <select id="inputState" class="form-control" name="argomento">
                        <?php
                            session_start();							
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $con = new PDO("mysql:host=$servername;dbname=db_myclassroom", $username, $password);
                            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $istruzione = "SELECT * FROM argomenti";
                            $stmt = $con->prepare($istruzione);
                            $stmt->execute();  //eseguo la query
                            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                echo('<option value="' . $row['id_argomento'] . '">' . $row['descr'] . '</option>');
                            }
                            $con = NULL;
                            session_abort();
                        ?> 
                    </select>
                </div>
                <div class="form-group">
                    <label for="inputState">Classe</label>
                    <select id="inputState" class="form-control" name="classe">
                    <?php
                            session_start();							
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $con = new PDO("mysql:host=$servername;dbname=db_myclassroom", $username, $password);
                            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $istruzione = "SELECT DISTINCT id_classe FROM docentidelleclassi WHERE id_docente = :id";
                            $stmt = $con->prepare($istruzione);
                            $id = intval($_SESSION['id_docente']);
                            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                            $stmt->execute();  //eseguo la query
                            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                echo("<option>" . $row['id_classe'] . "</option>");
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
    <div class="card" style="margin-left: 20%; margin-right: 20%; margin-top: 5%">
        <div class="card-body">
            <h2>Aggiungi Argomento</h2>
            <form action="add_argomento.php" method = "POST" enctype = "multipart/form-data">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Descrizione</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Argomento" name="arg">
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>