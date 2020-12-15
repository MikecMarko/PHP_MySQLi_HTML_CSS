<?php 

    include('database.php'); 
    database_connection();
    
?>

<?php 

    include('header.php');
    
?>

<h3>Sending a new request for a project</h3>

<?php 

if(isset($_POST['moderator']) && !empty($_POST['moderator']))
{
    
    $save = "INSERT INTO project (user_id, moderator_id, date_time_creation, locked)
                VALUES (".$_SESSION['user_id'].", ".$_POST['moderator'].", NOW(), 0)";
        
    query($save);
}

$moderators_option = '';

$moderators = "SELECT user_id, name, lastname FROM user WHERE type_id = 1";
$db_query = query($moderators);

if(mysqli_num_rows($db_query) > 0)
{
    while($data=mysqli_fetch_assoc($db_query))
    {
        $moderators_option .= '<option value="'.$data['user_id'].'">'.$data['name'].' '.$data['lastname'].'</option>';
    }   
}

?>

<form action="new_request.php" name="new_project_request" method="POST">
  <label for="moderator">Moderator:</label> 
  <select name="moderator">
    <?php echo $moderators_option; ?>
  </select><br><br>
  <input type="submit" value="Send request">
</form>


<?php 

include('footer.php');

?>
