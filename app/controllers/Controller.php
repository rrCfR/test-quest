<?


class Controller
{

  public function Validator()
  {
    return new Validator();
  }

  /**
   * Метод возвращает подключение к БД.
   * @param ..
  */
  public function sql()
  {
    $connect = new Database();
    return $connect->getDb();
  }

  /**
   * Возвращает метод validate класса Validator.
   * Вынесен сюда.т.к Controller является папочкой LoginController а так же RegisterController - и там используется валидация.
   * @param array $data
   * @param array $rules
   * @return mixed
  */
  public function rules($data, $rules)
  {
    return $this->validator()->validate($data, $rules);
  }

  public function backUrl()
  {
    return $_SERVER["HTTP_REFERER"];
  }
}
