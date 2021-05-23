<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    
    <title>Amministratore</title>

    <script type="application/javascript">
			function chiudi_sessione(){
                alert("sto uscendo");
				var frm= document.getElementById("frm");
				frm.method="post";
				frm.action="index.html";
				frm.submit();
            }
    </script>
</head>
<body>
    <h1>Pagina dell'amministratore</h1>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <?php
        session_start();
        if(isset($_SESSION['utente'])){
            echo("<h1>BENTORNATO AMMINISTRATORE </h1>".$_SESSION['utente']);
        }
        else{
            header("location:/BrunoFrancesco_VerificaPHP/index.html");
        }
        echo("<form action='index.html' method='POST' id='frm'>");
        echo("<button type='button' onClick='chiudi_sessione()' class='btn btn-dark'>Logout</button>");
        echo("</form>");

        $con = new mysqli('localhost','root','','db_agenziamatrimoniale');
        if ($con->connect_error)
            die("Error: Failed to connect to DB: ".$con->connect_errno . " - ". $con->connect_error);    
        $sql="SELECT id, nome, sesso, eta, altezza, peso FROM utenti ORDER BY sesso, nome";
        $ok = $con->query($sql);
        echo("<br>");
        echo("<br>");
        echo("<br>");
        echo("<table class='table'>");
        echo("<thead>");
        echo("<tr>");
        echo("<th scope='col'>#</th>");
        echo("<th scope='col'>Nome</th>");
        echo("<th scope='col'>Sesso</th>");
        echo("<th scope='col'>Eta</th>");
        echo("<th scope='col'>Altezza</th>");
        echo("<th scope='col'>Peso</th>");
        echo("</tr>");
        echo("</thead>");
        echo("<tbody>");
        while ($record = $ok->fetch_assoc()) {
            echo("<tr>");
            echo("<th scope='row'>");
            echo($record["id"]);
            echo("</th>");
            echo("<td>");
            echo($record["nome"]);
            echo("</td>");
            echo("<td>");
            echo($record["sesso"]);
            echo("</td>");
            echo("<td>");
            echo($record["eta"]);
            echo("</td>");
            echo("<td>");
            echo($record["altezza"]);
            echo("</td>");
            echo("<td>");
            echo($record["peso"]);
            echo("</td>");
            echo("</tr>");
        }
        echo("</tbody>
        </table>");
        $sql="SELECT * FROM utenti WHERE sesso = 1";
        $okM = $con->query($sql);
        $sql="SELECT * FROM utenti WHERE sesso = 0";
        $okF = $con->query($sql);
        while ($recordM = $okM->fetch_assoc()) {
            $id_m = $recordM['id'];
            while ($recordF = $okF->fetch_assoc()) {
                $id_f = $recordF['id'];
                $sql="INSERT INTO abbinamenti (idUtente1, idUtente2, giudizio1, giudizio2) VALUES ('$id_m','$id_f', 0, 0)";
                $ok = $con->query($sql);
            }
        }

        echo("<h1>ABBINAMENTI</h1>");

        $sql="SELECT * FROM abbinamenti ORDER BY id";
        $ok = $con->query($sql);
        echo("<br>");
        echo("<br>");
        echo('idUtente1');
        echo(" - ");
        echo('idUtente2');
        echo(" - ");
        echo('giudizio1');
        echo(" - ");
        echo('giudizio2');
        echo(" - ");
        echo('scartato');
        echo("<br>");
        while ($record = $ok->fetch_assoc()) {
            echo($record['idUtente1']);
            echo(" - ");
            echo($record['idUtente2']);
            echo(" - ");
            echo($record['giudizio1']);
            echo(" - ");
            echo($record['giudizio2']);
            echo(" - ");
            echo($record['scartato']);
            echo("<br>");
        }
        $con->close();
    ?>
</body>
</html>  