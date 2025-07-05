<?php
require_once __DIR__ . '/../model/RedisClient.php';

$username = $_POST['username'] ?? null;
$exam_mode = $_POST['exam_mode'] ?? null;

if ($username && $exam_mode) {
  $redis = RedisClient::getClient();

  // Update the exam mode for this username
  $result = $redis->set("exam_mode:$username", $exam_mode);

  if ($result === false) {
    http_response_code(500);
    echo "<h3>Failed to update session.</h3>";
    echo "<p><a href='../index.php'>Back</a></p>";
  } else {
    header("Location: ../index.php?updated=1");
    exit;
  }
} else {
  http_response_code(400);
  echo "<h3>Missing required fields.</h3>";
  echo "<p><a href='../index.php'>Back</a></p>";
}
?>
