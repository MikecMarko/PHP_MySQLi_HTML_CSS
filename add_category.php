<?php 

    include('database.php'); 
    database_connection();
    
?>

<?php 

    include('header.php');
    
?>

<h3>Add category</h3>

<?php

if(
    isset($_POST['name']) && !empty($_POST['name']) &&
    isset($_POST['description']) && !empty($_POST['description']) &&
    isset($_POST['required'])
)
{
    $query = "INSERT INTO category (name, description, required) VALUES ('".$_POST['name']."', '".$_POST['description']."', '".$_POST['required']."')";
    query($query);

    header("Location:element_categories.php");
}

?>

<form action="add_category.php" name="add_category" method="POST">
  <label for="name">Name:</label> 
  <input required type="text" id="name" name="name" value=""><br><br>
  <label for="description">Description:</label> 
  <input required type="text" id="description" name="description" value=""><br><br>
  <label for="required">Required:</label> 
  <select name="required">
    <option value="0">NO</option>
    <option value="1">YES</option>
  </select><br><br>
  <input type="submit" value="Send">
</form>


<?php 

include('footer.php');

?>
