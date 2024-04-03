<?php session_start(); include 'head.php';
if (empty($_SESSION)){header("location:home/index.html");}
else if( $_SESSION['verified'] == 0){
    header("location:notVerified.php");
}



$email = $_SESSION['email'];
$fullname = $_SESSION['fname'].' '.$_SESSION['lname'];
include 'mail.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List Management</title>
    <link rel="stylesheet" href="css/style.css">
</head>


<body>
    <div class="container">
        <h2>Todo List Management</h2>

        <?php
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "todomanager";

        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Todo functionalities
        if(isset($_POST['todo'])) {
            $todo = $_POST['todo'];
            $user_id = $_SESSION['id']; 
            addTodo($conn, $todo, $user_id);
            // $mail->addAddress($email,$fullname);   
            // $mail->Subject = 'Task Added';
            // $mail->Body    = 'You added a task to your todo list. Click here to view your tasks <a href="http://localhost/login-system/index.php">click here</a>';
            // $mail->send();
        }
       

        if(isset($_POST['todo_id'])) {
            $todo_id = $_POST['todo_id'];
            removeTodo($conn, $todo_id);
        }

        if(isset($_POST['update_id'])) {
            $todo_id = $_POST['update_id'];

        }


        function addTodo($conn, $todo, $user_id) {
            $date = date("Y-m-d");
            $time = date("H:i:s");
            $timestamp = strtotime($time);
            $formatted_time = date("H:i:s", $timestamp);
           
            $sql = "INSERT INTO `todos`( `todo`, `user_id`, `todo_date`, `todo_time`) VALUES ('$todo','$user_id','$date','$formatted_time')";
            if ($conn->query($sql) === TRUE) {
                echo "<p class='alert'>Todo added successfully </p>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        function removeTodo($conn, $todo_id) {
            $sql = "DELETE FROM todos WHERE todo_id='$todo_id'";
            if ($conn->query($sql) === TRUE) {
                echo "<p class='alert'>Todo removed successfully</p>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        ?>

        <form id="todo-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <h3>Add Todo</h3>
            <input type="text" name="todo" placeholder="Todo" required>
            <input type="submit" value="Add Todo">
        </form>

        <div id="todos">
            <?php
            // Fetch todos from database
            $readonly = true;
            $userid = $_SESSION['id'];
            $sql = "SELECT * FROM todos where user_id = '$userid'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {?>
                    <div class='todo-item'>
                        <input type='text' value=" <?php echo $row['todo'] ?> " readonly>
                    <div>
                        <P class="date"><?php if ($row['todo_date'] ==  date("Y-m-d")){
                            echo 'Today';
                        } else {
                            echo $row['todo_date'];
                        } ?></P>
                        <P class="date"><?php
                        $timestamp = strtotime($row['todo_time']);
                        $formatted_time = date("H:i:s", $timestamp);
                        echo $formatted_time
                         ?></P>

                    </div>
        </div>
                 <div class="flex">
                   
                    <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>' method='POST'>
                    <input type='hidden' name='todo_id' value='<?php echo $row['todo_id']?>'>
                    <button type='submit'>Remove</button>
                    </form>
                    <!-- <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>' method='POST'>
                    <input type='hidden' name='update_id' value='<?php echo $row['todo_id']?>'>
                    <button type='submit'>Update</button>
                    </form> -->
                </div>


               <?php }
            } else {
                echo "<h6 class='notodo'>No todos yet<h6>";
            }

            $conn->close();
            ?>
        </div>
        
    </div>

    
</body>


</html>
