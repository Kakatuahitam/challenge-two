<?php
require_once __DIR__ . '/../model/RedisClient.php';

class GetSessionService
{
  private $redis;
  public function __construct(){
    $this->redis = RedisClient::getClient();
  }

  public function getSessions(){
    $username_keys = $this->redis->keys('username:*');
    $sessions = [];

    foreach ($username_keys as $username_key){
      $parts = explode(':', $username_key, 2);
      $id = $parts[1] ?? null;
      if(!$id){
        continue;
      }

      $username = $this->redis->get("username:$id");
      $exam_mode = $this->redis->get("exam_mode:$id");
      $token = $this->redis->get("token:$id");

      $sessions[] = [
        'id' => $id,
        'username' => $username,
        'exam_mode' => $exam_mode,
        'token' => $token
      ];
    }

    return $sessions;
  }
}
?>
