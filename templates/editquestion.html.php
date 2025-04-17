<form action="" method="post" enctype="multipart/form-data" class="question-form-container">
    <h2>Edit Question</h2>
    <div class="form-group">
        <label for="title">Post Title:</label>
        <input type="text" name="title" id="title" value="<?= isset($question) ? htmlspecialchars($question['title']) : '' ?>" required>
    </div>
    <div class="form-group">
        <label for="question_text">Question:</label>
        <textarea name="question_text" id="question_text" rows="5" required><?= isset($question) ? htmlspecialchars($question['question_text']) : '' ?></textarea>
    </div>
    <div class="form-group">
        <label for="module_id">Select Module:</label>
        <select name="module_id" id="module_id" required>
            <option value="">-- Choose a module --</option>
            <?php foreach ($modules as $module): ?>
                <option value="<?= $module['id'] ?>" <?= isset($question) && $question['module_id'] == $module['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($module['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="image">Upload Image (optional):</label>
        <input type="file" name="image" id="image" accept="image/*">
        <?php if (isset($question) && $question['image']): ?>
            <p>Current image: <strong><?= htmlspecialchars($question['image']) ?></strong></p>
        <?php endif; ?>
    </div>
    <div class="form-actions">
        <button type="submit" class="uni-button"><?= isset($question) ? 'Update Question' : 'Post Question' ?></button>
        <a href="../corefiles/home.php" class="cancel-button">Cancel</a>
    </div>
</form>
