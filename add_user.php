<?php 

    include('database.php'); 
    database_connection();
    
?>

<?php 

    include('header.php');
    
?>

<h3>Add user</h3>

<?php 

if(
    isset($_POST['type']) &&
    isset($_POST['username']) && !empty($_POST['username']) &&
    isset($_POST['password']) && !empty($_POST['password']) &&
    isset($_POST['name']) && !empty($_POST['name']) &&
    isset($_POST['lastname']) && !empty($_POST['lastname']) &&
    isset($_POST['email']) && !empty($_POST['email']) 
)
{
    
    $user_update = "INSERT INTO user (type_id, username, password, name, lastname, email, picture)
                             VALUES ('".$_POST['type']."', '".$_POST['username']."', '".$_POST['password']."', '".$_POST['name']."', 
                             '".$_POST['lastname']."', '".$_POST['email']."', '".$_POST['picture']."')";
    query($user_update);

    header("Location:users.php");
}

?>


<form action="add_user.php" name="add_user" method="POST">
  <label for="type">Type:</label> 
  <select name="type">
        <option value="0">Administrator</option>
        <option value="1">Moderator</option>
        <option value="2">Registrated user</option>
  </select><br><br>
  <label for="username">User name:</label> 
  <input required type="text" id="username" name="username" value=""><br><br>
  <label for="password">Password:</label> 
  <input required type="text" id="password" name="password" value=""><br><br>
  <label for="name">Name:</label> 
  <input required type="text" id="name" name="name" value=""><br><br>
  <label for="lastname">Last name:</label> 
  <input required type="text" id="lastname" name="lastname" value=""><br><br>
  <label for="email">E-mail:</label> 
  <input requiredtype="text" id="email" name="email" value=""><br><br>
  <label for="picture">Picture:</label> 
  <input type="text" id="picture" name="picture" value=""><br><br>
  <input type="submit" value="Save">
</form>

<?php 

include('footer.php');

?>
