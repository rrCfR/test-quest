<?

class RegistrationLockController extends Controller
{

  /**
  * Метод проверяет, регистрировался ли пользователь за посление N минут.
  * Если пользователь зарегистрировался недавно - будет добавлена ошибка в сессию errors.
  */
  public function checkRegisterLog()
  {
    $date = date("Y-m-d H:i:s");

    $connect = new Database();

    $check = $connect->getDb()->prepare("SELECT can_register_after FROM registrations WHERE ip = :ip ORDER BY id DESC");

    $check->bindParam(':ip', $this->getIp());

    if($check->execute()){
      $can = $check->fetch(PDO::FETCH_OBJ)->can_register_after;

       if($can) {
         if(strtotime($date) > strtotime($can)) {
           return true;
         }

         Session::put('error', "Повторая регистрация будет доступна после: $can");
         return false;
       }
       return true;
    }
    return false;
  }

  /**
   * Метод добавляет новую запись в лог-таблицу registrations, в которой хранится информация о регистрациях пользователя.
   * Метод добавляет время с плюсом в N минут.
  */
  public function addRegisterLog()
  {
    $reg_log = $this->sql()->prepare("INSERT INTO REGISTRATIONS (ip, can_register_after) VALUES (:ip, :can_register_after)");

    $reg_log->bindParam(':ip', $this->getIp());
    $reg_log->bindParam(':can_register_after', date("Y-m-d H:i:s", strtotime('+1 hour')));

    if($reg_log->execute()) {
      Session::put('success', 'Теперь Вы можете войти.');
      return header("Location: /login");
    }
    return false;
  }

  /**
   * Возвращает IP пользователя.
  */
  public function getIp()
  {
    return $_SERVER['REMOTE_ADDR'];
  }

}
