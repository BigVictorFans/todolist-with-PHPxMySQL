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
  

  //get the data
  // 3.1 -recipe
  $sql = "SELECT * FROM tasktable";
  // 3.2 prepare the mats
  $query = $database->prepare( $sql );
  // 3.3 cook it
  $query->execute();
  // 3.4 eat
  $tasks = $query->fetchAll();

?>

<!DOCTYPE html>
<html>
  <head>
    <title>TODO App</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
    />
    <style type="text/css">
      body {
        background: #f1f1f1;
      }
    </style>
  </head>
  <body>
    <div
      class="card rounded shadow-sm"
      style="max-width: 500px; margin: 60px auto;"
    >
      <div class="card-body">
        <h3 class="card-title mb-3">My Todo List</h3>
        <ul class="list-group">
          <?php foreach ($tasks as $key => $task) { ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
             <div>
             <!-- task checked button updater -->
               <?php
               $buttonclass = "";
               $tickclass = "";
               $buttonstatus = $task["completed"];
               if ($buttonstatus == 1) {
                $buttonclass = 'btn btn-sm btn-success';
                $tickclass = "bi bi-check-square";
               } else {
                $buttonclass = 'btn btn-sm btn-light';
                $tickclass = "bi bi-square";
               }
               ?>
               <!-- task checked button -->
               <form method="POST" action="update_completed.php">
                 <input type="hidden" name="task_id" value="<?php echo $task["id"]; ?>" />
                 <input type="hidden" name="task_completed" value="<?php echo $task["completed"]; ?>" />
                 <button class="<?php echo $buttonclass; ?>">
                  <i class="<?php echo $tickclass; ?>"></i>
                 </button>
               </form>
               <!-- the task names -->
               <?php
               $class = "";
               $status = $task["completed"];
               if ($status == 1) {
                $class = 'ms-2 text-decoration-line-through';
               } else {
                $class = 'ms-2 text-decorantion-none';
               }
               ?>
              <span class= "<?php echo $class; ?>" > <?php echo $task["label"]; ?></span>
             </div>
             <div>
               <!-- delete button -->
               <form 
                 method="POST" 
                 action="delete_tasks.php"
                >
                <!-- hidden input is to pass required data to the backend -->
                 <input type= "hidden" name="task_id" value="<?php echo $task["id"]; ?>" />
                 <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
               </form>
             </div>
           </li>
          <?php } ?>
        </ul>
        <div class="mt-4">
          <form method="POST" action="add_new_tasks.php" class="d-flex justify-content-between align-items-center">
            <input
              type="text"
              class="form-control"
              placeholder="Add new item..."
              name="task_label"
              required
            />
            <button class="btn btn-primary btn-sm rounded ms-2">Add</button>
          </form>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>