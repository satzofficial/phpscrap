<?php



phpinfo();
ob_start();
require_once 'index.php';
ob_get_clean();
return $CI;
