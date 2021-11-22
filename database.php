<?php

global $mysqli;

function database_connection()
{

    global $mysqli;

    $mysqli = mysqli_connect(
        "localhost", 
        "iwa_2019", 
        "foi2019", 
        "iwa_2019_zb_projekt"
    );    

    if (mysqli_connect_errno()) 
    {
        echo "There was en error with a database: ". $mysqli->connect_error;
    }

    mysqli_query($mysqli, "SET names 'UTF8'");
}

function query($query_db)
{
    global $mysqli;

    $result_return = mysqli_query($mysqli, $query_db);
    
    if(!$result_return)
    {
        echo "There was en error with a database: " . mysqli_error($mysqli);

        exit();
    }
    
	return $result_return;
}

function close_connection()
{
	global $mysqli;
	mysqli_close($mysqli);
}
