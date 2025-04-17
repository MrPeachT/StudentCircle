<form action="../modulemanagement/addmodule.php" method="post" class="question-form-container">
    <h2>Add New Module</h2>
    <div class="form-group">
        <label for="name">Module Name:</label>
        <input type="text" name="name" id="name" value="<?= htmlspecialchars($name ?? '') ?>" required>
    </div>
    <?php if (!empty($error)): ?>
        <p style="color:red; font-weight:bold;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <div class="form-actions">
        <button type="submit" class="uni-button"><?= isset($module) ? 'Update Module' : 'Add Module' ?></button>
        <a href="modules.php" class="cancel-button">Cancel</a>
    </div>
</form>