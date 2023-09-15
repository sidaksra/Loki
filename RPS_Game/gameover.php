<?php
session_start();

$username = $_POST['username'] ?? null;
$wins = $_SESSION['wins'];

$errors = array(); //declariing an empty array to add errors in it

if (isset($_POST['submit'])){

    include 'includes/library.php';
   //Making a database connection
   $pdo = connectDB();

    if(!isset($username) || strlen($username) === 0){
        $errors['username'] = true;
    }
    if(count($errors)===0){
        $queryInsert = "INSERT INTO High_ScoreTable VALUES (?,?)";
        $stmtInsert = $pdo->prepare($queryInsert);
        $stmtInsert->execute([$username, $wins]);
        header("Location: HighScore.php");
        session_destroy();
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en"> 
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Game Over Page</title>
        <link rel="stylesheet" href="styles/master.css" />
    </head>
    <body>
        <?php include "includes/header.php";?>
        <main>
            <section>
                <form id="Gameover" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" >
                <div>
                    <p> GAME OVER </p>
                </div>
                <div>
                    <p>Your Total Game Score: <?php echo $_SESSION['wins']; ?></p>
                </div>
                <div>
                    <p>Please enter your name to submit your score on High Score Table</p>
                </div>
                <div>
                    <label for="username">Player Name:</label> 
                    <input type="text" id="username" name="username" size="40" value="<?php echo $username?>" />
                    <span class="error <?=!isset($errors['username']) ? 'hidden' : "";?>"><p>You will need to enter your name in order to move or see your score on high score table</p></span>
                </div>
                <!-- submit  button -->
                <div id="button">
                    <button type="submit" name="submit">SUBMIT YOUR SCORE</button>
                </div>
                </form>
            </section>
        </main>
        <?php include "includes/footer.php";?>
    </body>
</html>
