<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Consegne</title>
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
    <h2 align="center">Consegna qui la tua verifica</h2>
    <!-- upload verifica -->
    <div class="card" style="margin-left: 20%; margin-right: 20%; margin-top: 5%">
        <div class="card-body">
            <form action="upload.php" method = "POST" enctype = "multipart/form-data">
                <div class="input-group mb-3" >
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile02" name="file" accept=".pdf">
                        <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text" id="inputGroupFileAddon02">Upload</span>
                    </div>
                </div>
                <?php
                    $titolo_documento=$_REQUEST["btn_consegna"];
                    echo('<button type="submit" class="btn btn-primary" value="' . $titolo_documento . '" name="btn_consegna">Submit</button>');
                ?>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>