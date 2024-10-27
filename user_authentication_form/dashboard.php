<?php
    session_start();
    include 'db_connection.php';
    //echo"<pre>";print_r($_SESSION);echo"</pre>";exit;

    if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_me'])) {
            $token = $_COOKIE['remember_me'];

            $query = $conn->prepare("SELECT * FROM users WHERE remember_me = ?");
            $query->bind_param("s", $token);
            $query->execute();
            $result = $query->get_result();

            if ($result->num_rows > 0) {
                $user_data = $result->fetch_assoc();
                $_SESSION['user_id'] = $user_data['id'];
                $_SESSION['username'] = $user_data['user_name'];
            }
            $query->close();
    }

    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }

    $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'User';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/css/logout.css">
</head>
<body>
    <h1>Welcome to PEOPLE ONE Technologies</h1>
    <h2>Hello, <?php echo htmlspecialchars($username); ?>!</h2>
    <form action="logout.php" method="POST">
        <button type="submit" class="logout-button">Logout</button>
    </form>    
</body>
</html>
