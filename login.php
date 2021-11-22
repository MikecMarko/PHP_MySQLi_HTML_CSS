<?php 

    include('database.php'); 
    database_connection();
    
?>

<?php 

    include('header.php');
    
?>


<h3>Log in to system</h3>

<?php 


if( isset($_POST['username']) && 
    !empty($_POST['username']) && 
    isset($_POST['password']) && 
    !empty($_POST['password'])){
  
    $login_query = "SELECT * FROM user WHERE password = '".$_POST['password']."' AND username = '".$_POST['username']."'";

    $db_login_query = query($login_query);

    if(mysqli_num_rows($db_login_query) > 0)
    {
        while($user_data=mysqli_fetch_assoc($db_login_query))
        {
            $_SESSION = $user_data;
        }

        if($_SESSION['type_id'] == 1)
        {
            header("Location:user_requests_for_new_project.php");
        }
        else
        {
            header("Location:index.php");
        }

        
    }
    else
    {
        echo "<br><h4 style='color: red'>Wrong user name or password, please try again!</h4>";
    }
}




?>

<form action="login.php" name="login" method="POST">
  <label for="username">User name:</label> 
  <input type="text" id="username" name="username" value=""><br><br>
  <label for="password">Password:</label> 
  <input type="password" id="password" name="password" value=""><br><br>
  <input type="submit" value="Send">
</form>


<?php 

include('footer.php');

?>
