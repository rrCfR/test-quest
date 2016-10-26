<?

class RegisterController extends Controller
{

  private $locker;

  public function __construct ()
  {
    $this->locker = new RegistrationLockController();
  }
  /**
  * Метод создает нового пользователя если проходит валидацию.
  * @param array $data
  */
  public function create ($data)
  {
    $data = $this->rules($data, [
      'username' => 'required|illegal',
      'email' => 'email|required',
      'password' => 'required'
    ]);

    // Если не пройдена валидация - переадресация.
    if(!$data){
      return header("Location: ".$this->backUrl());
    }

    // Если пользователь регистрировался ранее.
    if(!$this->locker->checkRegisterLog()) {
      return header("Location: ".$this->backUrl());
    }

    $stmt = $this->sql()->prepare("INSERT INTO USERS (username, email, password, first_name, last_name, about) VALUES (:username, :email, :password, :first_name, :last_name, :about)");

    //
    $stmt->bindParam(':username', $data['username']);
    $stmt->bindParam(':email', $data['email']);
    $stmt->bindParam(':password', sha1($data['password']));
    $stmt->bindParam(':first_name', $data['first_name']);
    $stmt->bindParam(':last_name', $data['last_name']);
    $stmt->bindParam(':about', $data['about']);

    if($stmt->execute()) {
        return $this->locker->addRegisterLog();
    }

    Session::put('error', 'Произошла ошибка при регистрации, пожалуйста, обратитесь к администратору.');
    return header("Location: /join");

  }
}
