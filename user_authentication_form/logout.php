<?php
session_start();
include 'db_connection.php';
//echo"<pre>";print_r($_SESSION);echo"</pre>";exit;
if (isset($_SESSION['user_id'])) {
    $query = $conn->prepare("UPDATE users SET remember_me = NULL WHERE id = ?");
    $query->bind_param("i", $_SESSION['user_id']);
    $query->execute();
}

$_SESSION = [];
session_destroy();

setcookie("remember_me", "", time() - 3600, "/");

header("Location: login.php");
exit;
?>
