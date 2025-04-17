<h2><?= isset($user) ? 'Edit User' : 'Add New User' ?></h2>

<form action="" method="post" class="question-form-container">
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username"
               value="<?= isset($user) ? htmlspecialchars($user['username']) : '' ?>" required>
    </div>

    <div class="form-group">
        <label for="gmail">Gmail:</label>
        <input type="email" name="gmail" id="gmail"
            pattern="^[^@]+@gmail\.com$"
            title="Gmail must end with @gmail.com"
            value="<?= isset($user) ? htmlspecialchars($user['gmail']) : '' ?>" required>
    </div>

    <div class="form-group">
        <label for="password">
            Password: <?= isset($user) ? '<small>(Leave blank to keep current password)</small>' : '' ?>
        </label>
        <input type="password" name="password" id="password" <?= isset($user) ? '' : 'required' ?>>
    </div>

    <?php if (isset($user)): ?>
    <div class="form-group">
        <label for="role">Role:</label>
        <select name="role" id="role">
            <option value="student" <?= $user['role'] === 'student' ? 'selected' : '' ?>>Student</option>
            <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
        </select>
    </div>
    <?php endif; ?>
    <div class="form-actions">
        <button type="submit" class="uni-button"><?= isset($user) ? 'Update User' : 'Add User' ?></button>
        <a href="users.php" class="cancel-button">Cancel</a>
    </div>
</form>
