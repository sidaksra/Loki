<?php
  include 'includes/library.php';
  $pdo =connectDB();
  //running query to get results for display
  $stmt=$pdo->query("select username, wins from High_ScoreTable order by wins DESC LIMIT 20");

  //dealing with the possibilties of not getting any results
  if(!$stmt){
    die("Database pull did not return data");
  }
?>

<!DOCTYPE html>
<html lang="en"> 
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>HIgh Score Table</title>
        <link rel="stylesheet" href="styles/master.css" />
    </head>
    <body>
        <?php include "includes/header.php";?>
        <main>
            <section>
                <form id="HighScore" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" >
                    <table>
                        <tr class="tableTop">
                            <th>Player's</th>
                            <th>Number of Wins</th>
                	    </tr>
                        <?php foreach ($stmt as $row): ?>
                        <tr class ="Row">
                            <td><?php echo $row['username']  ?></td>
                            <td><?php echo $row['wins']  ?></td>
                        </tr>
            			<?php endforeach; ?>
                    </table>
                </form>
            </section>
        </main>
        <?php include "includes/footer.php";?>
    </body>
</html>
