<?php
session_start();
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $flux = new Flux(FLUX_APP_ID);
        $flux->authenticate($_POST['license_key']);
        $_SESSION['authenticated'] = true;
        $_SESSION['license_key'] = $_POST['license_key'];
        header("Location: dashboard.php");
        exit();
    } catch (Exception $e) {
        $error = "Authentication failed: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Flux Auth</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-container">
        <h1 class="gradient-text">Fentware Public</h1>
        <form method="post">
            <input type="text" name="license_key" placeholder="Enter License Key" required>
            <button type="submit">Login</button>
        </form>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    </div>
    <script src="animations.js"></script>
</body>
</html>
