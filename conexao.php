<?php
    
    $host = "";
    $user = "";
    $password = "";
    $db = "";  
    
    $link = mysqli_connect($host, $user, $password, $db);
    
    mysqli_set_charset($link,'utf8');
    if (!$link) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    
    //print_r($link);
    //mysqli_close($link);
	/*
	error_reporting(E_ERROR);
	$link = mysql_connect('127.0.0.1', 'gre', 'bbt2018');
	mysql_set_charset('utf8', $link);

	if (!$link) {

	die('Não conseguiu conectar: ' . mysql_error());

	}



	// seleciona o banco mauroloureiro

	$db_selected = mysql_select_db('gre', $link);

	if (!$db_selected) {

	die ('Não pode selecionar o banco bbt : ' . mysql_error());

	}

	//mysql_set_charset('UTF8', $link);
*/
?>