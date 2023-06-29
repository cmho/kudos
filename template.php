<?php // you can edit this file if you want to make it fit in with your site etc. ?>
<!doctype html>
<html lang="en">
  <head>
    <title><?= SITE_NAME; ?></title>
    <link rel="stylesheet" type="text/css" href="./style.css" />
  </head>
  <body>
    <div id="container">
      <h1><?= SITE_NAME; ?></h1>
      <div class="response">
        <?= $content; ?>
      </div>
    </div>
  </body>
</html>
