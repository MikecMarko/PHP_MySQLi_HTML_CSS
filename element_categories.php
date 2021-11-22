<?php 

    include('database.php'); 
    database_connection();
    
?>

<?php 

    include('header.php');
    
?>

<h3>Category elements</h3>

<a href="add_category.php"><button>Add category</button></a>

<br><br>

<table>
    <tr>
        <th></th>
        <th>Name</th>
        <th>Description</th>
        <th>Required</th>
    </tr>

<?php 

$query = "SELECT * FROM category";

$db_query = query($query);

if(mysqli_num_rows($db_query) > 0)
{
    while($data=mysqli_fetch_assoc($db_query))
    {
        $required = 'NO';

        if($data['required'] == 1)
        {
            $required = 'YES';
        }
       
        echo '<tr>';
        echo '<td><a style="color:black" href="update_category.php?category_id='.$data['category_id'].'">Update</a></td>';
        echo '<td>'.$data['name'].'</td>';
        echo '<td>'.$data['description'].'</td>';
        echo '<td>'.$required.'</td>';
        echo '</tr>';
    }   
}

?>

</table>

<?php 

include('footer.php');

?>
