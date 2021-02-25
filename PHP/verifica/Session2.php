<?php
	session_start();

	if(isset($_REQUEST['inputName']))
	{
		$_SESSION['Name'] = $_REQUEST['inputName'];
	}
?>
<html>
   <head>
      <title>Controllo della sessione</title>
   </head>
   <body>
<?php
	if(isset($_SESSION['Name']))
	{
		print("<h3>Benvenuto, {$_SESSION['Name']}!</h3>\n");
	}
    else
	{
		print("<h3>Benvenuto, inserisci il tuo nome!</h3>\n");
    	print("<form action=\"{$_SERVER['PHP_SELF']}\" " .
		"method=\"post\"> <input type=\"text\" name=\"inputName\" " .
		"value=\"\">  <input type=\"submit\" value=\"salva\"><br>\n" .
		"</form>");
	}

    print("<h3>Informazioni sulla sessione:</h3>\n");

	print("Name: " . session_name() . "<br>\n");
	print("ID: " . session_id() . "<br>\n");
	print("Module Name: " . session_module_name() . "<br>\n");
	print("Save Path: " . session_save_path() . "<br>\n");
	print("Encoded Session:" . session_encode() . "<br>\n");

?>
   </body>
</html>
</html>