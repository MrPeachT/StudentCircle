<div class="question-form-container">
  <h2 class="form-title">Contact Admin</h2>
  <form method="POST" class="question-form">
    <?php if (!isset($_SESSION['loggedin'])): ?>
      <div class="form-group">
        <label class="form-label" for="name">Your Name:</label>
        <input class="form-input" type="text" name="name" id="name" required>
      </div>
      <div class="form-group">
        <label class="form-label" for="gmail">Your Gmail:</label>
        <input class="form-input" type="email" name="gmail" id="gmail" required>
      </div>
    <?php else: ?>
      <div class="form-group">
        <p class="form-display"><strong>Name:</strong> <?= htmlspecialchars($_SESSION['username']) ?></p>
        <p class="form-display"><strong>Gmail:</strong> <?= htmlspecialchars($_SESSION['gmail']) ?></p>
      </div>
    <?php endif; ?>
    <div class="form-group">
      <label class="form-label" for="message">Message:</label>
      <textarea class="form-textarea" name="message" id="message" rows="6" required></textarea>
    </div>
    <div class="form-actions">
      <button type="submit" class="contact-button">Send Message</button>
    </div>
  </form>
</div>
