<?php if (empty($questions)): ?>
  <p>No questions have been posted yet.</p>
<?php else: ?>
  <div class="question-list">
    <?php foreach ($questions as $question): ?>
      <div class="question-card">
        <div class="question-content">
          <h3 class="question-title"><?= htmlspecialchars($question['title']) ?></h3>
          <p class="question-text"><?= nl2br(htmlspecialchars($question['question_text'])) ?></p>
          <p class="question-meta">
            Posted by <strong><?= htmlspecialchars($question['author']) ?></strong>
            in <em><?= htmlspecialchars($question['module']) ?></em>
            on <?= date('Y-m-d H:i:s', strtotime($question['question_date'])) ?>
          </p>

          <?php if (!empty($question['image'])): ?>
            <div class="question-image-wrapper">
              <img src="../uploads/<?= htmlspecialchars($question['image']) ?>" alt="Question Image" class="question-image">
            </div>
          <?php endif; ?>

          <?php
            $isAuthor = isset($_SESSION['username']) && $_SESSION['username'] === $question['author'];
            $isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
          ?>

          <?php if ($isAuthor || $isAdmin): ?>
            <div class="question-actions">
              <form action="../postmanagement/editquestion.php" method="GET" style="display:inline;">
                <input type="hidden" name="id" value="<?= $question['id'] ?>">
                <button type="submit" class="edit-button">Edit</button>
              </form>
              <form action="../postmanagement/deletequestion.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this question?');" style="display:inline;">
                <input type="hidden" name="id" value="<?= $question['id'] ?>">
                <button type="submit" class="delete-button">Delete</button>
              </form>
            </div>
          <?php endif; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
