<?php 

    include('database.php'); 
    database_connection();
    
?>

<?php 

    include('header.php');
    
?>

<h3>Users</h3>

<a href="add_user.php"><button>Add new user</button></a>

<br><br>

<table>
    <tr>
        <th></th>
        <th>User name</th>
        <th>Password</th>
        <th>Name</th>
        <th>Last name</th>
        <th>E-mail</th>
        <th>Picture</th>
    </tr>

<?php 

$query = "SELECT user_id, name, username, lastname, picture, password, email 
        FROM user";

$db_query = query($query);

if(mysqli_num_rows($db_query) > 0)
{
    while($data=mysqli_fetch_assoc($db_query))
    {
       
        echo '<tr>';
        echo '<td><a style="color:black" href="update_user.php?user_id='.$data['user_id'].'">Update</a></td>';
        echo '<td>'.$data['username'].'</td>';
        echo '<td>'.$data['password'].'</td>';
        echo '<td>'.$data['name'].'</td>';
        echo '<td>'.$data['lastname'].'</td>';
        echo '<td>'.$data['email'].'</td>';
        echo '<td><img src="'.$data['picture'].'" width="100" height="100"></td>';
        echo '</tr>';
    }   
}

?>

</table>

<?php 

include('footer.php');

?>
