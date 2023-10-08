<?php 
        $errors = "";
        $db =  new mysqli("localhost", "root", "", "todo");
        if (isset($_POST['submit'])) {
                if (empty($_POST['task'])) {
                        $errors = "task is required";
                }else{
                        $task = $_POST['task'];
                        echo "$task";
                        $sql = "INSERT INTO tasks (task) VALUES ('$task')";
                        $db->query($sql);
                        if ($db->query($sql) === TRUE) {
    echo "New record created successfully";
    
} else {
    echo "Error: " . $sql . "<br>" . $db->error;
}
                  
                }
        } 
      if (isset($_GET['del_task'])) {
        $id = $_GET['del_task'];

        mysqli_query($db, "DELETE FROM tasks WHERE id=".$id);
        header('location: index.php');
}

?>  
        
        
        <!DOCTYPE html>
<html>
<head>
        <title>ToDo List Application PHP</title>
</head>
<body>
        <div>
                <h2>ToDo List Application PHP</h2>
        </div>
        <form method="post" action="index.php" class="input_form">
         <?php if (isset($errors)) { ?>
        <p><?php echo $errors; ?></p>
<?php } ?>
                <input type="text" name="task">
                <button type="submit" name="submit" id="add_btn">Add Task</button>
        </form>
        <table>
        <thead>
                <tr>
                        <th>N</th>
                        <th>Tasks</th>
                        <th style="width: 60px;">Action</th>
                </tr>
        </thead>

        <tbody>
                <?php 
                $tasks = mysqli_query($db, "SELECT * FROM tasks");

                $i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
                        <tr>
                                <td> <?php echo $i; ?> </td>
                                <td class="task"> <?php echo $row['task']; ?> </td>
                                <td class="delete"> 
                                        <a href="index.php?del_task=<?php echo $row['id'] ?>">x</a> 
                                </td>
                        </tr>
                <?php $i++; } ?>  
        </tbody>
</table>
       
</body>
</html>