<h2>Manage Modules</h2>

<?php if ($showAddModuleForm): ?>
    <?php include 'addmodule.html.php'; ?>
<?php else: ?>
    <a href="modules.php?action=add" class="question-post-button">Add New Module</a>
<?php endif; ?>
<br />
<?php if (!empty($error)): ?>
    <p style="color:red;"><?= $error ?></p>
<?php endif; ?>

<?php if (empty($modules)): ?>
    <p>No modules found.</p>
<?php else: ?>
    <div class="module-list">
        <?php foreach ($modules as $module): ?>
            <div class="module-card">
                <p><strong>Module Name:</strong> <?= htmlspecialchars($module['name']) ?></p>
                <br />
                <div class="module-actions">
                    <a href="editmodule.php?id=<?= $module['id'] ?>" class="edit-button">Edit</a>
                    <form action="deletemodule.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this module?');" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $module['id'] ?>">
                        <button type="submit" class="delete-button">Delete</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
