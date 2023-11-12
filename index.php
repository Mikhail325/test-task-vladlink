

<!DOCTYPE html>
<html>
    <head>
        <title>Тестируем PHP</title>
    </head>
    <body>
    <pre><?php
            $autoloadPath1 = __DIR__ . '/../../autoload.php';
            $autoloadPath2 = __DIR__ . '/vendor/autoload.php';

            if (file_exists($autoloadPath1)) {
                require_once $autoloadPath1;
            } else {
                require_once $autoloadPath2;
            }

            use Task\Vladlink\BuildTree;
            $tree = new BuildTree(false, null);
            echo $tree->buildTree();
        ?></pre>
    </body>
</html>