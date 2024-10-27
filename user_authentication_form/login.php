<?php
    session_start();

    // error message
    $error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : '';
    unset($_SESSION['error_message']);

    // CSRF token
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    $csrf_token = $_SESSION['csrf_token'];
    //echo"<pre>";print_r($_SESSION);echo"</pre>";exit;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/css/login.css">
        <title>Login</title>
    </head>
    <body>
        <h1>Login Form</h1>
        
        <form action="user_login.php" method="post">
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">

            <label>Username:</label>
            <input type="text" name="user_name" placeholder="Username" required>
            <br><br>
            <label>Password:</label>
            <!-- Display error message -->
            <?php if (!empty($error_message)): ?>
                <div class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
            <?php endif; ?>
            <input type="password" name="password" placeholder="Password" required>
            <br>
           
            <label class="form-label" for="remember_me">
                <input type="checkbox" name="remember_me" id="remember_me"> Remember Me
            </label>

            <button type="submit">Login</button>
        </form>

        <div class="register-link">
            <p>New User? <a href="user_register_form.php">Register here</a></p>
        </div>
    </body>
</html>
