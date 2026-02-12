<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

$adminName = $_SESSION['admin_username'] ?? 'Admin';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard | Voyago</title>
  <link rel="stylesheet" href="../style.css">
</head>
<body class="admin-body">
  <main class="admin-login">
    <div class="admin-card">
      <h1>Welcome, <?php echo htmlspecialchars($adminName, ENT_QUOTES, 'UTF-8'); ?>!</h1>
      <p class="admin-subtitle">You're signed in. Use the navigation to manage content.</p>
      <div class="admin-actions">
        <a class="btn" href="../index.php">View Site</a>
        <a class="btn btn-outline" href="logout.php">Log Out</a>
      </div>
    </div>
  </main>
</body>
</html>
