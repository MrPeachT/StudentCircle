<?php

function getAllUsers($pdo) {
    $stmt = $pdo->query('SELECT * FROM users');
    return $stmt->fetchAll();
}

function getUserById($pdo, $id) {
    $stmt = $pdo->prepare('SELECT * FROM users WHERE id = :id');
    $stmt->execute(['id' => $id]);
    return $stmt->fetch();
}

function addUser($pdo, $username, $gmail) {
    $stmt = $pdo->prepare('INSERT INTO users (username, gmail) VALUES (:username, :gmail)');
    $stmt->execute(['username' => $username, 'gmail' => $gmail]);
}

function updateUser($pdo, $id, $username, $gmail, $password = null, $role = null) {
    $params = ['username' => $username, 'gmail' => $gmail, 'id' => $id];
    $sql = 'UPDATE users SET username = :username, gmail = :gmail';

    if (!empty($password)) {
        $sql .= ', password = :password';
        $params['password'] = password_hash($password, PASSWORD_DEFAULT);
    }

    if (!empty($role)) {
        $sql .= ', role = :role';
        $params['role'] = $role;
    }

    $sql .= ' WHERE id = :id';

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
}

function deleteUser($pdo, $id) {
    $stmt = $pdo->prepare('DELETE FROM users WHERE id = :id');
    $stmt->execute(['id' => $id]);
}

function getAllModules($pdo) {
    $stmt = $pdo->query('SELECT * FROM modules');
    return $stmt->fetchAll();
}

function getModuleById($pdo, $id) {
    $stmt = $pdo->prepare('SELECT * FROM modules WHERE id = :id');
    $stmt->execute(['id' => $id]);
    return $stmt->fetch();
}

function addModule($pdo, $name) {
    $stmt = $pdo->prepare('INSERT INTO modules (name) VALUES (:name)');
    $stmt->execute(['name' => $name]);
}

function updateModule($pdo, $id, $name) {
    $stmt = $pdo->prepare('UPDATE modules SET name = :name WHERE id = :id');
    $stmt->execute(['name' => $name, 'id' => $id]);
}

function deleteModule($pdo, $id) {
    $stmt = $pdo->prepare('DELETE FROM modules WHERE id = :id');
    $stmt->execute(['id' => $id]);
}

function getAllQuestions($pdo) {
    $stmt = $pdo->query('
        SELECT q.*, u.username AS author, m.name AS module
        FROM questions q
        JOIN users u ON q.user_id = u.id
        JOIN modules m ON q.module_id = m.id
        ORDER BY q.question_date DESC
    ');
    return $stmt->fetchAll();
}

function getQuestionById(PDO $pdo, int $id): ?array {
    $stmt = $pdo->prepare('
        SELECT q.*, u.username AS author
        FROM questions q
        JOIN users u ON q.user_id = u.id
        WHERE q.id = :id
    ');
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
}

function addQuestion($pdo, $title, $question_text, $image, $user_id, $module_id) {
    $stmt = $pdo->prepare('
        INSERT INTO questions (title, question_text, image, user_id, module_id)
        VALUES (:title, :question_text, :image, :user_id, :module_id)
    ');
    $stmt->execute([
        'title' => $title,
        'question_text' => $question_text,
        'image' => $image,
        'user_id' => $user_id,
        'module_id' => $module_id
    ]);
}

function updateQuestion($pdo, $id, $title, $question_text, $image, $user_id, $module_id) {
    $stmt = $pdo->prepare('
        UPDATE questions 
        SET title = :title, question_text = :question_text, image = :image, user_id = :user_id, module_id = :module_id, question_date = NOW()
        WHERE id = :id
    ');
    $stmt->execute([
        'title' => $title,
        'question_text' => $question_text,
        'image' => $image,
        'user_id' => $user_id,
        'module_id' => $module_id,
        'id' => $id
    ]);
}

function deleteQuestion($pdo, $id) {
    $stmt = $pdo->prepare('DELETE FROM questions WHERE id = :id');
    $stmt->execute(['id' => $id]);
}

function getUserByGmail(PDO $pdo, string $gmail): ?array {
    $stmt = $pdo->prepare('SELECT * FROM users WHERE gmail = :gmail');
    $stmt->execute(['gmail' => $gmail]);
    return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
}

function gmailExists(PDO $pdo, string $gmail): bool {
    return getUserByGmail($pdo, $gmail) !== null;
}

function createUser(PDO $pdo, string $username, string $gmail, string $password, string $role): void {
    $stmt = $pdo->prepare('INSERT INTO users (username, gmail, password, role) VALUES (:username, :gmail, :password, :role)');
    $stmt->execute([
        'username' => $username,
        'gmail' => $gmail,
        'password' => $password,
        'role' => $role
    ]);
}

function updateUsername(PDO $pdo, string $gmail, string $newUsername): void {
    $stmt = $pdo->prepare('UPDATE users SET username = :username WHERE gmail = :gmail');
    $stmt->execute([
        'username' => $newUsername,
        'gmail' => $gmail
    ]);
}

function updatePassword(PDO $pdo, string $gmail, string $newHashedPassword): void {
    $stmt = $pdo->prepare('UPDATE users SET password = :password WHERE gmail = :gmail');
    $stmt->execute([
        'password' => $newHashedPassword,
        'gmail' => $gmail
    ]);
}

function getAllModulesOrdered(PDO $pdo): array {
    $stmt = $pdo->query('SELECT * FROM modules ORDER BY name ASC');
    return $stmt->fetchAll();
}

function moduleNameExists(PDO $pdo, string $name): bool {
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM modules WHERE LOWER(name) = LOWER(:name)');
    $stmt->execute(['name' => $name]);
    return $stmt->fetchColumn() > 0;
}

?>