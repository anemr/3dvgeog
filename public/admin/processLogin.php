<?php
session_start();
require_once(__DIR__."/../../includes/functions.php");
require_once(__DIR__."/../../includes/database.php");
if (!isset($_POST['username']) || !isset($_POST['password'])) {
  redirect_to("../notallowed.html");
}
$username = $database->escape_value($_POST['username']);
$password = $database->escape_value($_POST['password']);
$sql = "SELECT id, password FROM admin WHERE username='{$username}'";
$res = $database->query($sql);
$resarr = $database->fetch_array($res);
$passhash = $resarr['password'];
$id = $resarr['id'];

if (password_verify($password, $passhash)) {
  $_SESSION['loggedin'] = $id;
  redirect_to("index.php");
} else {
  redirect_to("../notallowed.html");
}
?>