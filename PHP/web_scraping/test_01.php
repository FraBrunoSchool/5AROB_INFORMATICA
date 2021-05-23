<?php
require_once 'LIB/RemoteConnector.php';
require_once 'LIB/LIB_parse.php';
$url = 'http://www.itiscuneo.gov.it/';
try {
    $output = new Pos_RemoteConnector($url);
    if (strlen($output)) {
		$output = tidy_html($output);
		$myfile = fopen("testfile.txt", "w") or die("Unable to open file!");
		fwrite($myfile, $output);
		fclose($myfile);
		echo "Creato file $myfile";
    } else {
        echo $output->getErrorMessage();
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
?>