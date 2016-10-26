<?

class User extends Controller
{
  protected $table = 'users';

  public $u;

  public function __construct ()
  {
    $this->u = $this->get();
  }

  public function get()
  {
    $id = $_SESSION['user_id'];

    if($id) {
      $user = $this->sql()->prepare("SELECT * FROM users WHERE id = :id");
      $user->bindParam(':id', $id);

      if($user->execute()) {
        return $user->fetch(PDO::FETCH_OBJ);
      }
      return null;
    }
  }
}
