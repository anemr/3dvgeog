<?php
session_start();
include("header_admin.php");
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
  $welcome = "مرحبا بك. من فضلك اختر الجهة من القائمة بالأعلى.";
} else {
  $welcome = "مرحبا بك. من فضلك سجل الدخول.";
}
$output = <<<OP
<img class="right" src="../images/globe.png" alt="صورة لنموذج الكرة الأرضية">
<div class="left intro">
  <h1>المناخ والحياة النباتية والحيوانية في مصر - صفحة الادارة</h1>
  <p>{$welcome}</p>
</div>
OP;
echo $output;
include("../layouts/footer.php");
?>