
<!doctype html>
<html>
    <head>
        <title>Residential architecture planner</title>
        <meta charset="UTF-8" >
        <link type="text/css" href="style.css" rel="stylesheet">
    </head>

<body>

<?php session_start() ?>
<br>
    <h1 style="text-align:center">Residential architecture planner</h2>
    <br>
    <div class="wrapper">
   
    <?php 
  
    if(!isset($_SESSION['type_id']))
    {
        
        echo '<a class="btn" href="index.php">Home page</a>';
        echo '<a class="btn" href="login.php">Log In</a>';
        echo '<a class="btn" href="unregistered_categories.php">Categories and total number of them</a>';
      
    }

    if(isset($_SESSION['type_id']))
    {
        echo '<a class="btn" href="index.php">Home page</a>';
        echo '<a class="btn" href="logoff.php">Log Out</a>';
        echo '<a class="btn" href="unregistered_categories.php">Categories and total number of them</a>';
    }
    
    if(isset($_SESSION['type_id']))
    {

        switch($_SESSION['type_id'])
        {
            case 2:
                echo '<a class="btn" href="new_request.php">New project request</a>';
                echo '<a class="btn" href="my_requests.php">My requests</a>';
            break;

            case 1:
                echo '<a class="btn" href="new_request.php">New project request</a>';
                echo '<a class="btn" href="my_requests.php">My requests</a>';
                echo '<a class="btn" href="user_requests_for_new_project.php">User requests for project plan</a>';
            break;

            case 0:
                echo '<a class="btn" href="new_request.php">New project request</a>';
                echo '<a class="btn" href="my_requests.php">My requests</a>';
                echo '<a class="btn" href="user_requests_for_new_project.php">User requests for project plan</a>';
                echo '<a class="btn" href="users.php">System users</a>';
                echo '<a class="btn" href="element_categories.php">Categories</a>';
                echo '<a class="btn" href="requests_per_moderator.php">Requests per moderator</a>';
            break;
        }

    }
    
    ?>
    <br><br>
  
    </div>

<div class="">



