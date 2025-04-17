<form action="" method="post" class="question-form-container">
    <h2>Edit Module</h2>
    <div class="form-group">
        <label for="name">Module Name:</label>
        <input type="text" name="name" id="name" value="<?= isset($module) ? htmlspecialchars($module['name']) : '' ?>" required>
    </div>
    <div class="form-actions">
        <button type="submit" class="uni-button"><?= isset($module) ? 'Update Module' : 'Add Module' ?></button>
        <a href="modules.php" class="cancel-button">Cancel</a>
    </div>
</form>
