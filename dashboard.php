<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['authenticated'])) {
    header("Location: index.php");
    exit();
}

$flux = new Flux(FLUX_APP_ID);

try {
    $username = $flux->get_field("username");
    $subscription = $flux->get_field("subscription");
} catch (Exception $e) {
    $error = "Error retrieving user details: " . $e->getMessage();
}

if (isset($_POST['download'])) {
    try {
        $fileContent = $flux->download_variable("fortnite_product");
        file_put_contents("Fortnite_Product.zip", $fileContent);
        $downloadSuccess = "Download started!";
    } catch (Exception $e) {
        $downloadError = "Download failed: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Flux Auth</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="dashboard-container">
        <h1 class="gradient-text">Fentware Public</h1>
        <p>Welcome, <?php echo htmlspecialchars($username); ?>!</p>
        <p>Subscription: <?php echo htmlspecialchars($subscription); ?></p>
        <h2>Fortnite Product</h2>
        <form method="post">
            <button type="submit" name="download">Download</button>
        </form>
        <?php if (isset($downloadSuccess)) echo "<p class='success'>$downloadSuccess</p>"; ?>
        <?php if (isset($downloadError)) echo "<p class='error'>$downloadError</p>"; ?>
        <a href="logout.php" class="logout">Logout</a>
    </div>
    <script src="animations.js"></script>
</body>
</html>
