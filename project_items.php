<?php 

    include('database.php'); 
    database_connection();
    
?>

<?php 

    include('header.php');
    
?>


<h3>Project items</h3>

<?php 

if(
    isset($_POST['category_id']) && !empty($_POST['category_id']) &&
    isset($_POST['project_id']) && !empty($_POST['project_id'])
    )
{
    $item_update = "UPDATE project_items SET description = '".$_POST['description']."', picture = '".$_POST['picture']."', video = '".$_POST['video']."'
                        WHERE project_id = '".$_POST['project_id']."' AND category_id = '".$_POST['category_id']."'";
    query($item_update);

    header("Location:project_items.php?project_id=".$_POST['project_id']);
}

$category_option = '';
$description = '';
$picture = '';
$video = '';
$category_id = '';

$unfulfilled_fetch = "SELECT * FROM category WHERE category_id NOT IN (SELECT category_id FROM project_items WHERE project_id = '".$_GET['project_id']."')";
                                  
$db_query_category = query($unfulfilled_fetch);

if(mysqli_num_rows($db_query_category) > 0)
{
    while($category_data_query=mysqli_fetch_assoc($db_query_category))
    {
        $category_option .= '<option value="'.$category_data_query['category_id'].'">'.$category_data_query['name'].' ('.$category_data_query['description'].')</option>';
    }
}


if(isset($_GET['category_id']) && !empty($_GET['category_id']))
{
    $category_id = $_GET['category_id'];

    $category_option = '';

    $fetch_update = "SELECT *, project_items.description AS project_items_description, category.description AS category_description 
                          FROM project_items, category 
                          WHERE project_items.category_id = category.category_id AND  
                          project_items.category_id = ".$_GET['category_id']." AND project_id = '".$_GET['project_id']."'";
    $query_fetch_update = query($fetch_update);

    if(mysqli_num_rows($query_fetch_update) > 0)
    {
        while($data_fetch_update=mysqli_fetch_assoc($query_fetch_update))
        {
            
            $category_option .= 
               '<option value="'.$data_fetch_update['category_id'].'">
                '.$data_fetch_update['naziv'].' ('.$data_fetch_update['category_description'].')
                </option>';

            $description = $data_fetch_update['project_items_description'];
            $picture = $data_fetch_update['picture'];
            $video = $data_fetch_update['video'];
        }
    }
}

if(
isset($_POST['category']) && !empty($_POST['category']) &&
isset($_POST['description']) && !empty($_POST['description']) &&
isset($_POST['picture']) && !empty($_POST['picture']) &&
empty($_POST['item_id'])
)
{
     $insert_item = "INSERT INTO project_items (project_id, category_id, description, picture, video) 
                       VALUES ('".$_POST['project_id']."', '".$_POST['category']."', '".$_POST['description']."', '".$_POST['picture']."', 
                       '".$_POST['video']."')";
     query($insert_item);

     header("Location:project_items.php?project_id=".$_POST['project_id']);
}

?>

<form action="project_items.php" name="project_items" method="POST">
  <input type="hidden" name="category_id" value="<?php echo $category_id?>">
  <input type="hidden" name="project_id" value="<?php echo $_GET['project_id'] ?>">
  <label for="category">Category:</label> 
  <select required name="category">
    <?php echo $category_option; ?>
  </select><br><br>
  <label for="description">Description:</label> 
  <input required type="text" id="description" name="description" value="<?php echo $description ?>"><br><br>
  <label for="picture">Picture:</label> 
  <input required type="text" id="picture" name="picture" value="<?php echo $picture ?>"><br><br>
  <label for="video">Video:</label> 
  <input type="text" id="video" name="video" value="<?php echo $video ?>"><br><br>
  <input type="submit" value="Save item">
</form>

<br>
<hr>
<br>

<?php 

$lock_link = '';

$check_lock = "SELECT * FROM project_items, category WHERE project_items.category_id = category.category_id AND 
                                   category.required = 1 AND 
                                   project_id = " . $_GET['project_id'];
$query_lock = query($check_lock);

if(mysqli_num_rows($query_lock) > 1)
{
    $lock_link = '<a href="lock_project.php?project_id='.$_GET['project_id'].'"><button>Lock the project</button></a>';
}

echo $lock_link .'<br><br>';

?>

<table>
    <tr>
        <th>Action</th>
        <th>Category name</th>
        <th>Category description</th>
        <th>Item description</th>
        <th>Picture</th>
        <th>Video</th>
    </tr>


<?php



$show_items = "SELECT *, category.description AS category_description, project_items.description AS project_items_description
                  FROM project_items, category WHERE project_items.category_id = category.category_id AND project_id = " . $_GET['project_id'];

$items_db_query = query($show_items);

if(mysqli_num_rows($items_db_query) > 0)
{
    while($data=mysqli_fetch_assoc($items_db_query))
    {
        $picture = '-';
        $video = '-';

        if($data['picture'] != '')
        {
            $picture = '<img src="'.$data['picture'].'" width = "100" height = "100"';
        }

        if($data['video'] != '')
        {
            $video = '<iframe width="260" height="115" src="'.$data['video'].'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        }

        echo '<tr>';
        echo '<td><a href="project_items.php?project_id='.$data['project_id'].'&category_id='.$data['category_id'].'">Update</a></td>';
        echo '<td>'.$data['name'].'</td>';
        echo '<td>'.$data['category_description'].'</td>';
        echo '<td>'.$data['project_items_description'].'</td>';
        echo '<td>'.$picture.'</td>';
        echo '<td>'.$video.'</td>';
        echo '</tr>';
    }
}

?>

</table>

<?php 

include('footer.php');

?>
