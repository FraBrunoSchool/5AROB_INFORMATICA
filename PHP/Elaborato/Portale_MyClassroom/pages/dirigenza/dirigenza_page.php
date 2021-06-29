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
            <li class="nav-item active">
                <a class="nav-link" href="dirigenza_page.php">Add Dirigenza<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="form_add_classe.php">Add Classe</a>
            </li>
            <li class="nav-item">
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
                    //echo();
                ?>
                </li>
            </ul>
        </div>
    </nav>
    <h2 align="center">Nuovo Dirigente</h2>
    <div class="card" style="margin-left: 20%; margin-right: 20%; margin-top: 5%">
        <div class="card-body">
            <form action="add_dirigenza.php" method = "POST" enctype = "multipart/form-data">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Id</label>
                    <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="Id" name="id">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Password</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Password" name="psw">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nome</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nome" name="nome">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Cognome</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Cognome" name="cognome">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Data di nascita</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="anno-mese-giorno" name="data">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Luogo di nascita</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Luogo di Nascita" name="luogo">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">E-mail</label>
                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="E-mail" name="email">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Numero di telefono</label>
                    <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="Numero di telefono" name="num">
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>