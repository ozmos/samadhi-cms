<?php 
include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';

if (!userIsLoggedIn()) {
    include 'login.html.php';
    exit();
}
$pageId = 'admin-home';
include 'home.html.php';
 ?>