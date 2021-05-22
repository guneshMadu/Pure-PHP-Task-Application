<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
    <title>Task</title>
</head>
<body>
    <?php require_once 'taskprocess.php'; ?>

    <?php  if(isset($_SESSION['message'])):  ?>
    <div class="alert alert-<?=$_SESSION['msg_type']?>">

    <?php
     echo $_SESSION['message'];
     unset($_SESSION['message']);
    ?> 
    </div>
    <?php endif; ?>


    <?php
        $mysqli = new mysqli('localhost','root','','taskapp') or die(mysqli_error($mysqli));
        $result = $mysqli -> query('SELECT * FROM task1') or die($mysqli->error);
    ?>

    <h1> <span class="badge bg-dark">Manage your Task</span> </h1>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">TaskApp</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="taskindex.php" class="nav-link active">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link active">About Developer</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>




    <div class="container">
        <table class="table">
        <thead>
            <th>Task Name</th>
            <th>Description</th>
            <th colspan="2">Action</th>
        </thead>
       
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td> <?php echo $row['name']; ?> </td>
                <td> <?php echo $row['description']; ?> </td>
                <td>
                    <a href="taskindex.php?edit= <?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
                    <a href="taskindex.php?delete= <?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>


    <div class="container">
        <form action="taskprocess.php" method="post" class="form-control">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="form-group mb-3">
            <label for="">Task Name</label>
            <input type="text" name="name" id="" placeholder="Enter Task Name" value="<?php echo $name; ?>" class="form-control">
        </div>
       
       <div class="form-group mb-3">
            <label for="">Description</label>
            <input type="text" name="description" id="" placeholder="Enter Task Description" value="<?php echo $description; ?>" class="form-control">
       </div>

       <div class="form-group mb-3">
            <?php if($update==true): ?>
                <button type="submit" name="update" value="Update" class="btn btn-info">Update</button>
            <?php else: ?>    
            <button type="submit" name="save" value="Save" class="btn btn-primary">Save</button>
            <?php endif; ?>
       </div>
        
        </form>
    </div>
</body>
</html>
