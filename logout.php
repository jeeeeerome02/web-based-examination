<?php
$conn = mysqli_connect("localhost", "root", "", "ccsdbcapstone");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$query = "DELETE FROM dashboarduser";
if (mysqli_query($conn, $query)) {

    header("Location: login.php");
    exit();
} else {
    echo "User error " . mysqli_error($conn);
}

mysqli_close($conn);
?>
