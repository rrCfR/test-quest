<?

// Дефолтнейшее подключение PDO.
class Database
{
  public static $connect;

  public function __construct()
  {
    try {
      self::$connect = new PDO("mysql:host=localhost;dbname=#", "#", "#");
    } catch (PDOException $e) {
      echo 'Ошибка подключения: ' . $e->getMessage();
    }
  }

  public function getDb()
  {
    return self::$connect;
  }
}
