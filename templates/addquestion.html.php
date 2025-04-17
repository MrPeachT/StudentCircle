<form action="../postmanagement/addquestion.php" method="post" enctype="multipart/form-data" class="question-form-container">
    <h2>Add a New Question</h2>
    <?php if (!empty($error)): ?>
        <p style="color: red; font-weight: bold;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <div class="form-group">
        <label for="title">Post Title:</label>
        <input type="text" name="title" id="title" required>
    </div>
    <div class="form-group">
        <label for="question_text">Question:</label>
        <textarea name="question_text" id="question_text" rows="5" required></textarea>
    </div>
    <div class="form-group">
        <label for="module_id">Select Module:</label>
        <select name="module_id" id="module_id" required>
            <option value="">-- Choose a module --</option>
            <?php foreach ($modules as $module): ?>
                <option value="<?=$module['id'] ?>"><?= htmlspecialchars($module['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="image">Upload Image (optional):</label>
        <input type="file" name="image" id="image" accept="image/*">
    </div>
    <br />
    <div class="form-actions">
        <button type="submit" class="uni-button">Post Question</button>
        <a href="../corefiles/home.php" class="cancel-button">Cancel</a>
    </div>
</form>