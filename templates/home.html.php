<?php if ($showAddForm): ?>
    <?php include 'addquestion.html.php'; ?>
<?php else: ?>
    <a href="home.php?post=new" class="question-post-button">Post your question...</a>
<?php endif; ?>
<h2>New Feeds:</h2>
<?php include 'questions.html.php'; ?>
