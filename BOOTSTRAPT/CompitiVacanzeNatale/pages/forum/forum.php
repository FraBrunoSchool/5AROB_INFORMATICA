<!--
textbox:	Nome
		Cognome
		Eta
radiobutton:Sesso
checkbox: Pilates, Yoga, ...
textbox: Email
-->
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>PHP</title>
</head>

<body>
<h1>Benvenuto!!</h1>
<h3>Questi sono i tuoi dati inseriti</h3>
<?php
$nome=$_REQUEST["txtNome"];
echo("Nome: $nome<br>");


$cognome=$_REQUEST["txtCognome"];
echo("Cognome: $cognome<br>");

$eta=$_REQUEST["txtEta"];
echo("Età: $eta<br>");

$sesso=$_REQUEST["sesso"];
echo("Sesso: $sesso<br>");


$corsi=$_REQUEST["chkCorsi"];
echo("Corsi: ");
foreach ($corsi as $valore)
    echo("$valore, ");
echo("<br>");

$email=$_REQUEST["txtE-Mail"];
echo("E-Mail: $email<br>");

$con = new mysqli('localhost','root/CompitiVacanzeNatale','','dbIscrizioni');
if ($con->connect_error)
	die("Error: Failed to connect to DB: ".$con->connect_errno . " - ". $con->connect_error);


$sql="INSERT INTO iscritti VALUES ('$nome', '$cognome', '$eta', '$sesso', '$corsi', '$email')";
$ok = $con->query($sql);
?>


</body>

</html>
