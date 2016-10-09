<?php
require_once(__DIR__."/../includes/functions.php");
require_once(__DIR__."/../includes/database.php");
require_once(__DIR__."/../includes/student.php");

$res = $database->query("SELECT secret FROM secret WHERE id=1");
$resarr = $database->fetch_array($res);
$secretstr = $resarr['secret'];

if (!isset($_POST)) {
  redirect_to("notallowed.html");
}

// need more elaborate method for secret
$secret = $_POST['secret'];
if ($secret != $secretstr) {
  redirect_to("register.php?uuid={$uuid}&msg=1");
}

$user_info = array();
$user_info['uuid'] = $database->escape_value($_POST['uuid']);
$user_info['firstname'] = $database->escape_value($_POST['fname']);
$user_info['middlename'] = $database->escape_value($_POST['mname']);
$user_info['lastname'] = $database->escape_value($_POST['lname']);

$user = new Student($user_info);

if (Student::find_by_id($user->uuid)) {
  redirect_to("duplicate.php");
}

$user->insert();
redirect_to("success.php");
?>