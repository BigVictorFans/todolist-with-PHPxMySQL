<?php
   
  //database info
  
  $host = "127.0.0.1";
  $database_name = "tasks";
  $database_user = "root";
  $database_password = "";


  //conect it to the database

  $database = new PDO(
   "mysql:host=$host;
   dbname=$database_name",
   $database_user, 
   $database_password
  );
  
  $task_id = $_POST["task_id"];
  $task_completed = $_POST["task_completed"];

  //get the data
  // 3.1 -recipe
  if ($task_completed == 0){
    $sql = "UPDATE tasktable SET completed = 1 WHERE id = :id";
  }
  else{
    $sql = "UPDATE tasktable SET completed = 0 WHERE id = :id";
  }
  // 3.2 prepare the mats
  $query = $database->prepare( $sql );
  // 3.3 cook it
  $query->execute([
    "id" => $task_id
]);

  // 4. redirect the user back to the index.php
  header("Location: index.php");
  exit;

?>