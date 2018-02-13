<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Registro de Eventos</title>

  <?php require_once "vendor/autoload.php"; ?>
  <?php require_once "controller.php"; ?>

  <?php setStyles(); ?>

  <!-- Let browser know website is optimized for mobile -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>

  <?php setHeader(); ?>

  <main class="container section no-pad-bot">

    <?php setMain( isset( $_GET["page"] ) ? $_GET["page"] : NULL ); ?>

  </main>

  <?php setScripts(); ?>

</body>
</html>
