<?php
if(isset($_GET['indexLink'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

?>
<nav id="navContent">
    <ul>
        <li><a href="index.php?indexLink" >PLAY AGAIN</a></li>
        <li><a href="HighScore.php">HIGH SCORE</a></li>
    </ul>
</nav>
