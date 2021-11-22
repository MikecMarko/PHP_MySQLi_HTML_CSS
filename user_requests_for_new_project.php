<?php 

    include('database.php'); 
    database_connection();
    
?>

<?php 

    include('header.php');
    
?>

<h3>User requests for projects</h3>

<table>
    <tr>
        <th>Action</th>
        <th>User</th>
        <th>Name</th>
        <th>Destription</th>
        <th>Time of request</th>
        <th>Status</th>
    </tr>

<?php 

$query = "SELECT * FROM project, user
         WHERE project.user_id = user.user_id AND moderator_id = " . $_SESSION['user_id'] ." ORDER BY locked";

$db_query = query($query);

if(mysqli_num_rows($db_query) > 0)
{
    

    while($data=mysqli_fetch_assoc($db_query))
    {

        $link_lock = '';

        $check_for_lock = "SELECT * FROM project_items, category
                                        WHERE project_items.category_id = category.category_id AND 
                                        category.required = 1 AND 
                                        project_id = " . $data['project_id'];

        $query_lock = query($check_for_lock);

        if(mysqli_num_rows($query_lock) > 1)
        {
            if($data['locked'] == 0)
            {
                $link_lock = '<a href="lock_project.php?project_id='.$data['project_id'].'">Lock the project</a>';
            }
            
        }

        $date_time_creation = strtotime($data['date_time_creation']);
        $date_time_creation_format = date("d.m.Y. H:i:s", $date_time_creation);

        if($data['locked'] == 0)
        {
            if($data['name'] == '')
            {
                $link = '<a href="accept_requests.php?project_id='.$data['project_id'].'">Accept request</a>';
            }
            else
            {
                $link = '<a href="project_items.php?project_id='.$data['project_id'].'">Project items</a>';
            }

            $status = 'Unlocked';
        }
        else
        {
            $link = '-';
            $status = 'Locked';
        }

        echo '<tr>';
        echo '<td>'.$link.' '. $link_lock .'</td>';
        echo '<td>'.$data['name'].' ' .$data['lastname']. '</td>';
        echo '<td>'.$data['name'].'</td>';
        echo '<td>'.$data['description'].'</td>';
        echo '<td>'.$date_time_creation_format.'</td>';
        echo '<td>'.$status.'</td>';
        echo '</tr>';
    }

    
}

?>

</table>

<?php 

include('footer.php');

?>
