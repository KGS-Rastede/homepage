<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $site->title() ?></title>
</head>
<body>

<header>
<a class="logo" href="<?= $site->url() ?>"><?= $site->title() ?></a>


<nav class="menu">
    <?php foreach ($site->children() as $subpage): ?>
            <a href="">Projects</a>
    <?php endforeach ?>
</nav>

</header>
    
</body>
</html>

<h1></h1>
