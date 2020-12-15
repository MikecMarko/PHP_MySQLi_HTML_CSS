<?php 

    include('database.php'); 
    database_connection();
    
?>

<?php 

    include('header.php');
    
?>

<h3>My requests</h3>

<table>
    <tr>
        <th>Action</th>
        <th>Name</th>
        <th>Date and time of creation</th>
        <th>Name</th>
        <th>Last name</th>
        <th>Status</th>
    </tr>

<?php 

$query = "SELECT p.name, p.date_time_creation, p.locked, p.project_id,
(SELECT name FROM user WHERE p.moderator_id=user_id) as name, 
(SELECT lastname FROM user WHERE p.moderator_id=user_id) as lastname
FROM project p, user u WHERE  u.user_id = ".$_SESSION['user_id']." AND u.user_id=p.user_id";

$db_query = query($query);

if(mysqli_num_rows($db_query) > 0)
{
    while($data=mysqli_fetch_assoc($db_query))
    {
        $date_time_creation = strtotime($data['date_time_creation']);
        $date_time_creation_format = date("d.m.Y. H:i:s", $date_time_creation);

        if($data['locked'] == 0)
        {
            $link = '-';
            $status = 'Unlocked';
        }
        else
        {
            $link = '<a style="color:black" href="item_view.php?project_id='.$data['project_id'].'">Items</a>';
            $status = 'Locked';
        }

        echo '<tr>';
        echo '<td>'.$link.'</td>';
        echo '<td>'.$data['name'].'</td>';
        echo '<td>'.$date_time_creation_format.'</td>';
        echo '<td>'.$data['name'].'</td>';
        echo '<td>'.$data['lastname'].'</td>';
        echo '<td>'.$status.'</td>';
        echo '</tr>';
    }   
}

?>

</table>

<?php 

include('footer.php');

?>
