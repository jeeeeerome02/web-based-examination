<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Trimex CCS Login</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #fff;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }   
    .login-container {
        width: 300px;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    .login-container h2 {
        margin-bottom: 20px;
        text-align: center;
    }
    .login-container label {
        display: block;
        margin-bottom: 5px;
    }
    .login-container input[type="text"],
    .login-container input[type="password"],
    .login-container input[type="submit"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
        box-sizing: border-box;
    }
    .login-container input[type="submit"] {
        background-color: #EC4D37;
        color: #fff;
        border: none;
        cursor: pointer;
    }
    .login-container input[type="submit"]:hover { 
        background-color: #D04848;
    }
</style>
</head>
<body>
<div class="login-container">
    <h2>Login</h2>
    <form action="login.php" method="post">
        <label for="stud_id">Student ID:</label>
        <input type="text" id="stud_id" name="stud_id" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <input type="submit" value="Login" name="submit">
    </form>

    <?php
if(isset($_POST['submit'])){
    $stud_id = $_POST['stud_id'];
    $password = $_POST['password'];

    $conn = mysqli_connect("localhost", "root", "", "ccsdbcapstone");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $query = "SELECT * FROM login WHERE stud_id='$stud_id' AND password='$password'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $check_query = "SELECT * FROM dashboarduser WHERE stud_id='$stud_id'";
        $check_result = mysqli_query($conn, $check_query);
        if (mysqli_num_rows($check_result) > 0) {
            
            header("Location: dashboard.php");
            exit();
        } else {
            
            $insert_query = "INSERT INTO dashboarduser (stud_id) VALUES ('$stud_id')";
            if (mysqli_query($conn, $insert_query)) {
                header("Location: dashboard.php");
                exit();
            } else {
                echo "<p style='color:red;'>User error " . mysqli_error($conn) . "</p>";
            }
        }
    } else {
        echo "<p style='color:red;'>Invalid student ID or password!</p>";
    }
    mysqli_close($conn);
}
?>
</div>
</body>
</html>
