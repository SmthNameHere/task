<!DOCTYPE html>
<html lang="ru">
  <head>
    <?php
    $website_title = 'TaskTest';
    require 'blocks/head.php';
    ?>
  </head>
  <body>
    <?php require 'blocks/header.php'; ?>
    <main class="container mt-5">
        <h2>Привет, <?= base64_decode($_COOKIE['login']) ?></h2>
          <button class="btn btn-danger mb-2" id="exit_btn">Выйти</button>
    </main>
        <script src="/js/jquery.min.js"></script>
        <script>
          $('#exit_btn').click(function() {
          $.ajax({
            url: 'ajax/exit.php',
            type: 'POST',
            cache: false,
            data: {},
            dataType: 'html',
            success: function(data) {
              document.location.reload(true);
            }
          });
          });
        </script>
  </body>
</html>
