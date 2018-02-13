<!DOCTYPE html>
<html>
<head>
    <?php
    setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Recife');
    ?>
    <title>Registro de Eventos</title>

    <?php
    require_once "vendor/autoload.php";

    use Core\PageLoader;

    $pageLoader = PageLoader::getInstance();
    ?>

    <?php $pageLoader->setStyles(); ?>

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>

    <?php $pageLoader->setHeader(); ?>

    <main class="container section no-pad-bot">

        <?php $pageLoader->setMain( isset( $_GET["page"] ) ? $_GET["page"] : NULL ); ?>

    </main>

    <?php $pageLoader->setScripts(); ?>

</body>
</html>
