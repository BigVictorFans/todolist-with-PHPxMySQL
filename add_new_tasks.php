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

 
    // data from the input in index.php
    $task_label = $_POST["task_label"];

    // check if the student_name is empty or not
    if ( empty($task_label) ) {
        echo "Please enter a new task";
    }

    // 3. add the student name to students table
    // 3.1 SQL command (recipe)
    $sql = "INSERT INTO tasktable (`label`) VALUES (:label)";
    // 3.2 prepare your SQL query (prepare your material)
    $query = $database->prepare( $sql );
    // 3.3 execute the SQL query (cook it)
    $query->execute([
        "label" => $task_label
    ]);

    // 4. redirect the user back to the index.php
    header("Location: index.php");
    exit;
?>
