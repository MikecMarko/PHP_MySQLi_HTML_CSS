<?php 

include('database.php'); 
database_connection();

?>

<?php 

    $lock = "UPDATE project SET locked = 1 WHERE project_id = " . $_GET['project_id'];
    query($lock);

    header("Location:user_requests_for_new_project.php");


?>

<?php 

include('footer.php');

?>
