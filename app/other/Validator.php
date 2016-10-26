<?
class Validator extends ValidationRules
{

  /**
   * Метод проверяет массив данных $post на предмет ошибок валидации.
   * @param array $post
   * @param array $rules
  */
  public function validate($post, $rules)
  {

    $back = $_SERVER['HTTP_REFERER'];

    // Разбиваем массив данных с помощью explode, т.к правило валидации может быть не одно (required|email)
    foreach ($rules as $rules_key => $rules_value)
    {
      if(strpos($rules_value, '|') !== FALSE)
      {
        $rules_more[$rules_key] = explode('|', $rules_value);
      }
      else
      {
        $rules_more[$rules_key] = $rules_value;
      }
    }

    // Проходимся циклом по ключу в $post запросе, и если он совпадает с ключем $rules
    // Тогда вызываем функцию валидаци.
    foreach ($post as $post_key => $post_value)
    {
      $_post[$post_key] = htmlspecialchars($post_value);

      // Помещаем в сессию старые значения с форм - т.к мы делаем несколько переадресаций в процессе регистрации/авторизации.
      Session::putOld('old', $post_key, $post_value);

      foreach ($rules_more as $rules_key => $rules_value)
      {
        if($post_key == $rules_key)
        {
          if(is_array($rules_value)) {
            foreach ($rules_value as $value)
            {
              $this->$value($post_key);
            }
          }else{
            $this->$rules_value($post_key);
          }
        }
      }
    }

    if($this->errors)
    {
      Session::put('errors', $this->errors);
      return false;
    }
    return $_post;
  }
}
