<!DOCTYPE html>
<html lang="ru">
  <head>
    <?php
    $website_title = 'TaskTest';
    require 'blocks/head.php';
    ?>
  </head>
  <body>
        <?php if (isSet($_COOKIE['login']) != true):
              require 'blocks/header.php'; ?>
        <?php else: ?>
            <main class="container mt-5">
              <h2>Привет, <?= base64_decode($_COOKIE['login']) ?></h2>
              <button class="btn btn-danger mb-2" id="exit_btn">Выйти</button>
        <?php endif; ?>

    </main>
        <script src="/js/jquery.min.js"></script>
        <script src="/js/exit.js"></script>
  </body>
</html>
