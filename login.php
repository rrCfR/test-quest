<?
require_once (realpath("app/core.php"));

if(Session::has('user_id')) {
  header('Location: /secret');
}

if(isset($_POST['auth'])) {
  $login = new LoginController();
  return $login->try($_POST);
}
?>
<? include 'header.php'; ?>
    <section id="registration" class="container">
        <form action='' method='post' class="center" role="form" >
          <h3>Вход на сайт</h3>
            <fieldset class="registration-form">
              <? include 'errors.php'; ?>
                <div class="form-group">
                    <input data-toggle="tooltip" title="Имя пользователя или E-mail." type="text" id="username" name="username" value='<?= Session::old('username'); ?>' placeholder="Имя пользователя иди E-mail" class="form-control">
                </div>
                <div class="form-group">
                    <input type="password" id="password" name="password"  placeholder="E-mail" class="form-control">
                </div>
                <div class="form-group">
                    <button type='submit' name='auth' class="btn btn-success btn-md btn-block">Вход!</button>
                </div>
            </fieldset>
        </form>
    </section>
