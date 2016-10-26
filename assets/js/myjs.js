// Пожалуйста,не выкладывайте это на govnokod.ru!

$(document).ready(function () {

  function required(e)
  {
    var err = $('#errors');
    var error_text = "Поле " +  e.attr('name') + " должно быть заполнено.";
    var error = $(document.createElement('li'));
    error.text(error_text);

    var same = $('#errors').children();

    if(same.length) {
      var same = $('#errors').children();
      same.each( function () {
        if($(this)[0] !== error[0]) {
          err.append(error);
        }else{
          console.log('Error equal!');
        }
      });
    }else{
      err.append(error);
      err.show();
    }
  }

  $('#username').on('keyup', function () {
    return required($(this));
  });

  $('#email').on('keyup', function () {
    return required($(this));
  });
})
