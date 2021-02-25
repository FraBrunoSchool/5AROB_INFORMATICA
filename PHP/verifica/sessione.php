<?php
	//Svuota sessione - Begin
	//http://localhost:8090/4A/4sessione/4pagina1Sessione
	//	.php?variabileGenerata=6&cmdHidden=svuota
	session_start();
	
	if(isset($_GET["cmdHidden"])){
		if($_GET["cmdHidden"]=="svuota"){
			//Distruggere la sessione sarà effettuato solo a fine pagina
			session_destroy();
			//quindi imposto ulteriormente la sessione a 0
			$_SESSION["cntRichiami"]=0; //inutile
		}
		if($_GET["cmdHidden"]=="portaA100"){
			$_SESSION["cntRichiami"]=100;
		}
	}
	//Svuota sessione - End


	//Gestione sessione - Begin
	//Sessione fornisce al programma un array associato predefinito
	// $_SESSION, ha delle chiavi sono definibili dal programmatore
	// per salvare i propri oggetti tra una pagina e la successiva:
	// 1) CLIENT -> PAG1.PHP -> CLIENT -> PAG1.PHP
	// 2) CLIENT -> PAG1.PHP -> PAG2.PHP
	if(isset($_SESSION["cntRichiami"])){
		//Richiami successivi passa di qui
		$cntPagina=$_SESSION["cntRichiami"];
	}
	else{		
		//Primo richiamo della pagina, l'oggetto non esiste
		// passa di qui
		$cntPagina=1;
	}
	$cntPagina++;
	echo "cntPagina: ".$cntPagina."<br>";
	
	$_SESSION["cntRichiami"]=$cntPagina;
	//Gestione sessione - End
	

	if(isset($_GET["lancia"])){
			echo "Mi hai sottomesso!!<br>";
			$val = $_GET["variabileGenerata"];
			echo "val: $val";
	}
?>
<html>
	<head>
		<script language="Javascript">
			window.onload = function(){
					document.getElementById("variabileGenerata").value = Math.floor(Math.random()*(11-0) + 0);
			}
			
			function invocaCestino(){
				document.getElementById("cmdHidden").value="svuota";
				document.getElementsByName("f1")[0].submit();
			}
			
			function portaACento(){
				document.getElementById("cmdHidden").value="portaA100";
				document.getElementsByName("f1")[0].submit();
			}

		</script>
	</head>
	<body>
		<form name="f1" action="4pagina1Sessione.php" method="get">
			<input type="text" name="variabileGenerata" id="variabileGenerata"/>
			<input type="submit" name="lancia" value="lanciaVariabile"/>&nbsp;&nbsp;&nbsp;
			<input type="hidden" id="cmdHidden" name="cmdHidden" value="" />
			<input type="button" name="btnSvuota" value="svuota sessione" onclick="invocaCestino()" />
			<input type="button" name="btnPortaA100" value="porta a 100" onclick="portaACento()" />
		</form>
	</body>
</html>
