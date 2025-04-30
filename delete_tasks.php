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

 // data from the delete form (id)
 $task_id = $_POST["task_id"];

  //get the data
  // 3.1 -recipe
  $sql = "DELETE FROM tasktable WHERE id = :id";
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