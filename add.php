<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/styles.css">
    <title>New result</title>
</head>
<body>
<form method="post" action="process.php">
    <?php
    require 'connection.php';

    $stm = $pdo->query('SELECT * from clubs');
    $rows = $stm->fetchAll(PDO::FETCH_NUM);

    echo '<select name="homeTeam" class="combo"><option value="0">Выбрать хозяев</option>';
    foreach ($rows as $row) {
        echo '<option value="'. $row[0] . '">' . $row[1] . '</option>';
    }
    echo '</select>';
    ?>
    <input type="text" name="home_g" placeholder="Голы хозяев"><br><br>

    <?php
    echo '<select name="awayTeam" class="combo"><option value="0">Выбрать гостей</option>';
    foreach ($rows as $row) {
        echo '<option value="'. $row[0] . '">' . $row[1] . '</option>';
    }
    echo '</select>';
    ?>
    <input type="text" name="away_g" placeholder="Голы гостей"><br><br>
    <input type="text" name="round" placeholder="Какой тур">
    <!--    <br><br><input type="date" name="matchday"> -->
    <br><br><br>
    <button type="submit" name="sendResult">Записать</button>
    </form>

    </body>
    </html>
