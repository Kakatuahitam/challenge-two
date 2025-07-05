<?php
  class SessionData{
    public function __construct($username, $exam_mode, $token){
      $this->username = $username;
      $this->exam_mode = $exam_mode;
      $this->token = $token;
    }
  }

  class PrintInfo{
    public function all(SessionData $data){
      $str = "{$data->username}, {$data->exam_mode}, {$data->token}";
      return $str;
    }

    public function token(SessionData $data){
      $str = "{$data->token}";
      return $str;
    }
  }
?>
