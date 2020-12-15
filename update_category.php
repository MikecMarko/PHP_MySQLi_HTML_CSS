<?php 

    include('database.php'); 
    database_connection();
    
?>

<?php 

    include('header.php');
    
?>

<h3>Add Category</h3>

<?php

if(
    isset($_POST['name']) && !empty($_POST['name']) &&
    isset($_POST['description']) && !empty($_POST['description']) &&
    isset($_POST['required'])
)
{
    $query = "UPDATE category SET name = '".$_POST['name']."', description = '".$_POST['description']."', required = '".$_POST['required']."' WHERE category_id = " . $_POST['category_id'];
    query($query);

    header("Location:element_categories.php");
}

$name = '';
$description = '';


$data_update = "SELECT * FROM category WHERE category_id = " . $_GET['category_id'];

$query_data = query($data_update);

if(mysqli_num_rows($query_data) > 0)
{
    while($data=mysqli_fetch_assoc($query_data))
    {
        $name = $data['name'];
        $description = $data['description'];

        if($data['required'] == 1)
        {
            $select_yes = 'selected';
            $select_no = '';
        }
        else
        {
            $select_no = 'selected';
            $select_yes = '';
        }
        
    }
}

?>

<form action="update_category.php" name="update_category" method="POST">
  <input type="hidden" name="category_id" value="<?php echo $_GET['category_id'] ?>">
  <label for="name">Name:</label> 
  <input required type="text" id="name" name="name" value="<?php echo $name ?>"><br><br>
  <label for="description">Description:</label> 
  <input required type="text" id="description" name="description" value="<?php echo $description ?>"><br><br>
  <label for="required">Required:</label> 
  <select name="required">
    <option value="0" <?php echo $select_no ?>>NO</option>
    <option value="1" <?php echo $select_yes ?>>YES</option>
  </select><br><br>
  <input type="submit" value="Send">
</form>


<?php 

include('footer.php');

?>
