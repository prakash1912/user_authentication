<?php
    session_start();
    $error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : '';
    unset($_SESSION['error_message']);

    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    $csrf_token = $_SESSION['csrf_token'];
    //echo"<pre>";print_r($_SESSION);echo"</pre>";exit;

    $error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
    unset($_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Register Form</title> 
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
    <body>
        
        <div class="form-container">
            <h2 class="form-title">Registration Form</h2>

            <form action="register.php" method="post">

                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">

                <label class="form-label" for="username">Username:</label>
                <input class="form-input" type="text" id="user_name" name="user_name" placeholder="Username" required>
                
                <label class="form-label" for="email">Email:</label>
                <input class="form-input" type="email" id="email" name="email" placeholder="Email" required>
                
                <label class="form-label" for="password">Password:</label>
                <?php if (!empty($error_message)): ?>
                    <div class="error-message"><?php echo nl2br(htmlspecialchars($error_message)); ?></div>
                <?php endif; ?>

                <input class="form-input" type="password" id="password" name="password" placeholder="Password" required>
                
                <label class="form-label" for="confirm_password">Confirm Password:</label>
                <?php if ($error): ?>
                    <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
                <?php endif; ?>

                <input class="form-input" type="password" id="confirm_password" name="confirm_password"  placeholder="Confirm Password" required>

                <button class="form-button" type="submit">Register</button>
            </form>
            <div class="login-link">
                <p>Already a user? <a href="login.php">Login here</a></p>
            </div> 
        </div>
    </body>
</html>

