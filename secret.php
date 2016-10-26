<?
require_once ('app/core.php');

if(!Session::has('user_id')) {
  header('Location: /login');
}

$user = new User();
$user = $user->u;

?>
<? include 'header.php'; ?>
    <section id="registration" class="container">
        <form action='/auth' method='post' class="center" role="form" >
          <h3>Ваша информация: (<a class='active' href='/logout'>Выйти</a>)</h3>
            <fieldset class="registration-form">
              <? include 'errors.php'; ?>
                <h3>Username:   <strong><?= $user->username; ?></strong></h3>
                <h3>Email:      <strong><?= $user->email; ?></strong></h3>
                <h3>first_name: <strong><?= $user->first_name; ?></strong></h3>
                <h3>last_name:  <strong><?= $user->last_name; ?></strong></h3>
                <h3>About:      <strong><?= $user->about; ?></strong></h3>
            </fieldset>
        </form>
    </section>

    </script>
