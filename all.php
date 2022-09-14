<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>All results</title>
</head>
<body>
<?php
  require 'connection.php';
  $teams = [];
  $stm = $pdo->query('SELECT * from clubs');
  $rows = $stm->fetchAll(PDO::FETCH_NUM);
  foreach ($rows as $row) {
      $teams[] = $row[1];
  }

for ($i=1; $i<=38; $i++) {
      echo '<b>' . $i . " тур</b><br><br>";

      $stm = $pdo->query('SELECT * from results where round = ' . $i);
      $rows = $stm->fetchAll(PDO::FETCH_NUM);
      foreach ($rows as $row) {
          echo $teams[$row[1]-1] . ' - ' . $teams[$row[2]-1] . ' ' . $row[3] . ':' . $row[4] . '<br>';
      }
      echo '<br>';
  }
?>

</body>
</html>
