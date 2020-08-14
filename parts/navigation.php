<?php
    // This file is used across the entire site so we don't have to copy code across multiple php files.
?>

<nav>
    <ul>
        <li class="<?php if ($page == "Home") echo 'active'; ?>">
            <a href="index.php">Home</a>
        </li>
        <li class="<?php if ($page == "Practice") echo 'active'; ?>">
            <a href="practice.php">Practice</a>
        </li>
        <li class="<?php if ($page == "Test 1") echo 'active'; ?>">
            <a href="test1.php">Test 1</a>
        </li>
        <li class="<?php if ($page == "Test 2") echo 'active'; ?>">
            <a href="test2.php">Test 2</a>
        </li>
        <li class="<?php if ($page == "Questionaire") echo 'active'; ?>">
            <a href="questionaire.php">Questionaire</a>
        </li>
    </ul>
</nav>