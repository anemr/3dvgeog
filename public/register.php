<?php
header("refresh:60;url=waiting_reg.html");
include(__DIR__."/../includes/functions.php");

$msg = "";

if (!isset($_GET['uuid'])) {
  redirect_to("notallowed.html");
}

if (isset($_GET['msg']) && $_GET['msg'] == 1) {
  $msg = "كلمة السر غير صحيحة. من فضلك أعد المحاولة";
}
include("layouts/header_reg.php");
$output = <<<FRM
  <div class="frm">
    <form action="processReg.php" method="POST">
      <fieldset>
        <legend>أدخل بياناتك للإشتراك في بيئة الحياة الثانية التعليمية</legend>
        الاسم الأول: <br>
        <input type="text" name="fname" placeholder="ادخل اسمك الأول" required><br>
        إسم الأب: <br>
        <input type="text" name="mname" placeholder="ادخل اسم الأب" required><br>
        إسم الجد / اللقب: <br>
        <input type="text" name="lname" placeholder="ادخل اسم الجد / اللقب" required><br>
        كلمة السر المتفق عليها: <br>
        <input type="text" name="secret" placeholder="ادخل كلمة السر" required>&nbsp;&nbsp;&nbsp;
        <span class="err">{$msg}</span><br><br>
        <input type="hidden" name="uuid" value={$_GET['uuid']}>
        <div dir="ltr">
        <button type="submit">اضغط للاشتراك</button>
        </div>
      </fieldset>
    </form>
  </div>

FRM;

echo $output;
include("layouts/footer.php");
?>