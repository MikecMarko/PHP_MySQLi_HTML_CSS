<?php 

    include('database.php'); 
    database_connection();
    
?>

<?php 

    include('header.php');
    
?>

<h3>User update</h3>

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
    
    $user_update = "UPDATE user SET type_id = '".$_POST['type']."', username = '".$_POST['username']."' ,
                             password = '".$_POST['password']."', name = '".$_POST['name']."', lastname = '".$_POST['lastname']."', 
                             email = '".$_POST['email']."', picture = '".$_POST['picture']."'
                             WHERE user_id = " . $_POST['user_id'];
    query($user_update);

    header("Location:users.php");
}


$user_data = "SELECT * FROM user WHERE user_id = " . $_GET['user_id'];
$db_query = query($user_data);

if(mysqli_num_rows($db_query) > 0)
{
    while($data=mysqli_fetch_assoc($db_query))
    {
        $username = $data['username'];
        $password = $data['password'];
        $name = $data['name'];
        $lastname = $data['lastname'];
        $email = $data['email'];
        $picture = $data['picture'];

        if($data['type_id'] == 0)
        {
            $administrator = 'selected';
        }
        else
        {
            $administrator = '';
        }

        if($data['type_id'] == 1)
        {
            $moderator = 'selected';
        }
        else
        {
            $moderator = '';
        }

        if($data['type_id'] == 2)
        {
            $user = 'selected';
        }
        else
        {
            $user = '';
        }

    }
}

?>


<form action="update_user.php" name="user_update" method="POST">
  <input type="hidden" name="user_id" value="<?php echo $_GET['user_id'] ?>">
  <label for="type">Type:</label> 
  <select name="type">
        <option value="0" <?php echo $administrator ?>>Administrator</option>
        <option value="1" <?php echo $moderator ?>>Moderator</option>
        <option value="2" <?php echo $user ?>>Registrated userk</option>
  </select><br><br>
  <label for="username">User name:</label> 
  <input required type="text" id="username" name="username" value="<?php echo $username ?>"><br><br>
  <label for="password">Password:</label> 
  <input required type="text" id="password" name="password" value="<?php echo $password ?>"><br><br>
  <label for="name">Name:</label> 
  <input required type="text" id="name" name="name" value="<?php echo $name ?>"><br><br>
  <label for="lastname">Last name:</label> 
  <input required type="text" id="lastname" name="lastname" value="<?php echo $lastname ?>"><br><br>
  <label for="email">E-mail:</label> 
  <input requiredtype="text" id="email" name="email" value="<?php echo $email ?>"><br><br>
  <label for="picture">Picture:</label> 
  <input type="text" id="picture" name="picture" value="<?php echo $picture ?>"><br><br>
  <input type="submit" value="Store">
</form>

<?php 

include('footer.php');

?>
