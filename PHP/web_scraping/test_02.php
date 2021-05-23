<?php
require_once 'LIB/RemoteConnector.php';
require_once 'LIB/LIB_parse.php';
$url = 'http://www.itiscuneo.gov.it/';
try {
    $output = new Pos_RemoteConnector($url);
    if (strlen($output)) {
		$output = tidy_html($output);
		$title = return_between($output, "<title>", "</title>", EXCL);
		echo "<h3>Titolo: </h3>" . $title . "<hr>";
		
		$head = remove($output, "<body", "</html>");
		$body = remove($output, "<html>", "</head>");

		$imgs = parse_array($body, "<img SRC=", " ");
		echo "<h3>File immagine usati nella pagina: </h3><br>";
		$i=1;
		foreach($imgs as $img){
			$value = get_attribute($img, "SRC");
			echo "N." . $i . ": " . $value . "<br>";
			$i++;			
		}
		echo "<hr>";

		$links = parse_array($body, "<a HREF=", ">");
		echo "<h3>Link esterni al sito trovati nella pagina: </h3><br>";
		$i=1;
		foreach($links as $link){
			$value = get_attribute($link, "HREF");
			if (substr($value, 0, 4) == "http") { 
				echo "N." . $i . ": " . $value . "<br>";
				$i++;
			}			
		}
		//echo "<hr>";
		//print json_encode($links);
    } else {
        echo $output->getErrorMessage();
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
?>