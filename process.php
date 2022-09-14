<?php
  error_reporting(E_ALL);

//  var_dump($_POST);
  if (($_POST['homeTeam'] === '0') || ($_POST['awayTeam'] === '0')) {
      echo "Не указаны команды";
      exit();
  }
  if ($_POST['homeTeam'] ===  $_POST['awayTeam']) {
      echo "Должны быть указаны разные команды";
      exit();
  }

  $home_g = filter_var(trim($_POST['home_g']), FILTER_SANITIZE_STRING);
  $away_g = filter_var(trim($_POST['away_g']), FILTER_SANITIZE_STRING);
  $round = filter_var(trim($_POST['round']), FILTER_SANITIZE_STRING);

  if (($home_g === '') || ($away_g === '')) {
      echo "Не указаны голы";
      exit();
  }
  if ($round === '') {
      echo "Не указан тур";
      exit();
  }

  $home_id = intval($_POST['homeTeam']);
  $away_id = intval($_POST['awayTeam']);
  $home_goals = intval($home_g);
  $away_goals = intval($away_g);
  $round_num = intval($round);

  try {
      require 'connection.php';
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $qry = $pdo->prepare(
          'INSERT INTO results (home_id, away_id, home_g, away_g, round) VALUES (:home, :away, :hg, :ag, :r)');

      $qry->bindParam(':home', $home_id, PDO::PARAM_INT);
      $qry->bindParam(':away', $away_id, PDO::PARAM_INT);
      $qry->bindParam(':hg', $home_goals, PDO::PARAM_INT);
      $qry->bindParam(':ag', $away_goals, PDO::PARAM_INT);
      $qry->bindParam(':r', $round_num, PDO::PARAM_INT);
      $qry->execute();
      $pdo = null;

  } catch (PDOException $e) {
      echo $e->getMessage();
  }

//  echo $home_id, $away_id, $home_goals, $away_goals, $round_num;
  header('Location: index.php');
