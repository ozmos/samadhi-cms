<?php
// link uploads to images sybolicly
$uploads = $_SERVER['DOCUMENT_ROOT'] . '/uploads';
$images = $_SERVER['DOCUMENT_ROOT'] . '/content/images';
symlink($uploads, $images);

