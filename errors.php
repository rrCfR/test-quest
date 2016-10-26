<? if(Session::has('errors')): ?>
<div class='alert alert-warning'>
  <ul>
    <? foreach (Session::get('errors') as $error): ?>
      <li><?= $error; ?></li><br>
    <? endforeach; ?>
  </ul>
</div>
<? endif; ?>

<? if(Session::has('error')): ?>
<div class='alert alert-warning'>
  <?= Session::get('error'); ?>
</div>
<? endif; ?>

<? if(Session::has('success')): ?>
<div class='alert alert-success'>
  <?= Session::get('success'); ?>
</div>
<? endif; ?>

<div id='errors' class='alert alert-danger' style='display: none;'>
</div>
