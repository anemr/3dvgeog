<?php

if (isset($_SESSION['loggedin'])) {
$navLeft = <<<NL
  <ul class="nav">
    <li>
      <a href="students_progress.php">متابعة ما تم انجازه من الطلاب</a>
      <a href="activities_progress.php">متابعة أنشطة الطلاب</a>
    </li>
  </ul>
NL;
$navRightLogin = <<<NRL
<div class="left nav">
  <ul class="nrl">
    <li>
      <a href="change_pw.php">تغيير كلمة المرور</a>
    </li>
    <li>
      <a href="logout.php">تسجيل الخروج</a>
    </li>
  </ul>
</div>
NRL;
} else {
$navLeft = "";
$navRightLogin = <<<NRL
<div class="left nav">
  <form action="processLogin.php" method="POST">
    <input type="text" name="username" placeholder="اسم المستخدم" required>
    <input type="password" name="password" placeholder="كلمة المرور" required>
    <button type="submit">سجل الدخول</button>
  </form>
</div>
NRL;
}

$output = <<<HD
<!DOCTYPE html>
<html lang="ar" dir="rtl">
  <head>
    <meta charset="UTF-8">
    <link href='http://fonts.googleapis.com/earlyaccess/notokufiarabic.css' rel='stylesheet' type='text/css'>
    <link href="../stylesheets/style.css" type="text/css" rel="stylesheet">
    <title>المناخ والحياة النباتية والحيوانية في مصر - صفحة الادارة</title>
  </head>

  <body>
    
    <div class="bg">
  
    <header>
      <nav>
          
        <a href="index.php"><img class="right" src="../images/globe_small.png"></a>
        <a href="index.php" class="brand">المناخ والحياة النباتية والحيوانية في مصر - صفحة الادارة</a>
        {$navLeft}
        {$navRightLogin}
      </nav>
    </header>

    <main>
      <div class="container">
HD;
echo $output;
?>