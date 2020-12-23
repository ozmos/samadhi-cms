<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- turn off cache for development -->
    <meta http-equiv="Cache-Control" content="no-store" />
    <title><?php htmlout($pageTitle) ?></title>
    <link rel="stylesheet" href="/admin/css/styles.css">
</head>

<body>
    <section class="outer">
        <header>
            <h1><?php htmlout($pageTitle); ?></h1>
        </header>
        <main>