<?
require_once (realpath("app/core.php"));

if(Session::has('user_id')) {
  header('Location: /secret');
}

if(isset($_POST['join'])) {
  $register = new RegisterController();
  return $register->create($_POST);
}
?>
<? include 'header.php'; ?>
    <section id="registration" class="container">
        <form action='' method='post' class="center" role="form" >
          <h3>Регистрация нового пользователя</h3>
            <fieldset class="registration-form">
              <? include 'errors.php'; ?>
                <div class="form-group">
                    <input data-toggle="tooltip" title="Например - vAsYa2001" type="text" id="username" name="username" value='<?= Session::old('username'); ?>' placeholder="Имя пользователя" class="form-control">
                </div>
                <div class="form-group">
                    <input data-toggle="tooltip" title="Например - vasya_killer@mail.ru" type="text" id="email" name="email" value='<?= Session::old('email'); ?>' placeholder="E-mail" class="form-control">
                </div>
                <div class="form-group">
                    <input data-toggle="tooltip" title="Ваше имя" type="text" id="first_name" name="first_name" value='<?= Session::old('first_name'); ?>' placeholder="Ваше имя" class="form-control">
                </div>
                <div class="form-group">
                    <input data-toggle="tooltip" title="Ваша фамилия" type="text" id="last_name" name="last_name" value='<?= Session::old('last_name'); ?>' placeholder="Ваша фамилия" class="form-control">
                </div>
                <div class="form-group">
                    <input data-toggle="tooltip" title="Вы можете использовать любой пароль." type="password" id="password" name="password" placeholder="Введите пароль.." class="form-control">
                </div>
                <div class="form-group">
                    <textarea data-toggle="tooltip" title="Здесь Вы можете рассказать о себе."  class='form-control' name='about' placeholder="Расскажите о себе?"></textarea>
                </div>
                <div class="form-group">
                    <button type='submit' name='join' class="btn btn-success btn-md btn-block">Регистрация!</button>
                </div>
            </fieldset>
        </form>
    </section>
