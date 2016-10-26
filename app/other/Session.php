<?

class Session
{
  /**
   * Метод проверяет существует ли сессия с именем $string
   * @param string $name
  */
  public function has($name)
  {
    return $_SESSION[$name] ? true : false;
  }

  /**
   * Метод возвращает сессию, и уничтожает ее.
   * @param string $name
  */
  public function get($name)
  {
    if(self::has($name)){
      $session = $_SESSION[$name];

      unset($_SESSION[$name]);

      return $session;
    }
  }

  /**
   * Метод создает новую сессию.
   * @param string $name
   * @param mixed $data
  */
  public function put($name, $data)
  {
    return $_SESSION[$name] = $data;
  }

  public function old($name)
  {
    $old = $_SESSION['old'][$name];
    if($old) {
      unset($_SESSION['old'][$name]);
      return $old;
    }
  }

  public function putOld($name, $value, $data)
  {
    $_SESSION[$name][$value] = $data;
  }
}
