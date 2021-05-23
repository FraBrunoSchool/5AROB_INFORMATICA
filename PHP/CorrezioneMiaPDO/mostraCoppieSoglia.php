<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pagina di amministrazione - Mostra coppie da soglia minima</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="img/login.png"/>
    <script type="application/javascript">
			function chiudi_sessione(){
				var frm= document.getElementById("frm");				
				frm.method="post";
				frm.action="index.html";
				frm.submit();
            }
            function abilita(id){
				var btn = document.getElementById("btn"+id);
				btn.removeAttribute("disabled");
			}
    </script>
</head>
<body>
    <?php
	    $servername = "localhost";
		$username = "root";
		$password = "";
		session_start();
        if(isset($_SESSION['idUtente']) && 
			isset($_SESSION['amministrazione']) &&
				$_SESSION['amministrazione'] == 1){
			echo("<h1>BENTORNATO AMMINISTRATORE </h1>");
            echo("<h3>Pannello di controllo agenzia matrimoniale</h3>");
            echo("<hr>");
			if(isset($_POST["txtSoglia"])){
				$soglia = $_POST["txtSoglia"];
			} else {
				$soglia = 50;
			}
			try {				
				echo("<h3 style='color:green;'>Mostra coppie da soglia minima pari a " . $soglia . "</h3>");
				//utente femmina in abbinamenti sempre solo in prima posizione, maschi sempre solo in seconda posizione
				//giudizio1 è il giudizio di utente1 sulla coppia proposta, quindi femmina modifica giudizio1 e maschio giudizio2
				$istruzione = 'SELECT abbinamenti.id, utenti1.id AS idFemmina, utenti1.nome AS nomeFemmina, utenti2.id AS idMaschi, utenti2.nome AS nomeMaschio, abbinamenti.giudizio1 AS giudizioDiFemminaSuCoppia, abbinamenti.giudizio2 AS giudizioDiMaschioSuCoppia, abbinamenti.scartato FROM abbinamenti, utenti AS utenti1, utenti AS utenti2 WHERE  (abbinamenti.idUtente1 = utenti1.id) AND (abbinamenti.idUtente2 = utenti2.id)';
				$con = new PDO("mysql:host=$servername;dbname=agenziamatrimoniale", $username, $password);
				$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$stmt = $con->prepare($istruzione);
				$stmt->execute();  //eseguo la query
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$num = $stmt->rowCount();
				if($num==0){
					die("Password o Username non validi");
				}else{
					echo("<form method='post'>");
					echo("<div class='table-responsive'>");	
					echo('<table class="table" style="border:2px solid black;border-collapse:collapse" border="1">');
					echo('<thead><tr class="table"><th class="col-xs-1">Rif.</th><th class="col-xs-3">Donna</th><th class="col-xs-3">Uomo</th><th class="col-xs-2">Coppia piace a donna (%)</th><th class="col-xs-2">Coppia piace a uomo  (%)</th><th class="col-xs-1">Scartata</th></tr></thead>');
					echo('<tbody>');					
					while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
						if(($row['giudizioDiFemminaSuCoppia'] + $row['giudizioDiMaschioSuCoppia']) < $soglia ){
							continue;
						}
						$id = $row['id']; //accedo alla colonna che si chiama "id"
						echo('<tr class="table">');
						echo "<td class='col-xs-1' style='color:white;background:gray;'> $id </td>";
						echo '<td class="col-xs-3">' . $row["nomeFemmina"] . '</td>';
						echo '<td class="col-xs-3">' . $row["nomeMaschio"] . '</td>';
						echo '<td class="col-xs-2">' . $row["giudizioDiFemminaSuCoppia"] . '</td>';
						echo '<td class="col-xs-2">' . $row["giudizioDiMaschioSuCoppia"] . '</td>';                        
						echo '<td class="col-xs-1">' . $row["scartato"] . '</td>';                        						
						echo("</tr>");
					}
					echo("</tbody></table></div><hr>");
					echo("</form>");
				}	
				//$stmt->closeCursor();
				$con = NULL; //chiudo connessione
			} catch(PDOException $e) { //controllo errori di connessione
				echo "Error: Failed to connect to DB: " . $e->getMessage();
				die();
			}
		}else{
            header("location: index.html");  //renderizza alla home
        }		
		echo("<br><br>");
        echo("<form action='login.php' method='POST' id='frm'>");
		echo("<button id='btnAnagrafica' type='submit' class='btn btn-success' formaction='admin.php'>Torna a pannello amministrazione</button>");
		echo("<button type='button' onClick='chiudi_sessione()' class='btn btn-dark'>Esci</button>");
        echo("</form>");
    ?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>