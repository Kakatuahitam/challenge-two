<?php
  require_once __DIR__ . '/../vendor/autoload.php';

  use Predis\Client;

  class RedisClient
  {
    private static $client = null;
    public static function getClient()
    {
      if (self::$client === null) {
        self::$client = new Client([
          'host'     => 'redis-15560.c57.us-east-1-4.ec2.redns.redis-cloud.com',
          'port'     => 15560,
          'database' => 0,
          'username' => 'default',
          'password' => 'UwKdGDZABwNqM5T7llYEZa1I6VhK6A3a',
        ]);
      }
      return self::$client;
    }
  }
?>
