<?php
header('Content-Type: application/json; charset=utf-8');

require_once('./_secrets.php');
//echo (DB_HOST . ", " .  DB_USERNAME . ", " .  DB_PASSWORD . ", " .  DB_NAME . ", " .  DB_PORT);
// Establish connection to db
$conn = new mysqli(DB_HOST . ":" . DB_PORT, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Holder for errors
$error_messages = [];

// Holder for data
$dataArr = [
  "courses" => [],
  "news" => []
];

// Check for errors
if(mysqli_connect_errno()){
   $error_messages[] = mysqli_connect_error();
   echo $error_messages[0];
}

//$conn->query("SET CHARACTER SET utf8");
//$conn->query("SET NAMES 'utf8'");


if (!mysqli_connect_errno()) {
  // Grab The Info
  $query_courses = "SELECT date, url, city, state FROM googlemap WHERE active = 1 AND date > CURDATE() ORDER BY date ASC LIMIT 10";
  $query_news = "SELECT newsheading, sourcename, sourceurl FROM statinginnews ORDER BY sortNo LIMIT 5";
  $results_courses = $conn->query($query_courses);
  if($results_courses){
    // Cycle through results
    while ($row = $results_courses->fetch_object()){
        $dataArr["courses"][] = $row;
    }
    // Free result set
    $results_courses->close();
    $conn->next_result();
  }

  $results_news = $conn->query($query_news);
  if($results_news){
    // Cycle through results
    while ($row = $results_news->fetch_object()){
        $dataArr["news"][] = $row;
    }
    // Free result set
    $results_news->close();
    $conn->next_result();
  }
}

// DB Stuff done.
mysqli_close($conn);

// Return info as JSON
if (!mysqli_connect_errno()) {
  echo json_encode($dataArr, JSON_PRETTY_PRINT);
} else {
  echo json_encode(
    [
      "error" => $error_messages
    ]
  );
}


