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
                <a class="nav-link active" href="form_add_classe.php">Add Classe<span class="sr-only">(current)</span></a>
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
                <a class="nav-link" href="query.php">Query</a>
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
    <h2 align="center">Nuova Classe</h2>
    <div class="card" style="margin-left: 20%; margin-right: 20%; margin-top: 5%">
        <div class="card-body">
            <form action="add_classe.php" method = "POST" enctype = "multipart/form-data">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Id Classe</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="es. 5arob" name="id">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Numero di studenti</label>
                    <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="Numero di studenti" name="num">
                </div>
                <div class="form-group">
                    <label for="inputState">Coordinatore della classe</label>
                    <select id="inputState" class="form-control" name="id_docente">
                    <?php
                            session_start();							
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $con = new PDO("mysql:host=$servername;dbname=db_myclassroom", $username, $password);
                            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $istruzione = "SELECT * FROM docenti WHERE id_docente NOT IN (SELECT id_docente_coord FROM classi)";
                            $stmt = $con->prepare($istruzione);
                            $stmt->execute();  //eseguo la query
                            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                echo("<option> " . $row['id_docente'] . " - " . $row['nome'] . " - " . $row['cognome'] . " </option>");
                            }
                            $con = NULL;
                        ?>
                    </select>
                </div>
                <br><br>
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>