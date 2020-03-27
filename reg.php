<!DOCTYPE html>
<html lang="ru">
  <head>
    <?php
    $website_title = 'Регистрация';
    require 'blocks/head.php';
    ?>
  </head>
  <body>
    <?php require 'blocks/header.php'; ?>
    <main class="container mt-5">
      <div class="row">
        <div class="col-md-8 mb-3">
          <h4>Регистрация</h4>
          <form action="" method="post">
            <label for="username">Ваше имя</label>
            <input type="text" name="username" id="username" class="form-control">

            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control">

            <label for="login">Логин</label>
            <input type="text" name="login" id="login" class="form-control">

            <label for="pass">Пароль</label>
            <input type="password" name="pass" id="pass" class="form-control">

            <label for="pass">Повторите пароль</label>
            <input type="password" name="passagain" id="passagain" class="form-control">

            <div class="alert alert-danger mt-2" id="errorBlock"></div>

            <button type="button" id="reg_user" class="btn btn-success mt-3">
              Зарегистрироваться
            </button>

          </form>
        </div>
      </div>
    </main>

    <script src="/js/jquery.min.js"></script>
    <script src="/js/reg.js"></script>
  </body>
</html>
