<form action="users.php?add=new" method="post" class="question-form">
    <h2>Add New User</h2>
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
    </div>
    <div class="form-group">
        <label for="gmail">Gmail:</label>
        <input type="email" name="gmail" id="gmail" required>
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
    </div>
    <div class="form-actions">
        <button type="submit" class="uni-button">Add User</button>
        <a href="users.php" class="cancel-button">Cancel</a>
    </div>
</form>
