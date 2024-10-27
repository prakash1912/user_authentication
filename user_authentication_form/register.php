<?php
    session_start();
    include 'db_connection.php';

    //echo"<pre>";print_r($_POST);echo"</pre>";exit;

    /*$user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    //$confirm_password = $_POST['confirm_password'];*/

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
       
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token'])
        {
            $_SESSION['error_message'] = "";
            header("Location: user_register_form.php");
            exit;
        }

        unset($_SESSION['csrf_token']);
    
        
        // Sanitize input
        $username = mysqli_real_escape_string($conn, $_POST['user_name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if ($password !== $confirm_password) {
            $_SESSION['error'] = "Passwords did not match.";
            header("Location: user_register_form.php");
            exit;
        }

        //Strong password
        $rules = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
        if (!preg_match($rules, $password)) {
            $_SESSION['error_message'] = "* Password must be at least 8 characters long \n* Include at least one uppercase letter \n* One lowercase letter, one number, and one special character.";
        header("Location: user_register_form.php");
        exit;
        }
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        $data = mysqli_query($conn, "SELECT id FROM users WHERE user_name='$username' OR email='$email'");
        if (mysqli_num_rows($data) > 0) {
            $_SESSION['error_message'] = "Username or email already exists";
            header("Location: user_register_form.php");
            exit;
        }

        $query = $conn->prepare("INSERT INTO users (user_name, email, password) VALUES (?, ?, ?)");
        $query->bind_param("sss", $username, $email, $hashedPassword);

        if ($query->execute()) {
            $_SESSION['user_id'] = $conn->insert_id;
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit;
        } else {
            $_SESSION['error_message'] = "Error: " . $conn->error;
            header("Location: user_register_form.php");
            exit;
        }

        $query->close();
        $conn->close();
    }
?>
