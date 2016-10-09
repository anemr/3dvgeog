<?php
require_once(__DIR__."/../../includes/functions.php");
require_once(__DIR__."/../../includes/database.php");
session_start();
if (!isset($_SESSION['loggedin'])) redirect_to("../notallowed.html");
include("header_admin.php");

$br = "";
$msgConfirmSt ="";
$msgOldPwSt = "";
$msgConfirm ="";
$msgOldPw = "";
$msgNewPw= "";

if (isset($_POST['oldSecret']) && isset($_POST['newSecret'])) {
  $oldSecret = $database->escape_value($_POST['oldSecret']);
  $newSecret = $database->escape_value($_POST['newSecret']);
  $res = $database->query("SELECT secret FROM secret WHERE id=1");
  $resarr = $database->fetch_array($res);
  $oldSecretDb = $resarr['secret'];
  if ($oldSecret == $oldSecretDb) {
    $database->query("UPDATE secret SET secret='{$newSecret}' WHERE id=1");
    $msgConfirmSt = "تم تغيير الكلمة السرية بنجاح";
    $br = "<br>";
  } else { $msgOldPwSt = "الكلمة السرية القديمة غير صحيحة"; }
}

if (isset($_POST['oldPass']) && isset($_POST['newPass']) && isset($_POST['newPass2'])) {
  $oldPass = $database->escape_value($_POST['oldPass']);
  $newPass = $database->escape_value($_POST['newPass']);
  $newPass2 = $database->escape_value($_POST['newPass2']);
  if ($newPass == $newPass2) {
    $res = $database->query("SELECT password FROM admin WHERE id='{$_SESSION['loggedin']}'");
    $resarr = $database->fetch_array($res);
    $oldPasswordHash = $resarr['password'];
    if (password_verify($oldPass, $oldPasswordHash)) {
      $newPasswordHash = password_hash($newPass, PASSWORD_DEFAULT);
      $database->query("UPDATE admin SET password='{$newPasswordHash}' WHERE id='{$_SESSION['loggedin']}'");
      $msgConfirm = "تم تغيير كلمة المرور بنجاح";
      $br = "<br>";
    } else { $msgOldPw = "كلمة المرور القديمة غير صحيحة تأكد من لغة الادخال وزر الحروف الكببيرة"; }
  } else { $msgNewPw = "كلمة المرور الجديدة غير متطابقة"; }
}

$output = <<<FRM
  <div class="frm">
    <form action="change_pw.php" method="POST">
      <fieldset>
        <legend>تغيير كلمة السر المتفق عليها مع الطلبة</legend>
        <span class="confirm">{$msgConfirmSt}</span>{$br}
        الكلمة السرية القديمة: <br>
        <input type="text" name="oldSecret" size="50" placeholder="ادخل الكلمة السرية القديمة" required>
        <span class="err">{$msgOldPwSt}</span><br>
        الكلمة السرية الجديدة: <br>
        <input type="text" name="newSecret" size="50" placeholder="ادخل الكلمة السرية الجديدة" required><br>
        <div dir="ltr">
        <button class="warning" type="submit">تغيير الكلمة السرية</button>
        </div>
      </fieldset>
    </form>
    <br>
    <form action="change_pw.php" method="POST">
      <fieldset>
        <legend>تغيير كلمة مرور حساب المدير</legend>
        <span class="confirm">{$msgConfirm}</span>{$br}
        كلمة المرور القديمة: <br>
        <input type="password" name="oldPass" size="50" placeholder="ادخل كلمة المرور القديمة" required>
        <span class="err">{$msgOldPw}</span><br>
        كلمة المرور الجديدة: <br>
        <input type="password" name="newPass" size="50" placeholder="ادخل كلمة المرور الجديدة" required><br>
        اعادة كلمة المرور الجديدة: <br>
        <input type="password" name="newPass2" size="50" placeholder="ادخل كلمة المرور الجديدة للتأكيد" required>
        <span class="err">{$msgNewPw}</span><br>
        <div dir="ltr">
        <button class="warning" type="submit">تغيير كلمة المرور</button>
        </div>
      </fieldset>
    </form>
  </div>
FRM;
echo $output;
include("../layouts/footer.php");
?>