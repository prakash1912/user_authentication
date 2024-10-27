<?php
    session_start();
    include 'db_connection.php';
    //echo"<pre>";print_r($_SESSION);echo"</pre>";exit;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            $_SESSION['error_message'] = "";
            header("Location: login.php");
            exit;
        }
    
        unset($_SESSION['csrf_token']);

        $username = mysqli_real_escape_string($conn, $_POST['user_name']);
        $password = $_POST['password'];
        $remember_me = isset($_POST['remember_me']);
    
        $query = $conn->prepare("SELECT * FROM users WHERE user_name = ? OR email = ?");
        $query->bind_param("ss", $username, $username);
        $query->execute();
        $query_result = $query->get_result();

    //echo"<pre>";print_r($query_result);echo"</pre>";
    //exit; 

        if ($query_result->num_rows === 0) {
            $_SESSION['error_message'] = "Invalid username or email.";
            header("Location: login.php");
            exit;
        }

        $user_data = $query_result->fetch_assoc();
        if (!password_verify($password, $user_data['password'])) {
            $_SESSION['error_message'] = "Invalid password.";
            header("Location: login.php");
            exit;
        }

        //echo"<pre>";print_r($_SESSION);echo"</pre>";
        //exit;
        $_SESSION['user_id'] = $user_data['id'];
        $_SESSION['username'] = $user_data['user_name'];

        if (isset($_POST['remember_me']))
         {
            $token = bin2hex(random_bytes(16));
            setcookie("remember_me", $token, time() + (86400 * 30), "/");
            
            $update_query = $conn->prepare("UPDATE users SET remember_me = ? WHERE id = ?");
            $update_query->bind_param("si", $token, $user_data['id']);
            $update_query->execute();
            $update_query->close();
        }

        //echo "Login successful";
        header("Location: dashboard.php");
        exit;

    }
    //$query->close();
    $conn->close();

?>