<?php 

    include('database.php'); 
    database_connection();
    
?>

<?php 

    include('header.php');
    
?>

<h3>Listed project item</h3>

<table>
    <tr>
        <th>Item description </th>
        <th>Item picture</th>
        <th>Item video</th>
    </tr>

<?php 

$query = "SELECT * FROM project_items WHERE project_id =". $_GET['project_id'];

$db_query = query($query);

if(mysqli_num_rows($db_query) > 0)
{
    

    while($data=mysqli_fetch_assoc($db_query))
    {
        
        $video = '-';

        if($data['video'] != '')
        {
            $video = '<iframe width="200" height="100" src="'.$data['video'].'?autoplay=0"> </iframe>';
        }

        echo '<tr>';
        echo '<td>'.$data['description'].'</td>';
        echo '<td><img src="'.$data['picture'].'" width="100" height="100"></td>';
        echo '<td>'.$video.'</td>';
        echo '</tr>';
    }

    
}


?>

</table>

<?php 

include('footer.php');

?>
