<h2>Manage Users</h2>
<?php if (!empty($error)): ?>
  <p style="color:red; font-weight:600;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<?php if (!isset($_GET['add']) || $_GET['add'] !== 'new'): ?>
  <a href="users.php?add=new" class="question-post-button">Add New User</a>
<?php endif; ?>
<?php if (isset($_GET['add']) && $_GET['add'] === 'new'): ?>
  <div class="question-form-container">
    <?php if (!empty($error)): ?>
      <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <?php include '../templates/adduser.html.php'; ?>
  </div>
<?php endif; ?>
<br />
<?php if (empty($users)): ?>
    <p>No users found.</p>
<?php else: ?>
    <div class="user-list">
        <?php foreach ($users as $user): ?>
            <div class="user-card">
                <p><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></p>
                <p><strong>Gmail:</strong> <?= htmlspecialchars($user['gmail']) ?></p>
                <br />
                <div class="user-actions">
                    <a href="edituser.php?id=<?= $user['id'] ?>" class="edit-button">Edit</a>

                    <?php if ($user['role'] !== 'admin'): ?>
                        <form action="deleteuser.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $user['id'] ?>">
                            <button type="submit" class="delete-button">Delete</button>
                        </form>
                    <?php else: ?>
                        <span style="color: gray; font-weight: bold;">Admin</span>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
