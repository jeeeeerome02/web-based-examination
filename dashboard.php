<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
     body {
    font-family: Arial, sans-serif; 
}
   .navbar-container {
    margin-bottom: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
}
    .content-container {
        padding: 20px;
    }
    .data-container {
        background-color: #f8f9fa;
        border-radius: 20px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    .data-container h2 {
        font-size: 24px;
        font-weight: normal;
        margin-bottom: 10px;
    }
    .data-container p {
        margin-bottom: 5px;
    }
    .bg-custom {
        background-color: #EC4D37 !important;
    }
    .navbar-light .navbar-nav .nav-link {
        color: white !important; 
    }
    .navbar-light .navbar-brand {
    color: white !important;
}

</style>
</head>
<body>
<div class="navbar-container">
    <div class="navbar navbar-expand-lg navbar-light bg-custom">
        <a class="navbar-brand" href="#">Student Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">QUIZZES</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">EVALUATION</a>
                </li>
                <li class="nav-item active">
                    <div class="dropdown d-flex align-items-center">
                        <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php
                            $conn = mysqli_connect("localhost", "root", "", "ccsdbcapstone");
                            if (!$conn) {
                                die("Connection failed: " . mysqli_connect_error());
                            }

                            $query = "SELECT * FROM dashboarduser LIMIT 1";
                            $result = mysqli_query($conn, $query);
                            if (mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);
                                echo $row['stud_id'];
                            } else {
                                echo "User error";
                            }

                            mysqli_close($conn);
                            ?>
                        </a>
                        <img src="images/avatar.png" alt="Avatar" style="height: 40px; width: 40px; border-radius: 50%; margin-left: 5px;">
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="logout.php">Logout</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="content-container">
    <?php
    $conn = mysqli_connect("localhost", "root", "", "ccsdbcapstone");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "SELECT * FROM student_data INNER JOIN dashboarduser ON student_data.stud_id = dashboarduser.stud_id LIMIT 1";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo "<h5>My Account</h5>";
        echo "<div class='data-container'>";
        echo "<p>Name: " . $row['firstname'] . " " . $row['lastname'] . "</p>";
        echo "<p>Student ID: " . $row['stud_id'] . "</p>";
        echo "<p>Age: " . $row['age'] . "</p>";
        echo "<p>Section: " . $row['section'] . "</p>";
        echo "<p>Address: " . $row['address'] . "</p>";
        echo "</div>";
    } else {
        echo "<p>No user data found.</p>";
    }

    mysqli_close($conn);
    ?>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
