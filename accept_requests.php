<?php 

    include('database.php'); 
    database_connection();
    
?>

<?php 

    include('header.php');
    
?>

<h3>Accept request</h3>

<?php 

if(isset($_POST['project_id']) && !empty($_POST['project_id']) &&
    isset($_POST['name']) && !empty($_POST['name']) &&
    isset($_POST['description']) && !empty($_POST['description']))
{
    
    $query = "UPDATE project SET name = '".$_POST['name']."', description = '".$_POST['description']."' WHERE project_id = " . $_POST['project_id'];
    query($query);

    header("Location:user_requests_for_new_project.php");

}
?>




<form action="accept_requests.php" name="accept request" method="POST">
  <input type="hidden" name="project_id" value="<?php echo $_GET['project_id'] ?>">
  <label for="name">Name:</label> 
  <input type="text" id="name" name="name" value=""><br><br>
  <label for="description">Description:</label> 
  <input type="text" id="description" name="description" value=""><br><br>
  <input type="submit" value="Accept">
</form>

<?php 

include('footer.php');

?>
