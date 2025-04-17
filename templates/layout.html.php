<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>StudentCircle</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <?php include '../templates/header.html.php'; ?>

  <div class="container">
    <nav>
      <a href="../corefiles/home.php">Home</a>

      <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
        <a href="../usermanagement/users.php">Manage Users</a>
        <a href="../modulemanagement/modules.php">Manage Modules</a>
      <?php endif; ?>

      <?php if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin'): ?>
        <a href="../contactform/contact.php">Contact Admin</a>
      <?php endif; ?>

      <?php if (isset($_SESSION['loggedin'])): ?>
        <a href="../corefiles/profile.php">Profile</a>
      <?php else: ?>
        <a href="../corefiles/login.php">Login</a>
      <?php endif; ?>
    </nav>

    <main>
      <?= $output ?>
    </main>
  </div>

  <?php include '../templates/footer.html.php'; ?>
</body>
</html>
