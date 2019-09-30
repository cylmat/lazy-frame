<!doctype html>
<html lang="fr">
    <head>
        <title>Lazy-Frame framework</title>
        <link rel="stylesheet" type="text/css" href="public/assets/css/style.css"/>
    </head>
    <body>
        <header>
            <h1>LazyFrame~</h1>
        </header>
        <main>
            <?= $content ?>
        </main>
        <footer>
            <div>Temps de chargement : <?=$bench['_FROM_START_']['time']?>ms</div>
            <div>Module [<?=$module?>] - Controller [<?=$controller?>] - Action [<?=$action?>]</div>
            <div>Mémoire utilisée: <?=$bench['_FROM_START_']['memory']?>ko</div>
        </footer>
    </body>
</html>