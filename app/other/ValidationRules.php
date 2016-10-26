<?

class ValidationRules
{
  /**
  * Переменная служит для хранения всех ошибок которые произошли во время валидации.
  */
  public $errors = array();

  /**
   * Не пропускает пустые значения.
   * @param string $value
  */
  public function required($value)
  {
    if(!$_POST[$value]) {
      $this->errors[] = "Поле $value обязательно к заполнению.";
    }
  }

  /**
   * Метод проверяет,является ли полученное значение строкой.
   * @param string $value
  */
  public function string($value)
  {
    if(!is_string($_POST[$value])) {
      $this->errors[] = "Поле $value должно быть строкой.";
    }
  }

  /**
   * Метод проверяет является ли значение введенное пользователем уникальным. (Email, username)
   * @param string $value
  */
  public function unique($value)
  {
    $connect = new Database();

    $post = $_POST[$value];

    $check = $connect->getDb()->prepare("SELECT COUNT(id) as id FROM users WHERE $value = :$value");

    $check->bindParam(":$value", $post);

    $check->execute();

    $count = (int) $check->fetch(PDO::FETCH_OBJ)->id;

    if($count > 0) {
      $this->errors[] = "$value уже кем-то используется.";
    }
  }

  /**
   * Метод проверяет,является ли полученное значение строкой,без всяких ненужных символов.
   * @param mixed $value
  */
  public function illegal($value)
  {
    if(!preg_match("/^[a-zA-Z0-9 \s]+$/", $_POST[$value])) {
      $this->errors[] = "Поле $value содержить недопустимые символы.";
    }
  }

  /**
   * Метод проверят является ли значение e-mail адрессом.
   * @param text $email
  */
  public function email($value)
  {
    if(!filter_var($_POST[$value], FILTER_VALIDATE_EMAIL)) {
      $this->errors[] = "Поле $value должно содержать настоящий емейл адрес.";
    }
  }

  /**
   * Метод проверят,является ли значение целым числом.
   * @param array $data
   *
  */
  public function int($value)
  {
    if(!is_numeric($_POST[$value])) {
      $this->errors[] = "Поле $value должно быть числом.";
    }
  }

}
