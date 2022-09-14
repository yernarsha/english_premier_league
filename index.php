<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/styles.css">
    <title>The Premier League</title>
</head>
<body>
<p class="center-img">
<img src="img/thumbs.jpg" width="250" height="170">
</p>
<div>
    The Premier League is the top level of the men's English football league system. Contested by 20 clubs,
    it operates on a system of promotion and relegation with the English Football League. Seasons typically
    run from August to May with each team playing 38 matches.
</div><br>
<div>Чтобы добавить результат, нажмите <a href="add.php">здесь</a>. Смотреть <a href="all.php">все результаты</a>.</div><br>
<div>
    <h1>Таблица</h1>
    <?php
    require 'calculate.php';
    ?>

</div>
</body>
</html>
