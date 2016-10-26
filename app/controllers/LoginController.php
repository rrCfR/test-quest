<?

class LoginController extends Controller
{
  public function try ($data)
  {

    $check = $this->rules($data, [
      'username' => 'required',
      'password' => 'required'
    ]);

    if(!$check) {
      return header("Location: ".$this->backUrl());
    }

    if(filter_var($data['username'], FILTER_VALIDATE_EMAIL)) {
      $username = "email";
    }else{
      $username = "username";
    }

    $check = $this->sql()->prepare("SELECT id FROM users WHERE $username = :username AND password = :password");
    $check->bindParam(":username", $data['username']);
    $check->bindParam(":password", sha1($data['password']));

    if($check->execute()) {
      $user = $check->fetch(PDO::FETCH_OBJ);

      if($user) {
        Session::put('user_id', $user->id);
        return header("Location: /secret");
      }
      Session::put('error', 'Неверные данные, пожалуйста, попробуйте еще раз.');
      header("Location: ".$this->backUrl());
    }

    return 'ERROR!@';
  }
}
