<?php
// Redirects all old links to the new public converter on index.php
session_start();
$lang = $_SESSION['lang'] ?? 'en';
$param = $lang !== 'en' ? '?lang=' . $lang : '';
header('Location: index.php' . $param);
exit;
