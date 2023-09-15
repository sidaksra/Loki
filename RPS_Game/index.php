<?php
session_start();

//get  from post or set to NULL if doesn't exist
$choice = $_POST['choice'] ?? null;
$errors = array(); 
$print = array();
$string = $_POST['string'] ?? null;

if (!isset($_SESSION['wins']) && !isset($_SESSION['lose']) && !isset($_SESSION['gamecount'])) {
    $_SESSION['wins'] = 0; 
    $_SESSION['lose'] = 0;
    $_SESSION['gamecount'] = 0; 
}

if($_SESSION['lose'] === 4){
    header("Location: gameover.php");
    exit();
}

if (isset($_POST['submit'])) { 
    if(!empty($choice)) {
        $_SESSION['gamecount']++;
        $computerChoice= array('Rock', 'Paper', 'Scissors');
        $Choicerand= rand(0,2);
        $computer=$computerChoice[$Choicerand];
        if($choice == $computer) {
            $print['draw'] = true;
        } 
        else if($choice == 'Rock' && $computer == 'Paper')
        {
            $print['lose'] = true;
            $_SESSION['lose']++;
            
 
        }
        else if($choice == 'Rock' && $computer == 'Scissors') {
            $print['wins'] = true;
            $_SESSION['wins']++;
            

        }
        else if($choice == 'Paper' && $computer == 'Scissors') {
            $print['lose'] = true;
            $_SESSION['lose']++;
            

        }
        else if($choice == 'Paper' && $computer == 'Rock') {
            $print['wins'] = true;
            $_SESSION['wins']++;
        

        }
        else if($choice == 'Scissors' && $computer == 'Rock') {
            $print['lose'] = true;
            $_SESSION['lose']++;
            
        }
        else if($choice == 'Scissors' && $computer == 'Paper') {
            $print['wins'] = true;
            $_SESSION['wins']++; 
        
        }

    }
    else{
        $errors['choice'] = true;
    }

}
if(isset($_POST['submitFeedback'])){
        if(!empty($_POST['string'])){                      
            $print['string'] = true;
        }
        else{
            $errors['string'] = true;
    }
}

?>

<!DOCTYPE html>
<html lang="en"> 
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Question 2: Game Page</title>
        <script src="https://kit.fontawesome.com/170f096220.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="styles/master.css" />
    </head>
    <body>
        <?php include "includes/header.php";?>
        <main>
            <section>
                <form id="GameForm" name="Game" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" >
                    <div>
                        <p>Game Number: <?php echo $_SESSION['gamecount']; ?></p>
                    </div>
                    <div class = "number_W_L">
                        <p>Wins: <?php echo $_SESSION['wins']; ?></p>
                    </div>
                    <div class = "number_W_L">
                        <p>Lose: <?php echo $_SESSION['lose']; ?></p>
                    </div>
                    <div>
                        <span class="printout <?=!isset($print['wins']) ? 'hidden' : "";?>"><?php echo 'You Choosed: '.$choice.' | Computer Choosed: '.$computer.' || Result: Won'; ?></span>
                        <span class="printout <?=!isset($print['draw']) ? 'hidden' : "";?>"><?php echo 'You Choosed: '.$choice.' | Computer Choosed: '.$computer.' || Result: Draw'; ?></span>
                        <span class="printout <?=!isset($print['lose']) ? 'hidden' : "";?>"><?php echo 'You Choosed: '.$choice.' | Computer Choosed: '.$computer.' || Result: Lose'; ?></span>
                    </div>
                    <fieldset>
                        <legend>Let's Play -> Please Select your choice:</legend>
                        <div>
                            <label class = imgRadio>
                            <input type="radio" name="choice" id="Rock" value="Rock" />
                            <img src="images/Rock.png" alt="Rock Image" />
                            </label>
                        </div>
                        <div>
                            <label class = imgRadio>
                            <input type="radio" name="choice" id="Paper" value="Paper" />
                            <img src="images/Paper.png" alt="Paper Image" />
                            </label>
                        </div>
                        <div>
                            <label class = imgRadio>
                            <input type="radio" name="choice" id="Scissors" value="Scissors" />
                            <img src="images/Scissors.png" alt="scissor Image" />
                            </label>
                        </div>
                        <span class="error <?=!isset($errors['choice']) ? 'hidden' : "";?>">Please Enter a choice in order to play</span>
                    </fieldset>
                    <!-- submit  button -->
                    <div id="button">
                        <button type="submit" name="submit">PLAY</button>
                    </div>
                </form>
            </section>
            <section class = "feedback">
                <form id="feedbackform" name="feed" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" >
                    <div>
                        <label for="string">Enter Feedback:</label>
                        <textarea name = "string" id = "string" value="<?=$string?>" rows = "7" cols = "50" required></textarea>
                        <span class="error <?=!isset($errors['string']) ? 'hidden' : "";?>">You can't submit a empty form</span>
                        <span class="printout <?=!isset($print['string']) ? 'hidden' : "";?>">Feedback Submitted</span> 
                    </div>
                    <div id="buttonFeed">
                    <button type="submit" name="submitFeedback">Submit Feedback</button>
                    </div>
                </form>
            </section>
            <section class = "instructions">
                <div>
                    <h3> GAME INSTRUCTIONS </h3>
                </div>
                <div>
                    <ol>
                        <li>Select your choice from Rock | Paper | Scissors</li>
                        <li>Then, Click on Play Button.</li>
                        <li>You will see your win and lose score on each play.</li>
                        <li>You could play this game untill you lose 5 times.</li>
                        <li>If you loose 5 times, then your game will be ended and you will be redirected to the Game Over Page.</li>
                        <li>On Game Over Page, you will need to submit your name in order to record your score on the High Score Table.</li>
                        <li>On submission, it will then redirect you to the High score table.</li>
                        <li>There are two buttons on top of every page, On clicking Play again, it will restart your game.</li>
                        <li>You can view High Score Table by clicking on the above link.</li>
                    </ol>
                </div>
            </section>
        </main>
        <?php include "includes/footer.php";?>
    </body>
</html>
