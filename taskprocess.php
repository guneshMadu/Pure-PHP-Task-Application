<?php
session_start();
$mysqli = new mysqli('localhost','root','','taskapp') or die(mysqli_error($mysqli));

$id = 0;
$name = "";
$description = "";
$update = false;

if(isset($_POST['save'])){
    $name = $_POST['name'];
    $description = $_POST['description'];

    $mysqli -> query("INSERT INTO task1(name,description) VALUES ('$name','$description')")or die($mysqli->error);

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location:taskindex.php");
}

if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM task1 WHERE id=$id") or die($mysqli->error());

    if(count($result)==1){
        $row = $result->fetch_array();
        $name = $row['name'];
        $description = $row['description'];
    }
}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM task1 WHERE id=$id") or die($mysqli->error());
    
    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";
    header("location:taskindex.php");
}

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    $mysqli->query("UPDATE task1 SET name='$name', description='$description' WHERE id=$id") or die($mysqli->error());
    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning";
    header("location:taskindex.php");
}

?>


