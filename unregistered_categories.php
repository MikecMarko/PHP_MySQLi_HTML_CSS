<?php 

    include('database.php'); 
    database_connection();
    
?>

<?php 

    include('header.php');
    
?>

<h3>Categories with the number of projects which have that category listed</h3>

<table>
    <tr>
        <th>Name</th>
        <th>Total</th>
    </tr>

<?php 

$query = "SELECT c.name, COUNT(c.category_id) AS total  FROM category c, project_items p 
         WHERE p.category_id = c.category_id GROUP BY c.category_id";

$db_query = query($query);

if(mysqli_num_rows($db_query) > 0)
{
    

    while($data=mysqli_fetch_assoc($db_query))
    {
        echo '<tr>';
        echo '<td>'.$data['name'].'</td>';
        echo '<td>'.$data['total'].'</td>';
        echo '</tr>';
    }

    
}

?>

</table>

<?php 

include('footer.php');

?>
