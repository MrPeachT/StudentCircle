<div class="question-form-container">
  <h2>Register</h2>

  <?php if ($error): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
  <?php endif; ?>

  <form method="post" class="question-form">
    <div class="form-group">
      <label>Username:</label>
      <input type="text" name="username" required>
    </div>

    <div class="form-group">
      <label>Gmail:</label>
      <input type="email" name="gmail" pattern="^[a-zA-Z0-9._%+-]+@gmail\.com$" required>
    </div>

    <div class="form-group">
      <label>Password:</label>
      <input type="password" name="password" required>
    </div>
    <p>
    Already have an account? <a href="login.php">Login here</a>
    </p>
    <div class="form-actions">
      <button type="submit" class="edit-button">Register</button>
    </div>
  </form>


</div>
