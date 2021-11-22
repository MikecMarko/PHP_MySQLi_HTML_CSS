<?php 

    include('database.php'); 
    database_connection();
    
?>

<?php 

    include('header.php');

    session_destroy();

    header("Location:index.php");
    
?>
