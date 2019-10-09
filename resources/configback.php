<?php ob_start(); // Make sure you put this in line 1 with no space
session_start();
//session_destroy();

defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR);

//template front
defined("TEMPLATE_FRONT") ? null : define("TEMPLATE_FRONT", __DIR__ . DS . "Templates/front");

//template back
defined("TEMPLATE_BACK") ? null : define("TEMPLATE_BACK", __DIR__ . DS . "Templates/back");

defined("UPLOADS_DIRECTORY") ? null : define("UPLOADS_DIRECTORY", __DIR__ . DS . "uploads");

//host address
defined("DB_HOST") ? null : define("DB_HOST", "localhost");

//username
defined("DB_USER") ? null : define("DB_USER", "root");

//password
defined("DB_PASS") ? null : define("DB_PASS", "");

//database name
defined("DB_NAME") ? null : define("DB_NAME", "ecom_db");

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

require_once("functions.php");
