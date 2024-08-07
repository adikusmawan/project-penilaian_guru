<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Sanitize inputs to prevent SQL injection
    $username = stripslashes($username);
    $password = stripslashes($password);
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Query to check username and password
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch user data
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];

        // Redirect to a different page based on user role
        if ($row['role'] == 'admin') {
            header("Location: admin/index.php");
        } else {
            header("Location: admin/index.php");
        }
    } else if (empty ($username) && empty ($password)){
    
    exit();
  }
  else if(empty ($username)){
    header ("Location: index.php?Err=2");
    exit();
  }
  else if(empty ($password)){
    header ("Location: index.php?Err=3");
    exit();
  }
  else{
    header ("Location: index.php?Err=5");
    exit();
  }
}
  
?>

  