<?php 
session_start();
include_once 'includes/check_login.php';

include_once 'database/search.php';

if (isset($_GET["sport"])) {
  // Somebody's searching!
  
  $startDate = null;
  if ($_GET['start'] !== "") {
    if ($dt = new DateTime(htmlspecialchars($_GET['start']))) {
      $startDate = $dt->format("Y-m-d");
    }
  }

  $endDate = null;
  if ($_GET['end'] !== "") {
    if ($dt = new DateTime(htmlspecialchars($_GET['end']))) {
      $endDate = $dt->format("Y-m-d");
    }
  }

  $query = array(
    "sportId" => (int) htmlspecialchars($_GET['sport']),
    "startDate" => $startDate,
    "endDate" => $endDate,
    "location" => htmlspecialchars($_GET['location']),
  );

  foreach ($query as $k => $v) {
    if ($v === "") {
      $query[$k] = null;
    }
  }

  $results = search($query, 10, 0);
}

?>

<!DOCTYPE html>

<html>
<head>
<title>Search</title>

<link rel="stylesheet" href="stylesheets/jquery/jquery-ui-1.8.22.custom.css" type="text/css" />
<script type="text/javascript" src="scripts/jquery/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="scripts/jquery/jquery-ui-1.8.22.custom.min.js"></script>

<script type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/validation.js"></script>
<script type="text/javascript" src="scripts/search.js"></script>
<link rel="stylesheet" href="stylesheets/common.css" type="text/css" />
<link rel="stylesheet" href="stylesheets/search.css" type="text/css" />

</head>

<body>

<?php
$header = "Search";
include 'includes/header.php';

$addr = "search.php";
include 'includes/nav.php';

echo <<<HTML
<div class="search">
<form name="query" action="search.php" method="get">
Sport: 
<select name="sport">
HTML;

require_once 'database/sport.php';
$sports = getAllSports();
foreach ($sports as $sport) {
  $sportName = $sport['sportName'];
  $sportId = $sport['sportId'];
  echo "<option value='{$sportId}'>{$sportName}</option>\n";
}

echo <<<HTML
</select>
<br/>
From: <input type="text" id="datepicker1" name="start" class="vDate vBlank" placeholder="(today)" /><br/>
To: <input type="text" id="datepicker2" name="end" class="vDate vBlank" placeholder="(any date)" /><br/>
Location: <input type="text" name="location" placeholder="Location" /><br/>
<input type="submit" value="Search" />
</form>

</div>
HTML;

include 'includes/searchresults.php';
?>

</body>
</html>
