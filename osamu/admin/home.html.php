<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal</title>
    <link rel="stylesheet" href="/admin/css/styles.css">
</head>

<body>
    <section class="outer">
        <header>
            <h1>Admin Portal</h1>
        </header>
        <nav>
            <ul class="menu">
                <li><a class="button button-success" href="articles/">Manage Articles</a></li>
                <li><a class="button button-success" href="authors/">Manage Authors</a></li>
                <li><a class="button button-success" href="categories/">Manage Categories</a></li>
                <li><a class="button button-success" href="media/">Manage Media</a></li>
                <li><a class="button button-success" href="products/">Manage Products</a></li>
            </ul>
        </nav>
        <?php include 'footer.inc.html.php'; ?>
    </section>
</body>

</html>