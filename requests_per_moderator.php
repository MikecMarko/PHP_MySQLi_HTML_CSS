<?php 

    include('database.php'); 
    database_connection();
    
?>

<?php 

    include('header.php');
    
?>

<h3>Requests per moderator</h3>

<?php 
$users_option = '';

$users = "SELECT user_id, name, lastname FROM user WHERE type_id = 2 OR type_id = 1";
$db_query = query($users);

if(mysqli_num_rows($db_query) > 0)
{
    while($data=mysqli_fetch_assoc($db_query))
    {
        $users_option .= '<option value="'.$data['user_id'].'">'.$data['name'].' '.$data['lastname'].'</option>';
    }   
}

?>

<form action="requests per moderator.php" name="requests per moderator" method="POST">
  <label for="user">User:</label> 
  <select name="user">
    <?php echo $users_option; ?>
  </select><br><br>
  <label for="date_from">Date and time from:</label> 
  <input type="text" id="date_from" name="date_from" value=""><br><br>
  <label for="date_to">Date and time to::</label> 
  <input type="text" id="date_to" name="date_to" value=""><br><br>
  
  <input type="submit" value="Filter">
</form>

<br><br>

<table>
    <tr>
        <th>Moderator</th>
        <th>Total</th>
    </tr>

<?php 

$user = "";

if(isset($_POST['user']) && !empty($_POST['user']))
{
    $user = " AND p.user_id= " . $_POST['user'];
}

$date_from = "";

if(isset($_POST['date_from']) && !empty($_POST['date_from']))
{
    $formated_date_from = date('Y-m-d', strtotime($_POST['date_from']));

    $date_from = " AND p.date_time_creation >= " . $formated_date_from;
}

$date_to = "";

if(isset($_POST['date_to']) && !empty($_POST['date_to']))
{
    $formated_date_to = date('Y-m-d', strtotime($_POST['datum_od']));

    $date_to = " AND p.date_time_creation <= " . $formated_date_to;
}

$query = "SELECT u.name, u.lastname, COUNT(p.moderator_id) AS total FROM project p, user u 
        WHERE p.moderator_id=u.user_id $user $date_from $date_to
        GROUP BY p.moderator_id";

$db_query = query($query);

if(mysqli_num_rows($db_query) > 0)
{
    while($data=mysqli_fetch_assoc($db_query))
    {
        echo '<tr>';
        echo '<td>'.$data['name'].' '.$data['lastname'].'</td>';
        echo '<td>'.$data['total'].'</td>';
        echo '</tr>';
    }   
}



?>

</table>

<?php 

include('footer.php');

?>
