<?php
require_once __DIR__ . '/../model/RedisClient.php';

class SessionService
{
  private $redis;

  public function __construct(){
    $this->redis = RedisClient::getClient();
  }

  private function generateToken($length = 32){
    return bin2hex(random_bytes($length / 2));
  }

  public function createSession($username, $exam_mode){
    $token = $this->generateToken();

    $results = [];
    $results[] = $this->redis->set("username:$username", $username);
    $results[] = $this->redis->set("exam_mode:$username", $exam_mode);
    $results[] = $this->redis->set("token:$username", $token);

    if (in_array(false, $results, true)) {
      return false;
    }

    return [
      'username' => $username,
      'exam_mode' => $exam_mode,
      'token' => $token
    ];
  }
}


$service = new SessionService();

$username = $_POST['username'] ?? null;
$exam_mode = $_POST['exam_mode'] ?? null;

if ($username && $exam_mode) {
  $sessionData = $service->createSession($username, $exam_mode);
  header("Location: ../index.php?success=1");
  exit;
} else {
  http_response_code(400);
}
?>
