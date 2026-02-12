<?php
session_start();
require __DIR__ . '/../includes/config.php';

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

if (isset($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = 'Please enter both username and password.';
    } else {
        $statement = $pdo->prepare('SELECT id, username, password FROM admins WHERE username = :username LIMIT 1');
        $statement->execute(['username' => $username]);
        $admin = $statement->fetch();

        if ($admin && password_verify($password, $admin['password'])) {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_username'] = $admin['username'];
            header('Location: index.php');
            exit;
        }

        $error = 'Invalid username or password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login | Voyago</title>
  <link rel="stylesheet" href="../style.css">
</head>
<body class="admin-body">
  <main class="admin-login">
    <div class="admin-card">
      <h1>Admin Login</h1>
      <p class="admin-subtitle">Sign in to manage tours and bookings.</p>

      <?php if ($error): ?>
        <div class="alert alert-error"><?php echo e($error); ?></div>
      <?php endif; ?>

      <form method="post" class="admin-form">
        <label>
          Username
          <input type="text" name="username" value="<?php echo e($_POST['username'] ?? ''); ?>" required>
        </label>
        <label>
          Password
          <input type="password" name="password" required>
        </label>
        <button class="btn" type="submit">Log In</button>
      </form>
    </div>
  </main>
</body>
</html>
