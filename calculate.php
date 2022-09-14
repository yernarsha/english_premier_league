<?php
  require 'connection.php';
  require 'lib.php';

  $teams = [];
  $stm = $pdo->query('SELECT * from clubs');
  $rows = $stm->fetchAll(PDO::FETCH_NUM);
  foreach ($rows as $row) {
      $teams[] = trim($row[1]);
  }

  $stm = $pdo->query('SELECT * from results');
  $rows = $stm->fetchAll(PDO::FETCH_NUM);

  $standings = [];
  $standingTemplate = array ('matches' => 0, 'wins' => 0, 'draws' => 0, 'losses' => 0,
      'goalsfor' => 0, 'goalsagainst' => 0, 'goalsdiff' => 0, 'points' => 0, 'name' => '');

  foreach ($rows as $row) {
      handleMatch($row[1], $row[3], $row[4]);
      handleMatch($row[2], $row[4], $row[3]);
  }

  usort($standings, 'comparePoints');
  echo yernar_strpad('М', 3, STR_PAD_BOTH)
      . yernar_strpad('Клуб', 20, STR_PAD_BOTH) . yernar_strpad('И', 4)
      . yernar_strpad('В', 4) . yernar_strpad('Н', 4) . yernar_strpad('П', 4)
      . yernar_strpad('Мячи', 6) . yernar_strpad('Очки', 6) . '<br>';

  $j = 0;
  foreach ($standings as $team=>$v) {
      $j++;
      echo yernar_strpad($j .'.', 3) . yernar_strpad('~' . $v['name'], 20, STR_PAD_RIGHT) .
          yernar_strpad($v['matches'], 4) . yernar_strpad($v['wins'], 4) .
          yernar_strpad($v['draws'], 4) . yernar_strpad($v['losses'], 4) .
          yernar_strpad($v['goalsfor'] . '-' . $v['goalsagainst'], 6) .
          yernar_strpad($v['points'], 6) . '<br>';
  }
  echo '<br><br>';

function yernar_strpad($s, $len, $pad_type = STR_PAD_LEFT) {
    return str_replace('~', '&nbsp;', mb_str_pad($s, $len, '~', $pad_type));
}

function handleMatch($team, $goalsfor, $goalsagainst) {
    global $standings, $standingTemplate,$teams;
    if ($goalsfor > $goalsagainst) {
        $points = 3;
        $win = 1;
        $draw = 0;
        $loss = 0;
    } elseif ($goalsfor == $goalsagainst) {
        $points = 1;
        $win = 0;
        $draw = 1;
        $loss = 0;
    } else {
        $points = 0;
        $win = 0;
        $draw = 0;
        $loss = 1;
    }

    if (empty($standings[$team])) {
        $standing = $standingTemplate;
        $standing['name'] = $teams[$team-1];
    }
    else $standing = $standings[$team];

    $standing['matches']++;
    $standing['wins'] += $win;
    $standing['draws'] += $draw;
    $standing['losses'] += $loss;
    $standing['goalsfor'] += $goalsfor;
    $standing['goalsagainst'] += $goalsagainst;
    $standing['goalsdiff'] += $goalsfor - $goalsagainst;
    $standing['points'] += $points;

    $standings[$team] = $standing;
}

function comparePoints($a, $b)
{
    if ($a['points'] == $b['points'])
    {
        if ($a['goalsdiff'] == $b['goalsdiff']) {
            if ($a['goalsfor'] == $b['goalsfor']) return 0;
            return ($a['goalsfor'] < $b['goalsfor']) ? 1 : -1 ;
        }
        return ($a['goalsdiff'] < $b['goalsdiff']) ? 1 : -1 ;
    }
    return ($a['points'] < $b['points']) ? 1 : -1 ;
}
