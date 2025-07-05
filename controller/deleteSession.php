<?php
require_once __DIR__ . '/../model/RedisClient.php';

$id = $_GET['id'] ?? null;

if ($id) {
  $redis = RedisClient::getClient();
  $deleted = $redis->del(
    "username:$id",
    "exam_mode:$id",
    "token:$id"
  );

  if ($deleted > 0) {
    header("Location: ../index.php?deleted=1");
    exit;
  } else {
    header("Location: ../index.php?deleted=0");
    exit;
  }
} else {
  http_response_code(400);
  echo "<h3>Missing ID.</h3>";
  echo "<p><a href='../index.php'>Back</a></p>";
}
?>
