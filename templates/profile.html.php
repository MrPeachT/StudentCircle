<div class="question-form-container">
  <h2>Edit Profile</h2>

  <?php if ($error): ?>
    <p style="color:red; font-weight: 600;">
      <?= htmlspecialchars($error) ?>
    </p>
  <?php endif; ?>
  <?php if ($success): ?>
    <p style="color:green; font-weight: 600;">
      <?= htmlspecialchars($success) ?>
    </p>
  <?php endif; ?>

  <form method="post" class="question-form">
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" name="username" id="username" value="<?= htmlspecialchars($_SESSION['username']) ?>" required>
    </div>

    <div class="form-group">
      <label for="current_password">Current Password:</label>
      <input type="password" name="current_password" id="current_password" required>
    </div>

    <div class="form-group">
      <label for="new_password">New Password <small>(optional)</small>:</label>
      <input type="password" name="new_password" id="new_password">
    </div>

    <div class="form-actions">
      <button type="submit" name="saveChanges" class="edit-button">Save Changes</button>
    </div>
  </form>

  <br />
  <form method="post" action="logout.php">
    <button type="submit" name="logout" class="logout-button">Logout</button>
  </form>
</div>
